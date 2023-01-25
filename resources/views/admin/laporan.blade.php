@php
    use App\Models\User;
    use App\Models\HistoryLelang;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
    <link rel="stylesheet" href="{{ asset('admin-lte') }}/dist/css/adminlte.min.css">
    <style>
        @media print
        {
            .no-print, .no-print *
            {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-2 no-print">
        <a href="/admin" class="btn btn-primary">Back</a>
        <a href="#" class="btn btn-primary float-right" onclick="return window.print()">Print</a>
        <div class="mt-2">
            <form action="/admin/laporan" method="post">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <select name="select" class="form-control" id="" onchange="if(this.value != 0) {this.form.submit();}">
                            <option value="">=== Select Daftar/History lelang ===</option>
                            <option value="daftar" {{ request()->select == 'daftar' ? 'selected' : '' }}>Daftar</option>
                            <option value="history" {{ request()->select == 'history' ? 'selected' : '' }}>History</option>
                        </select>
                    </div>
                    @if (request()->select == 'daftar')
                        <div class="col-4">
                            <select name="status" class="form-control" id="">
                                <option value="">=== Select Status ===</option>
                                <option value="dibuka" {{ request()->status == 'dibuka' ? 'selected' : '' }}>Dibuka</option>
                                <option value="ditutup" {{ request()->status == 'ditutup' ? 'selected' : '' }}>Ditutup</option>
                            </select>
                        </div>
                    @endif
                    @if (request()->select == 'history')
                        <div class="col-4">
                            <input type="number" class="form-control" name="id_lelang" value="{{ request()->id_lelang }}" placeholder="ID LELANG">
                        </div>
                    @endif
                    <button class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <hr style="border-top:2px dashed black">
    </div>
    @if (request()->select == 'history')
    @else
        <h3 class="m-3 text-center">Laporan Lelang {{ request()->status == null ? 'Dibuka' : ucfirst(request()->status) }}</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Nama Barang</th>
                    <th>Penawar Tertinggi</th>
                    <th>Penanggung Jawab</th>
                    <th>Harga Akhir</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                    $subtotal = 0;
                    @endphp
                @foreach ($lelang->where('status',(request()->status == 'ditutup' ? 'ditutup' : 'dibuka')) as $row)
                    @php
                        $history = HistoryLelang::where('id',$row->id)->where('id_lelang',$row->id_lelang)->first();
                        $user = User::where('id',$row->id)->first();
                        $petugas = User::where('id_petugas',$row->id_petugas)->first();
                        $subtotal += $row->harga_akhir;
                    @endphp
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td><img src="{{ asset('barang_lelang/'.$row->image_barang) }}" alt="" style="width:100px"></td>
                        <td>{{ $row->nama_barang }}</td>
                        <td>
                            <div class="row justify-content-center text-center">
                                <div class="col-12">
                                    <img src="{{ $user->image == null ? asset('image/defultProfile.jpeg') : asset("profile/$user->level").'/'.$user->image }}" alt="" class="rounded-circle" style="width:100px">
                                </div>
                                <div class="col-12">
                                    <p>{{ ($user->name) }}</p>
                                </div>
                                <div class="col-12">
                                    <p>Rp.{{ number_format($row->harga_akhir) }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row justify-content-center text-center">
                                <div class="col-12">
                                    <img src="{{ $user->image == null ? asset('image/defultProfile.jpeg') : asset("profile/$user->level").'/'.$user->image }}" alt="" class="rounded-circle" style="width:100px">
                                </div>
                                <div class="col-12">
                                    <p>{{ ($petugas->name) }}</p>
                                </div>
                            </div>
                        </td>
                        <td>Rp.{{ number_format($row->harga_akhir) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center" colspan="5">Subtotal</th>
                    <th>Rp.{{ number_format($subtotal) }}</th>
                </tr>
            </tfoot>
        </table>
    @endif
</body>
</html>
