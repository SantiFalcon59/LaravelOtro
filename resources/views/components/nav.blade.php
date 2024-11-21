<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('img/logo.svg') }}" alt="logo de empresa">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMovies"
            aria-controls="navbarMovies" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMovies">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <x-nav-link route="index" > Inicio </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link route="contact" > Contacto </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link route="movies.index" > Peliculas </x-nav-link>
                </li>
                @guest
                    <li class="nav-item">
                        <x-nav-link route="auth.login" > Iniciar Sesión </x-nav-link>
                    </li>
                @else
                    <li class="nav-item">
                        <form action="{{ route('auth.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link">
                                (Cerrar Sesion)
                            </button>
                        </form>
                    </li>
                @endguest

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{ auth()->user()->email }}</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
