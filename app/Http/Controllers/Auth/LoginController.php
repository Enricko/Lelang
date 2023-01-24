<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::INDEX;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login()
    {
        request()->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email'=>request()->email,'password'=>request()->password,'level'=>'masyarakat'])){
            return redirect()->to('/')->with('success',"Selamat datang kembali ".Auth::user()->name);
        }elseif(Auth::attempt(['email'=>request()->email,'password'=>request()->password,'level'=>['administrasi','petugas']])){
            return redirect()->to('/admin')->with('success',"Selamat datang kembali ".Auth::user()->name);
        }else{
            return redirect()->back()->with('error',"Email/Password salah!!!");
        }
    }
}
