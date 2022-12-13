<h3>Fornecedores</h3>

@isset($fornecedores)
    @forelse ($fornecedores as $fornecedor)
        {{ $loop->iteration }}
        <br>
        Fornecedor: {{ $fornecedor['nome'] }}
        <br>
        Status: {{ $fornecedor['status'] }}
        <br>
        CPNJ: {{ $fornecedor['cnpj'] ?? 'Não informado' }}
        <br>
        DDD: {{ $fornecedor['ddd'] ?? 'Não informado' }} {{ $fornecedor['telefone'] ?? 'Não informado' }}
        @switch($fornecedor['ddd'])
            @case('11')
                São Paulo - SP
            @break

            @case('32')
                Juiz de Fora - MG
            @break

            @case('85')
                Fortaleza - Ceará
            @break

            @default
                Estado não identificado
            @break
        @endswitch
        @if ($loop->first)
            Primeira iteração do loop
        @endif
        @if ($loop->last)
            Última iteração do loop
        @endif
        <hr>
        @empty
            Bloco vazio
        @endforelse
    @endisset
