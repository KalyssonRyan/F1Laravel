<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

   {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              //////////////////////////////////////////  <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}
    <div class="col-12 text-center mb-4 mt-5">
        <h4 class="text-danger">Pesquisa</h4> <!-- Filtros estilizado -->
    </div>
   <form action="{{ route('search') }}" method="GET" class="d-flex justify-content-center p-5">
    
    <div class="input-group w-75">
        <input type="text" name="query" class="form-control form-control-lg" placeholder="Pesquisar..." aria-label="Pesquisar">
        <button type="submit" class="btn btn-danger btn-lg ms-2">
            <i class="bi bi-search"></i> Buscar
        </button>
    </div>
</form>
   <!-- Formulário de Pesquisa e Filtro -->
<form method="GET" action="{{ route('noticias.index') }}" class="row g-3 justify-content-center p-5">
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
        <h1>Notícias</h1>
        <a href="{{ route('noticias.create') }}" class="btn btn-danger">Criar Notícia</a>
        @if ($message = Session::get('success'))
            <div class="alert alert-success mt-2">
                {{ $message }}
            </div>
        @endif

        @if($noticias->count())
            <table class="table table-bordered mt-2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>URL</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($noticias as $noticia)
                        <tr>
                            <td>{{ $noticia->id }}</td>
                            <td>{{ $noticia->titulo }}</td>
                            <td>{{ $noticia->descricao }}</td>
                            <td><a href="{{ $noticia->url }}" target="_blank">{{ $noticia->url }}</a></td>
                            <td>
                                <form action="{{ route('noticias.destroy', $noticia->id) }}" method="POST">
                                    <a class="btn btn-info" href="{{ route('noticias.show', $noticia->id) }}">Ver</a>
                                    <a class="btn btn-warning" href="{{ route('noticias.edit', $noticia->id) }}">Editar</a>
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
                {{ $noticias->links() }}
            </div>
        @else
            <p>No news found.</p>
        @endif
    </div>
</x-app-layout>
