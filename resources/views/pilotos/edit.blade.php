<!-- resources/views/pilotos/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Piloto') }}
        </h2>
    </x-slot>

    <div class="container">
        <h1>Editar Piloto</h1>

        <!-- Exibição de mensagem de sucesso, se houver -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulário para editar o piloto -->
        <form action="{{ route('pilotos.update', $piloto) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Campo para o nome do piloto -->
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" value="{{ old('nome', $piloto->nome) }}" required>
            </div>

            <!-- Campo para a nacionalidade do piloto -->
            <div class="form-group">
                <label for="nacionalidade">Nacionalidade:</label>
                <input type="text" class="form-control" name="nacionalidade" id="nacionalidade" value="{{ old('nacionalidade', $piloto->nacionalidade) }}" required>
            </div>

            <!-- Campo para a data de nascimento do piloto -->
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" value="{{ old('data_nascimento', $piloto->data_nascimento) }}" required>
            </div>

            <!-- Campo para a foto do piloto -->
            <div class="form-group">
                <label for="foto">Foto (opcional):</label>
                <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                @if($piloto->foto)
                    <div class="mt-2">
                        <img src="{{ asset($piloto->foto) }}" alt="Foto do Piloto" class="img-fluid" width="200">
                    </div>
                @endif
            </div>

            <!-- Botão para salvar as alterações -->
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</x-app-layout>
