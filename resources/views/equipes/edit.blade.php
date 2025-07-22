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

        <form action="{{ route('equipes.update', $equipe) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nome">Título:</label>
                <input type="text" class="form-control" name="nome" id="nome" value="{{ $equipe->nome }}">
            </div>

            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" name="descricao" id="descricao">{{ $equipe->descricao }}</textarea>
            </div>

            <div class="form-group">
                <label for="foto">foto:</label>
                <input type="file" class="form-control" name="foto" id="foto">
                @if ($equipe->foto)
                    <a href="{{ asset($equipe->foto) }}" target="_blank">Ver foto Atual</a>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</x-app-layout>