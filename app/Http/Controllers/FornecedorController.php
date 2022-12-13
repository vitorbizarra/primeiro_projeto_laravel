<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = [
            [
                'nome'      => 'Fornecedor 1',
                'status'    => 'N',
                'cnpj'      => '0',
                'ddd'       => '11', // São Paulo
                'telefone'  => '0000-0000',
            ],
            [
                'nome'      => 'Fornecedor 2',
                'status'    => 'N',
                'cnpj'      => '0',
                'ddd'       => '85', // Fortaleza
                'telefone'  => '0000-0000',
            ],
            [
                'nome'      => 'Fornecedor 3',
                'status'    => 'N',
                'cnpj'      => '0',
                'ddd'       => '32', // Juiz de Fora
                'telefone'  => '0000-0000',
            ],
            [
                'nome'      => 'Fornecedor 4',
                'status'    => 'N',
                'cnpj'      => '0',
                'ddd'       => '15', // Sorocaba
                'telefone'  => '0000-0000',
            ]
        ];

        return view('app.fornecedor.index', compact('fornecedores'));
    }
}
