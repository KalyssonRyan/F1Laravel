<x-app-layout>
    <x-slot name="header">
        <h1>Editar Notícia</h1>
    </x-slot>

    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('noticias.update', $noticia) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" value="{{ $noticia->titulo }}">
            </div>

            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" name="descricao" id="descricao">{{ $noticia->descricao }}</textarea>
            </div>

            <div class="form-group">
                <label for="arquivo">Arquivo:</label>
                <input type="file" class="form-control" name="arquivo" id="arquivo">
                @if ($noticia->arquivo)
                    <a href="{{ asset($noticia->url) }}" target="_blank">Ver Arquivo Atual</a>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</x-app-layout>