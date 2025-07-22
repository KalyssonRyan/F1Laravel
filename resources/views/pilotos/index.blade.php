<!-- resources/views/pilotos/index.blade.php -->


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Página de Pilotos') }}
        </h2>
    </x-slot>

    <div class="container py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-semibold mb-6">Pilotos</h1>

                    @if ($pilotos->isEmpty())
                        <p>Não há pilotos disponíveis no momento.</p>
                    @else
                        <div class="row">
                            @foreach ($pilotos as $piloto)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                    @if ($piloto->foto)
                                        <img src="{{ asset($piloto->foto) }}" alt="{{ $piloto->nome }}" class="card-img-top">
                                    @else
                                        <img src="https://via.placeholder.com/150" alt="Imagem do Piloto" class="card-img-top">
                                    @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $piloto->nome }}</h5>
                                            <p class="card-text"><strong>Nacionalidade:</strong> {{ $piloto->nacionalidade }}</p>
                                            <p class="card-text"><strong>Data de Nascimento:</strong> {{ \Carbon\Carbon::parse($piloto->data_nascimento)->format('d/m/Y') }}</p>
                                            <a href="{{ route('pilotos.show', $piloto) }}" class="btn btn-primary">Ver Detalhes</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
