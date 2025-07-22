<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Página de Equipes') }}
        </h2>
    </x-slot>

    <!-- Filtro de Pesquisa -->
    <div class="col-12 text-center mb-4 mt-5">
        <h4 class="text-danger">Pesquisa</h4> <!-- Filtros estilizado -->
    </div>
    <form action="{{ route('equipes.search') }}" method="GET" class="d-flex justify-content-center p-5">
        <div class="input-group w-75">
            <input type="text" name="query" class="form-control form-control-lg" placeholder="Pesquisar..." aria-label="Pesquisar">
            <button type="submit" class="btn btn-danger btn-lg ms-2">
                <i class="bi bi-search"></i> Buscar
            </button>
        </div>
    </form>

    <!-- Formulário de Pesquisa e Filtro -->
    <form method="GET" action="{{ route('equipes.index') }}" class="col g-3 justify-content-center p-5">
        <div class="col-12 text-center mb-4">
            <h4 class="text-danger">Filtros</h4> <!-- Filtros estilizado -->
        </div>
        <div class="col-md-4">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" id="title" class="form-control form-control-lg" value="{{ request('title') }}" placeholder="Digite o título">
        </div>

        <div class="col-md-4">
            <label for="description" class="form-label">Descrição</label>
            <input type="text" name="description" id="description" class="form-control form-control-lg" value="{{ request('description') }}" placeholder="Digite a descrição">
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <!-- Botão para Filtrar -->
            <button type="submit" class="btn btn-danger btn-lg w-100">Filtrar</button>
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <!-- Botão para Limpar Filtros -->
            <a href="{{ route('equipes.index') }}" class="btn btn-secondary btn-lg w-100">Limpar Filtros</a>
        </div>
    </form>

    <!-- Exibição das Equipes -->
    <div class="container">
        <h1>Equipes</h1>
        <a href="{{ route('equipes.create') }}" class="btn btn-danger mb-3">Criar Equipe</a>

        @if ($message = Session::get('success'))
            <div class="alert alert-success mt-2">
                {{ $message }}
            </div>
        @endif

        @if($equipes->count())
            <table class="table table-bordered mt-2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipes as $equipe)
                        <tr>
                            <td>{{ $equipe->id }}</td>
                            <td>{{ $equipe->nome }}</td>
                            <td>{{ $equipe->descricao }}</td>
                            <td>
                                <form action="{{ route('equipes.destroy', $equipe->id) }}" method="POST">
                                    <a class="btn btn-info" href="{{ route('equipes.show', $equipe->id) }}">Ver</a>
                                    <a class="btn btn-warning" href="{{ route('equipes.edit', $equipe->id) }}">Editar</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Deletar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $equipes->links() }}
            </div>
        @else
            <p class="text-center">Nenhuma equipe encontrada.</p>
        @endif
    </div>
</x-app-layout>
