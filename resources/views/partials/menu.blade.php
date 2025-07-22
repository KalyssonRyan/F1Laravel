<head>
    <link rel="stylesheet" href="css/appmenu.css">
</head>
<nav class="navbar navbar-expand-lg border-bottom menu-nav bg-danger">
    <div class="container-fluid ">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="logo-mobile">
            <a href="?secao=home">
                <img src="https://media.formula1.com/image/upload/f_auto,c_limit,w_285,q_auto/f_auto/q_auto/fom-website/etc/designs/fom-website/images/F1_75_Logo"
                    alt="F1 Logo">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex flex-row align-items-center gap-3 ">
                <li class="nav-item"><a href="/" class="nav-link text-white">Home</a></li>
                <li class="nav-item"><a href="/pilotos" class="nav-link text-white">Pilotos</a></li>
                <li class="nav-item"><a href="/equipes" class="nav-link text-white">Equipes</a></li>
                <li class="nav-item dropdown">

                    
                    @auth
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Opções Pilotos
                    </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/pilotos/listar">Listar Pilotos</a></li>
                            <li><a class="dropdown-item" href="/pilotos/create">Adicioanr Piloto</a></li>
                        </ul>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Opções Notícias
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/noticias">Listar Notícias</a></li>
                            <li><a class="dropdown-item" href="/noticias/create">Adicionar Nova Notícia</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Opções Equipes
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/equipes/listar">Listar Equipes</a></li>
                            <li><a class="dropdown-item" href="/equipes/create">Adicionar Nova Equipe</a></li>
                        </ul>
                    </li>
                @else
                
                @endauth


                
            </ul>
        </div>
        <!-- Settings Dropdown -->
        @auth
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            @auth
                                <div>{{ Auth::user()->name }}</div>

                            @endauth

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        @endauth

       @if (Route::has('login'))
    <nav class="d-flex justify-content-end gap-3 lg:col-span-2">
        @auth
            {{-- <a href="{{ url('/dashboard') }}" class="btn btn-white border-2 border-dark px-4 py-2 text-dark hover:bg-danger hover:text-white focus:outline-none transition">
                Dashboard
            </a> --}}
        @else
            <a href="{{ route('login') }}" class="btn btn-white border-2 border-dark px-4 py-2 text-dark hover:bg-primary hover:text-white focus:outline-none transition">
                Log in
            </a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-white border-2 border-dark px-4 py-2 text-dark hover:bg-success hover:text-white focus:outline-none transition">
                    Register
                </a>
            @endif
        @endauth
    </nav>
@endif



    </div>
</nav>
