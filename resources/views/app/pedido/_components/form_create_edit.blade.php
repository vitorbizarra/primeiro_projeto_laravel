@if (isset($pedido->id))
    <form action="{{ route('pedido.update', ['pedido' => $pedido->id]) }}" method="post">
        @method('PUT')
    @else
        <form action="{{ route('pedido.store') }}" method="post">
@endif
@csrf

<select name="cliente_id">
    <option selected>Seleciona um cliente</option>
    @foreach ($clientes as $cliente)
        <option value="{{ $cliente->id }}"
            {{ isset($produto->cliente_id) && $produto->cliente_id == $cliente->id ?? old('cliente_id') == $cliente->id ? 'selected' : '' }}>
            {{ $cliente->nome }}</option>
    @endforeach
</select>
{{ $errors->has('cliente_id') ? $errors->first('cliente_id') : '' }}

<button type="submit" class="borda-preta">Cadastrar</button>
</form>
