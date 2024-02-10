<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsuarioController extends Controller
{
    //
    public function register(RegisterRequest $request) {
        
        $usuario = new User();
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        $token = JWTAuth::fromUser($usuario);
        return response()->json([
            "usuario"=>$usuario,
            "token"=>$token
        ],200);
        
    }
    public function buscar($id){
        $usuario = User::find($id);
        return response()->json($usuario);
    }
    public function lista(){
        $usuarios = User::all();
        return response()->json($usuarios);
    }
}
