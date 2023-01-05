<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $erro = '';
        if($request->get('erro') == 1){
            $erro = 'Usuário e (ou) senha incorretos';
        }

        if($request->get('erro') == 2){
            $erro = 'Necessário login para acessar a rota';
        }

        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
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

            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            return redirect()->route('app.home');
        } else {
            return redirect()->route('site.login', ['erro' => 1]);
        }
    }

    public function sair(){
        session_destroy();
        return redirect()->route('site.index');
    }
}
