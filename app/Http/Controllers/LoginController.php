<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('site.login', ['titulo' => 'Login']);
    }

    public function autenticar(Request $request)
    {
        $regras_validacao = [
            'usuario'   => 'required|email',
            'senha'     => 'required'
        ];

        $feedbacks = [
            'usuario' => [
                'required'  => 'O campo usuário é obrigatório',
                'email'     => 'Email inválido'
            ],
            'senha.required' => 'O campo senha é obrigatório'
        ];

        $request->validate($regras_validacao, $feedbacks);

        $email = $request->get('usuario');
        $password = $request->get('senha');


        // Iniciar o Model User
        $user = new User();

        $usuario = $user->where('email', $email)
                    ->where('password', $password)
                    ->get()
                    ->first();

        if (isset($usuario->name)){
            echo "usuário existe";
        } else {
            echo "usuário não existe";
        }
    }
}
