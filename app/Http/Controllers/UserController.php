<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }   
    public function index()
    {
        $data['sidebar'] = 'user_masyarakat';
        $data['user'] = User::where('level','masyarakat')->get();
        return view('admin.pages.user.index',$data);
    }
    public function user_petugas()
    {
        $data['sidebar'] = 'user_petugas';
        $data['user'] = User::whereNot('level','masyarakat')->get();
        return view('admin.pages.user_admin.index',$data);
    }
    public function tambah_user_petugas()
    {
        $data['sidebar'] = 'user_petugas';
        return view('admin.pages.user_admin.tambah',$data);
    }
    public function tambah_data_petugas()
    {
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'level' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $data = [
            'name' => request()->name,
            'id_petugas' => mt_rand(1000000000,9999999999),
            'email' => request()->email,
            'password' => Hash::make(request()->password),
            'level' => request()->level,
        ];

        User::insert($data);

        return redirect()->to('/admin/user_petugas')->with('success',"User ".request()->level." telah di buat");
    }
}
