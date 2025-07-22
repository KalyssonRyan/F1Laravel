<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Página de Equipes') }}
        </h2>
    </x-slot>

    <div class="container py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-semibold mb-6">Equipes</h1>

                    @if ($equipes->isEmpty())
                        <p>Não há equipes disponíveis no momento.</p>
                    @else
                        <div class="row">
                            @foreach ($equipes as $equipe)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                    @if ($equipe->foto)
                                        <img src="{{ asset($equipe->foto) }}" alt="{{ $equipe->titulo }}" class="card-img-top">
                                    @else
                                        <img src="https://via.placeholder.com/150" alt="Imagem da Equipe" class="card-img-top">
                                    @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $equipe->titulo }}</h5>
                                            <p class="card-text"><strong>Descrição:</strong> {{ $equipe->descricao }}</p>
                                            <a href="{{ route('equipes.show', $equipe) }}" class="btn btn-primary">Ver Detalhes</a>
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
