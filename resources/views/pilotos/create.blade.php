<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Piloto') }}
        </h2>
    </x-slot>

    <div class="container">
        <h1>Criar Piloto</h1>

        <!-- Exibição de erros de validação -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulário para criação de piloto -->
        <form action="{{ route('pilotos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Campo para Nome do Piloto -->
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" value="{{ old('nome') }}" required>
            </div>

            <!-- Campo para Nacionalidade do Piloto -->
            <div class="form-group">
                <label for="nacionalidade">Nacionalidade:</label>
                <input type="text" class="form-control" name="nacionalidade" id="nacionalidade" value="{{ old('nacionalidade') }}" required>
            </div>

            <!-- Campo para Data de Nascimento do Piloto -->
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" value="{{ old('data_nascimento') }}" required>
            </div>

            <!-- Campo para Foto do Piloto -->
            <div class="form-group">
                <label for="foto">Foto (opcional):</label>
                <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
            </div>

            <!-- Botão para Submeter o Formulário -->
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</x-app-layout>
