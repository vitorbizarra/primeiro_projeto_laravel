@if (isset($cliente->id))
    <form action="{{ route('cliente.update', ['cliente' => $cliente->id]) }}" method="post">
        @method('PUT')
    @else
        <form action="{{ route('cliente.store') }}" method="post">
@endif
@csrf

<input type="text" name="nome" value="{{ $cliente->nome ?? old('nome') }}" placeholder="Nome" class="borda-preta">
{{ $errors->has('nome') ? $errors->first('nome') : '' }}

<button type="submit" class="borda-preta">Cadastrar</button>
</form>
