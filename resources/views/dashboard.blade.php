{{-- @include('layouts.navigation') --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Pesquisar...">
        <button type="submit" class="btn btn-primary ">Buscar</button>
    </form>

   <!-- Formulário de Pesquisa e Filtro -->
<form method="GET" action="{{ route('noticias.index') }}">
    <div class="form-group">
        <label for="title">Título</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ request('title') }}">
    </div>
    
    <div class="form-group">
        <label for="description">Descrição</label>
        <input type="text" name="description" id="description" class="form-control" value="{{ request('description') }}">
    </div>
    
    <button type="submit" class="btn btn-primary">Filtrar</button>

    <!-- Botão para Limpar Filtros -->
    <a href="{{ route('noticias.index') }}" class="btn btn-secondary">Limpar Filtros</a>
</form>
    

<div class="container">
        <h1>Notícias</h1>
        <a href="{{ route('noticias.create') }}" class="btn btn-primary">Criar Notícia</a>
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
                                    <a class="btn btn-primary" href="{{ route('noticias.edit', $noticia->id) }}">Editar</a>
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
