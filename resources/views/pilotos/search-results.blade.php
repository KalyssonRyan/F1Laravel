<x-app-layout title="Resultados da Busca">
    <div class="container py-12">
        <!-- Título da busca -->
        <div class="text-center mb-4">
            @if($pilotos->isNotEmpty())
                <h2 class="text-primary">Resultados da busca para "<strong>{{ request('query') }}</strong>"</h2>
            @else
                <h2 class="text-danger">Nenhum resultado encontrado para "<strong>{{ request('query') }}</strong>"</h2>
            @endif
        </div>

        <!-- Se houver resultados, exibe os pilotos encontrados -->
        @if($pilotos->isNotEmpty())
            <div class="row">
                @foreach($pilotos as $piloto)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <!-- Foto do piloto (se houver) -->
                            @if($piloto->foto)
                                <img src="{{ asset($piloto->foto) }}" class="card-img-top" alt="Foto de {{ $piloto->nome }}">
                            @else
                                <img src="https://via.placeholder.com/150" class="card-img-top" alt="Imagem do piloto">
                            @endif
                            
                            <div class="card-body">
                                <h5 class="card-title">{{ $piloto->nome }}</h5>
                                <p class="card-text">
                                    <strong>Nacionalidade:</strong> {{ $piloto->nacionalidade }}<br>
                                    <strong>Data de Nascimento:</strong> {{ \Carbon\Carbon::parse($piloto->data_nascimento)->format('d/m/Y') }}
                                </p>
                                <a href="{{ route('pilotos.show', $piloto) }}" class="btn btn-info">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Exibe uma mensagem caso não haja resultados -->
        @if($pilotos->isEmpty())
            <div class="alert alert-warning text-center">
                Nenhum piloto encontrado para a busca realizada.
            </div>
        @endif
    </div>
</x-app-layout>
