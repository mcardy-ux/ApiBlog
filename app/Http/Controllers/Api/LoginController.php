<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function login(Request $request){
        $validate=$this->validateLogin($request);

        if (Auth::attemp($request->only('email','password'))) {
            return response()->json([
                'token'=> $request->user()->createToken($request->name)->plainTextToken,
                'message' => 'success'
            ]);
        }else{
            return response()->json([
                'message' => 'Unauthorized'
            ],401); 
        }

    }
    public function validateLogin(Request $request){
        return   $request->validate([
            'email' =>'requerid|email',
            'password' =>'requerid',
            'name' =>'requerid',
        ]);
    }
}
