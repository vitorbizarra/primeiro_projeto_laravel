<?php

namespace App\Http\Controllers;

use App\Models\MotivoContato;
use Illuminate\Http\Request;
use App\Models\SiteContato;

class ContatoController extends Controller
{
    public function contato()
    {
        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['motivo_contatos' => $motivo_contatos]);
    }

    /**
     * Método responsável por validar os dados da
     * request * e salvar o contato no banco de dados
     * @param Request $request
     */
    public function salvar(Request $request)
    {
        /*
        Atribui cada input da requisicao a um atributo da model e salva no banco
        no método $contato->save();

        $contato = new SiteContato();
        $contato->nome              = $request->input('nome');
        $contato->telefone          = $request->input('telefone');
        $contato->email             = $request->input('email');
        $contato->motivo_contato    = $request->input('motivo_contato');
        $contato->mensagem          = $request->input('mensagem');
        $contato->save();
        */

        /*
        Atribui cada input da requisicao a um atributo da model através
        do array associativo recebido em $request->all(); e salva no banco
        em $contato->save();
        
        $contato = new SiteContato();
        $contato->fill($request->all());
        $contato->save();
        */

        /*
        Atribui cada input da requisicao ao seu respectivo atributo na model
        através do array associativo recebido em $request->all() e já o salva
        no banco de dados, diferentemente do método acima, que após o fill()
        é necessário chamar o método save();

        SiteContato::create($request->all());
        */

        // Valida os dados do formulário
        $regras = [
            'nome'                  => 'required|min:3|max:40',
            'telefone'              => 'required',
            'email'                 => 'required|email',
            'mensagem'              => 'required|max:2000',
            'motivo_contatos_id'    => 'required',
        ];

        $feedback = [
            'nome.required'                 => 'O campo Nome é obrigatório',
            'nome.min'                      => 'O campo Nome precisa ter no mínimo 3 caracteres',
            'nome.max'                      => 'O campo Nome precisa ter no máximo 40 caracteres',

            'telefone.required'             => 'O campo Telefone é obrigatório',

            'email.email'                   => 'O Email informado não é válido',

            'mensagem.max'                  => 'A mensagem deve ter no máximo 2000 caracteres',

            'motivo_contatos_id.required'   => 'O motivo do contato deve ser selecionado',

            'required'                      => 'O campo :attribute deve ser preenchido'
        ];

        $request->validate($regras, $feedback);

        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
}
