<x-app-layout title="Resultados da Busca">
    <div class="container py-12">
        <!-- Título da busca -->
        <div class="text-center mb-4">
            @if($noticias->isNotEmpty())
                <h2 class="text-primary">Resultados da busca para "<strong>{{ request('query') }}</strong>"</h2>
            @else
                <h2 class="text-danger">Nenhum resultado encontrado para "<strong>{{ request('query') }}</strong>"</h2>
            @endif
        </div>

        <!-- Se houver resultados, exibe as notícias encontradas -->
        @if($noticias->isNotEmpty())
            <div class="row">
                @foreach($noticias as $noticia)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $noticia->titulo }}</h5>
                                <img src="{{ asset($noticia->url) }}" class="card-img-top" >
                                <p class="card-text text-muted">{{ \Str::limit($noticia->descricao, 150) }}</p>
                                <a href="{{ route('noticias.show', $noticia) }}" class="btn btn-info btn-sm">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Exibe uma mensagem caso não haja resultados -->
        @if($noticias->isEmpty())
            <div class="alert alert-warning text-center">
                Nenhuma notícia encontrada para a busca realizada.
            </div>
        @endif
    </div>
</x-app-layout>
