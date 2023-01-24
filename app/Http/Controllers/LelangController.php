<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lelang;
use App\Models\Barang;
use App\Models\User;
use App\Models\HistoryLelang;

class LelangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['sidebar'] = 'lelang_dibuka';
        $data['lelang'] = Lelang::join('barangs','barangs.id_barang','=','lelangs.id_barang')->where('status','dibuka')->get();

        return view('admin.pages.lelang.index',$data);
    }
    public function lelang_ditutup()
    {
        $data['sidebar'] = 'lelang_ditutup';
        $data['lelang'] = Lelang::join('barangs','barangs.id_barang','=','lelangs.id_barang')->where('status','ditutup')->get();

        return view('admin.pages.lelang.tutup',$data);
    }
    public function history_lelang($id_lelang)
    {
        $data['sidebar'] = 'lelang_ditutup';
        $data['id_lelang'] = $id_lelang;
        $data['history'] = HistoryLelang::join('barangs','barangs.id_barang','=','history_lelangs.id_barang')->join('lelangs','lelangs.id_lelang','=','lelangs.id_lelang')->where('history_lelangs.id_lelang',$id_lelang)->orderBy('penawaran_harga','DESC')->get();

        return view('admin.pages.lelang.history',$data);
    }
    public function tambah_lelang()
    {
        $data['sidebar'] = 'lelang_dibuka';

        return view('admin.pages.lelang.tambah',$data);
    }
    public function tambah_data_lelang()
    {

        request()->validate([
            'nama_barang' => ['required', 'string', 'max:255'],
            'harga_awal' => 'required',
            'lama_lelang' => 'required',
            'image_barang' => 'required',
            'deskripsi_barang' => ['required', 'string'],
        ]);

        $file = request()->image_barang;

        $file_name = now().'_'.request()->nama_barang.'.png';
        $path_upload = 'barang_lelang';

        $file->move($path_upload,$file_name);

        $data_barang = [
            'image_barang' => $file_name,
            'nama_barang' => request()->nama_barang,
            'tgl' => now(),
            'harga_awal' => request()->harga_awal,
            'deskripsi_barang' => request()->deskripsi_barang,
        ];

        $id_barang = Barang::create($data_barang)->id;
        $lama_lelang = request()->lama_lelang;
        $data_lelang = [
            'id_barang' => $id_barang,
            'tgl_dibuka' => now(),
            'tgl_ditutup' => date('Y-m-d H:i:s',strtotime(now()."+ $lama_lelang days")),
            'id' => null,
            'id_petugas' => Auth::user()->id_petugas,
            'status' => 'dibuka',
        ];
        Lelang::insert($data_lelang);

        return redirect()->to('/admin/lelang_dibuka')->with('success','Barang '.ucfirst(request()->nama_barang).' telah dibuka');

    }
}
