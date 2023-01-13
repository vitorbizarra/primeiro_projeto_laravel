@extends('app.layouts.basico')

@section('titulo', 'Pedido Produti')

@section('conteudo')
    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Adicionar Produtos ao Pedido</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('pedido.index') }}">Voltar</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <h4>Detalhes do pedido</h4>
            <p>ID do pedido: {{ $pedido->id }}</p>
            <p>ID do cliente: {{ $pedido->cliente_id }}</p>

            <div style="width: 30%; margin-left:auto; margin-right:auto;">
                @component('app.pedido_produto._components.form_create', ['pedido' => $pedido, 'produtos' => $produtos])
                @endcomponent
                @if ($pedido->produtos)
                    <h4>Itens do pedido</h4>
                    <table border="1" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Data de Inclusão</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedido->produtos as $produto)
                                <tr>
                                    <td>{{ $produto->id }}</td>
                                    <td>{{ $produto->nome }}</td>
                                    <td>{{ $produto->pivot->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <form id="form_{{ $produto->pivot->id }}" method="POST"
                                            action="{{ route('pedido-produto.destroy', ['pedidoProduto' => $produto->pivot->id, 'pedido_id' => $pedido->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <a href="#"
                                                onclick="document.getElementById('form_{{ $produto->pivot->id }}').submit()">Excluir</a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>
@endsection