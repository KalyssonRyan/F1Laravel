<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes da Equipe') }}
        </h2>
    </x-slot>

    <div class="container">
        <h1>Detalhes da Equipe</h1>

        <div class="card">
            <div class="card-body">
                <!-- Exibindo o nome da equipe -->
                <h5 class="card-title">{{ $equipe->titulo }}</h5>

                <!-- Exibindo a descrição da equipe -->
                <p><strong>Descrição:</strong> {{ $equipe->descricao }}</p>

                <!-- Exibindo a foto da equipe, se disponível -->
                @if ($equipe->foto)
                    <div>
                        <strong>Foto:</strong>
                        <img src="{{ asset($equipe->foto) }}" alt="Foto da Equipe" class="img-fluid" width="200">
                    </div>
                @else
                    <p><strong>Foto:</strong> Não disponível</p>
                @endif

                <!-- Botão para editar a equipe -->
                <a href="{{ route('equipes.edit', $equipe) }}" class="btn btn-warning">Editar</a>
            </div>
        </div>
    </div>
</x-app-layout>
