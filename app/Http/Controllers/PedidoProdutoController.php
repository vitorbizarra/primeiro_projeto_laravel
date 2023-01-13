<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoProduto;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Models\Pedido $pedido
     * @return \Illuminate\Http\Response
     */
    public function create(Pedido $pedido)
    {
        $pedido->produtos;
        return view('app.pedido_produto.create', ['pedido' => $pedido, 'produtos' => Produto::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido $pedido
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pedido $pedido)
    {
        $regras = [
            'produto_id' => 'exists:produtos,id',
            'quantidade' => 'required|min:1'
        ];

        $feedback = [
            'produto_id.exists' => 'O produto informado não existe',
            'quantidade.required'  => 'O campo :attribute é obrigatorio',
            'quantidade.min'       => 'A quantidade mínima deve ser maior ou igual a 1'
        ];

        $request->validate($regras, $feedback);

        // $pedidoProduto = new PedidoProduto();
        // $pedidoProduto->pedido_id = $pedido->id;
        // $pedidoProduto->produto_id = $request->get('produto_id');
        // $pedidoProduto->quantidade = $request->get('quantidade');
        // $pedidoProduto->save();

        // $pedido->produtos; // os registros do relacionamento
        
        // Forma unitária
        // $pedido->produtos()->attach(
        //     $request->get('produto_id'),
        //     ['quantidade' => $request->get('quantidade')]
        // ); // objeto

        // Forma com mais de um registro
        $pedido->produtos()->attach([
            $request->get('produto_id') => ['quantidade' => $request->get('quantidade')]
        ]);

        return redirect()->route('pedido-produto.create', ['pedido' => $pedido->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PedidoProduto  $pedidoProduto
     * @param  integer $pedido_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PedidoProduto $pedidoProduto, $pedido_id)
    {
        // Método convencional de exclusao
        // PedidoProduto::where([
        //     'pedido_id'  => $pedido->id,
        //     'produto_id' => $produto->id
        // ])->delete();

        // Detach (delete pelo relacionamento)
        // $pedido->produtos()->detach($produto->id);

        $pedidoProduto->delete();

        return redirect()->route('pedido-produto.create', ['pedido' => $pedido_id]);
    }
}
