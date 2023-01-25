<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lelang;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['sidebar'] = 'dashboard';
        return view('admin.index',$data);
    }
    public function laporan()
    {
        $data['lelang'] = Lelang::join('barangs','barangs.id_barang','=','lelangs.id_barang')->join('users','users.id','=','lelangs.id')->get();

        return view('admin.laporan',$data);
    }
}
