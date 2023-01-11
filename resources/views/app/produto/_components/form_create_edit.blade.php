@if (isset($produto->id))
    <form action="{{ route('produto.update', ['produto' => $produto->id]) }}" method="post">
        @method('PUT')
    @else
        <form action="{{ route('produto.store') }}" method="post">
@endif
@csrf
<select name="fornecedor_id">
    <option selected>Seleciona um Fornecedor</option>
    @foreach ($fornecedores as $fornecedor)
        <option value="{{ $fornecedor->id }}"
            {{ isset($produto->fornecedor_id) && $produto->fornecedor_id == $fornecedor->id ?? old('fornecedor_id') == $fornecedor->id ? 'selected' : '' }}>
            {{ $fornecedor->nome }}</option>
    @endforeach
</select>
{{ $errors->has('fornecedor_id') ? $errors->first('fornecedor_id') : '' }}

<input type="text" name="nome" value="{{ $produto->nome ?? old('nome') }}" placeholder="Nome" class="borda-preta">
{{ $errors->has('nome') ? $errors->first('nome') : '' }}

<input type="text" name="descricao" value="{{ $produto->descricao ?? old('descricao') }}" placeholder="Descrição"
    class="borda-preta">
{{ $errors->has('descricao') ? $errors->first('descricao') : '' }}

<input type="text" name="peso" value="{{ $produto->peso ?? old('peso') }}" placeholder="Peso" class="borda-preta">
{{ $errors->has('peso') ? $errors->first('peso') : '' }}

<select name="unidade_id">
    <option selected>Seleciona a Unidade de Medida</option>
    @foreach ($unidades as $unidade)
        <option value="{{ $unidade->id }}"
            {{ $produto->unidade_id ?? old('unidade_id') == $unidade->id ? 'selected' : '' }}>
            {{ $unidade->descricao }}</option>
    @endforeach
</select>
{{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}

<button type="submit" class="borda-preta">Cadastrar</button>
</form>
