<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    public function index()
    {
        return view('app.fornecedor.index');
    }

    public function listar(Request $request)
    {
        $fornecedores = Fornecedor::where('nome', 'like', '%' . $request->input('nome') . '')
            ->where('site', 'like', '%' . $request->input('site') . '')
            ->where('uf', 'like', '%' . $request->input('uf') . '')
            ->where('email', 'like', '%' . $request->input('email') . '')
            ->get();

        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores]);
    }

    public function adicionar(Request $request)
    {
        $msg = '';

        // Cadastro
        if (!is_null($request->input('_token')) && $request->input('id') == '') {
            $regras_validacao = [
                'nome'  => [
                    'required',
                    'min:3',
                    'max:40',
                ],
                'site'  => 'required',
                'uf'    => [
                    'required',
                    'min:2',
                    'max:2',
                ],
                'email' => [
                    'required',
                    'email'
                ]
            ];

            $feedback = [
                'required'  => 'O campo :attribute deve ser preenchido',
                'nome'      => [
                    'min' => 'O nome deve ter no mínimo 3 caracteres',
                    'max' => 'O nome deve ter no máximo 40 caracteres'
                ],
                'uf'        => [
                    'min' => 'A UF deve ter no mínimo 2 caracteres',
                    'max' => 'A UF deve ter no máximo 2 caracteres'
                ],
                'email' => 'Email inválido'
            ];

            $request->validate($regras_validacao, $feedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            $msg = 'Cadastro realizado com sucesso!';
        }

        // Edição
        if (!is_null($request->input('_token')) && $request->input('id') != '') {
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if ($update) {
                $msg = 'Registro atualizado com sucesso!';
            } else {
                $msg = 'Não foi possível atualizar o registro.';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = '')
    {
        $fornecedor = Fornecedor::find($id);
        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }
}
