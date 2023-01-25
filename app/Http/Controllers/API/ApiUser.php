<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserRes;

class ApiUser extends Controller
{
    public function login()
    {
        $email = request()->email;
        $password = request()->password;
        if(auth()->attempt(['email' => $email,'password' => $password])){
            $user = User::where('email',request()->email);
            $userGet = $user->first();
            $user = $user->get();
            $userCol = UserRes::collection($user);
            return response()->json([
                'message' => 'Selamat datang '.$userGet->name,
                'status' => '200',
                'data' => $userCol[0],
            ]);
        }else{
            return response()->json([
                'message' => "Email/Password anda salah silahkan coba lagi!",
                'status' => '404',
            ]);
        }
    }
}
