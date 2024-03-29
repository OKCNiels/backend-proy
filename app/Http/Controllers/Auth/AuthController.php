<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    //
    
    public function login(LoginRequest $request) {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token =JWTAuth::attempt($credentials)) {
                return response()->json(["error"=>"invalid credentials"],401);
            }
        } catch (JWTException $e) {
            return response()->json(["error"=>'not create token'],500);
        }
        $usuario = User::where('email',$request->email)->first();
        return response()->json([
            "token"=>$token,
            "usuario"=>$usuario
        ],200);
    }
    public function logout() {

        auth()->logout();
        return response()->json(['message' => 'Session finalizada']);
    }
    public function obtenerSession() {

        return response()->json(auth()->user(),200);
    }

}
