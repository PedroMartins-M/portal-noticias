<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAppController extends Controller
{
    public function Login(request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(["mensagem" => "E-mail ou senha inválidos"], 401);
        }

        $usuario = Auth::user();

        $token =$usuario->createtoken('api-token')->plainTextToken;

        return response()->json([
            "token" => $token,
            "usuario" => $usuario
        ]);
    }

    public function Logout(request $request) {

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'mensagem' => 'Logout realizado com sucesso'
        ]);
    }
}
