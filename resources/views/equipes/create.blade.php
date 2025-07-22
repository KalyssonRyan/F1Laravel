<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Notícia') }}
        </h2>
    </x-slot>

    <div class="container">
        <h1>Criar Notícia</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('equipes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nome">Nome da equipe:</label>
                <input type="text" class="form-control" name="nome" id="nome">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" name="descricao" id="descricao"></textarea>
            </div>
            <div class="form-group">
                <label for="foto">Foto:</label>
                <input type="file" class="form-control" name="foto" id="foto">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</x-app-layout>
