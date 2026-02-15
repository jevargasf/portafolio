<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('public.inicio') }}">
            ~/javier_vargas
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('public.inicio') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('public.proyectos') }}">Proyectos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('public.perfil') }}">Sobre Mí</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('public.blog') }}">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('panel.perfil.editar') }}">Panel</a>
                    </li>
                    <li class="nav-item"> <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 32px; height: 32px;"><path d="M4 18H6V20H18V4H6V6H4V3C4 2.44772 4.44772 2 5 2H19C19.5523 2 20 2.44772 20 3V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V18ZM6 11H13V13H6V16L1 12L6 8V11Z"></path></svg>
                            Salir
                        </a>
                    </li>
                @else
                @endauth
            </ul>
        </div>
    </div>
</nav>