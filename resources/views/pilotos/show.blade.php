<!-- resources/views/pilotos/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Piloto') }}
        </h2>
    </x-slot>

    <div class="container">
        <h1>Detalhes do Piloto</h1>

        <div class="card">
            <div class="card-body">
                <!-- Exibindo o nome do piloto -->
                <h5 class="card-title">{{ $piloto->nome }}</h5>

                <!-- Exibindo a nacionalidade do piloto -->
                <p><strong>Nacionalidade:</strong> {{ $piloto->nacionalidade }}</p>

                <!-- Exibindo a data de nascimento -->
                <p><strong>Data de Nascimento:</strong> {{ \Carbon\Carbon::parse($piloto->data_nascimento)->format('d/m/Y') }}</p>

                <!-- Exibindo a foto do piloto, se disponível -->
                @if ($piloto->foto)
                    <div>
                        <strong>Foto:</strong>
                        <img src="{{ asset($piloto->foto) }}" alt="Foto do Piloto" class="img-fluid" width="200">
                    </div>
                @else
                    <p><strong>Foto:</strong> Não disponível</p>
                @endif

                <!-- Botão para editar o piloto -->
                <a href="{{ route('pilotos.edit', $piloto) }}" class="btn btn-warning">Editar</a>
            </div>
        </div>
    </div>
</x-app-layout>
