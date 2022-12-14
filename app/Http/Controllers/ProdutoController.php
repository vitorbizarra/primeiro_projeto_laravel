<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Unidade;
use App\Models\Item;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $produtos = Item::paginate(10);

        // // echo "<pre>";
        // foreach ($produtos as $key => $produto) {
        //     // print_r($produto->getAttributes());

        //     $produtoDetalhe = ProdutoDetalhe::where('produto_id', $produto->id)->first();

        //     if (isset($produtoDetalhe)) {
        //         // print_r($produtoDetalhe->getAttributes());

        //         $produtos[$key]['comprimento'] = $produtoDetalhe->comprimento;
        //         $produtos[$key]['largura']  = $produtoDetalhe->largura;
        //         $produtos[$key]['altura']  = $produtoDetalhe->altura;
        //     }
        // }
        // // echo "</pre>";

        return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidades = Unidade::all();
        return view('app.produto.create', ['unidades' => $unidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras_validacao = [
            'nome' => [
                'required',
                'min:3',
                'max:40'
            ],
            'descricao' => [
                'required',
                'min:3',
                'max:2000'
            ],
            'peso' => [
                'required',
                'integer'
            ],
            'unidade_id' => [
                'required',
                'exists:unidades,id'
            ]
        ];

        $feedback = [
            'required'          => 'O campo :attribute deve ser preenchido',
            'nome'              => [
                'O campo nome deve ter no m??nimo 3 caracteres',
                'O campo nome deve ter no m??ximo 40 caracteres'
            ],
            'descricao'         => [
                'O campo nome deve ter no m??nimo 3 caracteres',
                'O campo nome deve ter no m??ximo 2000 caracteres'
            ],
            'peso.integer'      => 'O campo peso deve ser um n??mero inteiro',
            'unidade_id.exists' => 'A unidade de medida informada n??o existe'
        ];

        $request->validate($regras_validacao, $feedback);
        Produto::create($request->all());
        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        return view('app.produto.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        return view('app.produto.edit', ['produto' => $produto, 'unidades' => Unidade::all()]);
        // return view('app.produto.create', ['produto' => $produto, 'unidades' => Unidade::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        $produto->update($request->all());
        return redirect()->route('produto.show', ['produto' => $produto->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produto.index');
    }
}
