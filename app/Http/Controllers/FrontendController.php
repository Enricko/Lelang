<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lelang;
use App\Models\Barang;
use App\Models\User;
use App\Models\HistoryLelang;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
//     public function __construct()
//     {
//         $this->middleware('auth');
//     }
    public function index()
    {
        $data['sidebar'] = 'home';
        $data['lelang'] = Lelang::join('barangs','barangs.id_barang','=','lelangs.id_barang')->where('status','dibuka')->orderBy('tgl_ditutup','DESC')->orderBy('harga_akhir','DESC')->get();
        return view('frontend.index',$data);
    }
    public function history()
    {
        $data['sidebar'] = 'history';
        $data['lelang'] = Lelang::join('barangs','barangs.id_barang','=','lelangs.id_barang')->where('status','ditutup')->get();
        return view('frontend.history',$data);
    }
    public function current_bid()
    {
        $data['sidebar'] = 'current_bid';
        $data['lelang'] = HistoryLelang::join('barangs','barangs.id_barang','=','history_lelangs.id_barang')->join('lelangs','lelangs.id_lelang','=','history_lelangs.id_lelang')->join('users','users.id','=','history_lelangs.id')->where('history_lelangs.id',Auth::user()->id)->where('lelangs.status','dibuka')->get()->unique('id_lelang');

        return view('frontend.current_bid',$data);
    }
    public function item_lelang($id_lelang)
    {
        $data['sidebar'] = 'home';
        $data['lelang'] = Lelang::join('barangs','barangs.id_barang','=','lelangs.id_barang')->where('id_lelang',$id_lelang)->first();
        $data['id_lelang'] = $id_lelang;
        return view('frontend.detail_lelang',$data);
    }
    public function tawar_item($id_lelang)
    {
        $lelang = Lelang::join('barangs','barangs.id_barang','=','lelangs.id_barang')->where('id_lelang',$id_lelang)->first();
        $history = HistoryLelang::where('id_lelang',$id_lelang)->where('id',Auth::user()->id)->orderBy('penawaran_harga','DESC')->first();
        if($history){
            if ($history->penawaran_harga <= $lelang->harga_akhir) {
                return redirect()->back()->with('warning','Kamu tidak bisa menawar jika kamu penawar tertinggi!!!');
            }
        }
        $min = $lelang->harga_akhir;
        if($lelang->status == 'ditutup'){
            return redirect()->to('/')->with('warning','Lelang untuk item ini resmi di tutup!!!');
        }
        if($lelang->harga_awal >= request()->tawar){
            $min = $lelang->harga_awal;
        }
        request()->validate([
            'tawar'=> ['required','numeric','min:'.$min]
        ]);
        if(Auth::user() == null){
            return redirect()->to('/login')->with('warning',"Login terlebih dahulu sebelum membuat penawaran!!!");
        }
        if (Auth::user()->level == 'administrasi' || Auth::user()->level == 'petugas') {
            return redirect()->back()->with('error','Administrasi dan petugas tidak bisa melakukan penawaran!!!');
        }
        if(request()->tawar <= $lelang->harga_akhir || strtotime($lelang->tgl_ditutup) <= time() || $lelang == 'ditutup'){
            return redirect()->back()->with('error','Something went wrong please try again!!');
        }
        $data_history = [
            'id_barang' => $lelang->id_barang,
            'id_lelang' => $id_lelang,
            'id' => Auth::user()->id,
            'penawaran_harga' => request()->tawar
        ];

        HistoryLelang::insert($data_history);

        Lelang::where('id_lelang',$id_lelang)->update(['id'=> Auth::user()->id,'harga_akhir'=>request()->tawar]);

        return redirect()->back()->with('success','Penawaran telah di tetapkan');
    }
}
