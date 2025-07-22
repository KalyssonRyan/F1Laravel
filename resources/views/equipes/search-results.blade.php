<x-app-layout title="Resultados da Busca">
    <div class="container py-12">
        <!-- Título da busca -->
        <div class="text-center mb-4">
            @if($equipes->isNotEmpty())
                <h2 class="text-primary">Resultados da busca para "<strong>{{ request('query') }}</strong>"</h2>
            @else
                <h2 class="text-danger">Nenhum resultado encontrado para "<strong>{{ request('query') }}</strong>"</h2>
            @endif
        </div>

        <!-- Se houver resultados, exibe as equipes encontradas -->
        @if($equipes->isNotEmpty())
            <div class="row">
                @foreach($equipes as $equipe)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <!-- Foto da equipe (se houver) -->
                            @if($equipe->foto)
                                <img src="{{ asset($equipe->foto) }}" class="card-img-top" alt="Foto de {{ $equipe->titulo }}">
                            @else
                                <img src="https://via.placeholder.com/150" class="card-img-top" alt="Imagem da equipe">
                            @endif
                            
                            <div class="card-body">
                                <h5 class="card-title">{{ $equipe->titulo }}</h5>
                                <p class="card-text">
                                    <strong>Descrição:</strong> {{ $equipe->descricao }}
                                </p>
                                <a href="{{ route('equipes.show', $equipe) }}" class="btn btn-info">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Exibe uma mensagem caso não haja resultados -->
        @if($equipes->isEmpty())
            <div class="alert alert-warning text-center">
                Nenhuma equipe encontrada para a busca realizada.
            </div>
        @endif
    </div>
</x-app-layout>
