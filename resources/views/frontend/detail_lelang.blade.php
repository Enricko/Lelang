@extends('frontend.layout.app')
@section('title','Item '.$lelang->nama_barang)
@section('content')
@php
    use App\Models\HistoryLelang;
    $history = HistoryLelang::join('barangs','barangs.id_barang','=','history_lelangs.id_barang')->join('lelangs','lelangs.id_lelang','=','history_lelangs.id_lelang')->join('users','users.id','=','history_lelangs.id')->where('lelangs.id_lelang',$id_lelang)->orderBy('history_lelangs.penawaran_harga','DESC')->get();
    $top = 1;
    $myTop = 0;
    $countTop = 0;
@endphp
<style>
    .tr-gold{
        --bs-table-color: #000;
        --bs-table-bg: #ceb525;
        color: var(--bs-table-color);
    }
    .tr-silver{
        --bs-table-color: #000;
        --bs-table-bg: #C0C0C0;
        color: var(--bs-table-color);
    }
    .tr-bronze{
        --bs-table-color: #000;
        --bs-table-bg: #CD7F32;
        color: var(--bs-table-color);
    }

    ::-webkit-scrollbar {
    width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #313131;
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
    <div class="container-fluid text-light">
        <div class="card my-3" style="background-color:#858585;">
            <div class="card-header">
                <h3 class="text-center my-2">{{ $lelang->nama_barang }}</h3>
            </div>
            <div class="card-body">
                <h3 class="text-center" id="countdown"></h3>
                <script>
                    // Set the date we're counting down to
                    var countDownDate = new Date("{{ $lelang->tgl_ditutup }}").getTime();

                    // Update the count down every 1 second
                    var x = setInterval(function() {

                    // Get today's date and time
                    var now = new Date().getTime();

                    // Find the distance between now and the count down date
                    var distance = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Output the result in an element with id="countdown"
                    document.getElementById("countdown").innerHTML = "Time Left : " + days + "h " + hours + "j "
                    + minutes + "m " + seconds + "d ";

                    // If the count down is over, write some text
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("countdown").innerHTML = "LELANG DITUTUP";
                    }
                    }, 1000);
                </script>
                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="d-flex justify-content-center my-5">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <img src="{{ asset("barang_lelang/$lelang->image_barang") }}" alt="" style="width:200px">
                                </div>
                                <div class="col-12 mt-2">
                                    <h5>Harga Awal : Rp.{{ number_format($lelang->harga_awal) }}</h5>
                                </div>
                                <div class="col-12 mb-1">
                                    <h5>Deskripsi Barang : </h5>
                                    <h6>&emsp;&emsp;{{ $lelang->deskripsi_barang }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <div class="card" style="background-color: #717171">
                            <div class="card-body">
                                <div style="max-height: 300px;overflow-y:scroll">
                                    <table class="table table-bordered table-responsive table-dark">
                                        <thead>
                                            <tr>
                                                <th>Top #</th>
                                                <th>Nama</th>
                                                <th>Penawaran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($history as $row)
                                                @php
                                                    if(Auth::user() != null){
                                                        if ($row->id == Auth::user()->id && $countTop == 0) {
                                                            $myTop = $top;
                                                            $countTop++;
                                                        }
                                                    }
                                                @endphp
                                                <tr class="{{ $top == 1 ? 'tr-gold' : ($top == 2 ? 'tr-silver' : ($top == 3 ? 'tr-bronze' : '')) }}">
                                                    <td>{{ $top++ }}</td>
                                                    <td>
                                                        <img src="{{ $row->image == null ? asset('image/defultProfile.jpeg') : asset("profile/$row->level").'/'.$row->image }}" alt="" class="rounded-circle mr-2" style="width:50px">
                                                        {{ $row->name }}
                                                    </td>
                                                    <td>Rp.{{ number_format($row->penawaran_harga) }}</td>
                                                </tr>
                                            @endforeach
                                            <tr></tr>
                                        </tbody>
                                    </table>
                                </div>
                                @if ($lelang->status == 'dibuka')
                                    <h5>Tawar Barang</h5>
                                    <form action="/tawar/{{ $id_lelang }}" method="post">
                                        @csrf
                                        <input type="number" class="form-control text-light @error('tawar') is-invalid @enderror" name="tawar" placeholder="Tawar..">
                                            @error('tawar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>Kamu haru menawar lebih tinggi</strong>
                                                </span>
                                            @enderror
                                        @if (Auth::user() != null)
                                            @php
                                                $user = HistoryLelang::where('id_lelang',$id_lelang)->where('id',Auth::user()->id)->first();
                                            @endphp
                                            @if ($user)
                                                <h6 class="mt-2">Penawaran Mu : Rp.{{ number_format(HistoryLelang::where('id_lelang',$id_lelang)->where('id',Auth::user()->id)->orderBy('history_lelangs.penawaran_harga','DESC')->first()->penawaran_harga) }} (Top #{{ $myTop }})</h6>
                                            @endif
                                        @endif
                                        <button class="btn btn-primary my-3" style="float:right" type="submit">Tawar</button>
                                    </form>
                                @else
                                <h3>Harga Tertinggi Rp.{{ number_format($lelang->harga_akhir) }}</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
