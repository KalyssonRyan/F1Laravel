<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Pilotos') }}
        </h2>
    </x-slot>
    <div class="col-12 text-center mb-4 mt-5">
        <h4 class="text-danger">Pesquisa</h4> <!-- Filtros estilizado -->
    </div>
   <form action="{{ route('pilotos.search') }}" method="GET" class="d-flex justify-content-center p-5">
    
    <div class="input-group w-75">
        <input type="text" name="query" class="form-control form-control-lg" placeholder="Pesquisar..." aria-label="Pesquisar">
        <button type="submit" class="btn btn-danger btn-lg ms-2">
            <i class="bi bi-search"></i> Buscar
        </button>
    </div>
</form>
   <!-- Formulário de Pesquisa e Filtro -->
<form method="GET" action="{{ route('pilotos.index') }}" class="row g-3 justify-content-center p-5">
    <div class="col-12 text-center mb-4">
        <h4 class="text-danger">Filtros</h4> <!-- Filtros estilizado -->
    </div>
    <div class="row-md-4">
        <label for="title" class="form-label">Título</label>
        <input type="text" name="title" id="title" class="form-control form-control-lg" value="{{ request('title') }}" placeholder="Digite o título">
    </div>

    <div class="row-md-4">
        <label for="description" class="form-label">Descrição</label>
        <input type="text" name="description" id="description" class="form-control form-control-lg" value="{{ request('description') }}" placeholder="Digite a descrição">
    </div>

    <div class="row-md-4 d-flex align-items-end">
        <!-- Botão para Filtrar -->
        <button type="submit" class="btn btn-danger btn-lg w-100">Filtrar</button>
    </div>

    <div class="row-md-4 d-flex align-items-end">
        <!-- Botão para Limpar Filtros -->
        <a href="{{ route('noticias.index') }}" class="btn btn-secondary btn-lg w-100">Limpar Filtros</a>
    </div>
</form>
    <div class="container">
        <h1>Lista de Pilotos</h1>

        <!-- Exibição de mensagem de sucesso, se houver -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabela de Pilotos -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Nacionalidade</th>
                    <th>Data de Nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pilotos as $piloto)
                <tr>
                    <td>{{ $piloto->id }}</td>
                    <td>{{ $piloto->nome }}</td>
                    <td>{{ $piloto->nacionalidade }}</td>
                    <td>{{ \Carbon\Carbon::parse($piloto->data_nascimento)->format('d/m/Y') }}</td>
                    <td>
                        <!-- Link para exibir detalhes do piloto -->
                        <a href="{{ route('pilotos.show', $piloto) }}" class="btn btn-info btn-sm">Ver</a>

                        <!-- Link para editar o piloto -->
                        <a href="{{ route('pilotos.edit', $piloto) }}" class="btn btn-warning btn-sm">Editar</a>

                        <!-- Formulário para deletar o piloto -->
                        <form action="{{ route('pilotos.destroy', $piloto) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este piloto?')">Deletar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginação -->
        {{ $pilotos->links() }}
    </div>
</x-app-layout>