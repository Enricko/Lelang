@extends('frontend.layout.app')
@section('title','Current Bid')
@section('content')
    <div class="container-fluid text-light">
        <div class="card" style="background-color:#858585;">
            <div class="card-header">
                <h3 class="text-center my-2">Your Current Bidding</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($lelang as $row)
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="/item_lelang/{{ $row->id_lelang }}" >
                                <div class="card" style="background-color:#616161;height:400px">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-center my-3">
                                            <img src="{{ asset("barang_lelang/$row->image_barang") }}" alt="" style="width:200px">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h4>{{ $row->nama_barang }}</h4>
                                        @if ($row->harga_akhir == null)
                                            <h5>Belum ada penawar</h5>
                                        @else
                                            <h5>Tertinggi : Rp.{{ number_format($row->harga_akhir) }}</h5>
                                        @endif
                                        <h6 id="countdown{{ $row->id_lelang }}">Time Left : </h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <script>
                            // Set the date we're counting down to
                            var countDownDate{{ $row->id_lelang }} = new Date("{{ $row->tgl_ditutup }}").getTime();

                            // Update the count down every 1 second
                            var x{{ $row->id_lelang }} = setInterval(function() {

                            // Get today's date and time
                            var now{{ $row->id_lelang }} = new Date().getTime();

                            // Find the distance between now and the count down date
                            var distance{{ $row->id_lelang }} = countDownDate{{ $row->id_lelang }} - now{{ $row->id_lelang }};

                            // Time calculations for days, hours, minutes and seconds
                            var days{{ $row->id_lelang }} = Math.floor(distance{{ $row->id_lelang }} / (1000 * 60 * 60 * 24));
                            var hours{{ $row->id_lelang }} = Math.floor((distance{{ $row->id_lelang }} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes{{ $row->id_lelang }} = Math.floor((distance{{ $row->id_lelang }} % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds{{ $row->id_lelang }} = Math.floor((distance{{ $row->id_lelang }} % (1000 * 60)) / 1000);

                            // Output the result in an element with id="countdown"
                            document.getElementById("countdown{{ $row->id_lelang }}").innerHTML = "Time Left : " + days{{ $row->id_lelang }} + "h " + hours{{ $row->id_lelang }} + "j "
                            + minutes{{ $row->id_lelang }} + "m " + seconds{{ $row->id_lelang }} + "d ";

                            // If the count down is over, write some text
                            if (distance{{ $row->id_lelang }} < 0) {
                                clearInterval(x);
                                document.getElementById("countdown{{ $row->id_lelang }}").innerHTML = "EXPIRED";
                            }
                            }, 1000);
                        </script>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
