<nav class="nav">
    <div class="container-fluid">
        <a class="nav__brand" href="{{ route('public.inicio') }}">
            ~/javier_vargas
        </a>

        <button class="nav__toggler" type="button" id="btnToggler">
            <x-icons.hamburger-menu class="nav__icon" />
        </button>
        <div class="nav__collapse" id="nav">
            <ul class="nav__list">
                <li class="nav__item">
                    <a class="nav__link nav__link--active" href="{{ route('public.inicio') }}">Inicio</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="{{ route('public.proyectos') }}">Proyectos</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="{{ route('public.perfil') }}">Sobre Mí</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="{{ route('public.blog') }}">Blog</a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="#">Contacto</a>
                </li>
                @auth
                    <li class="nav__item">
                        <a class="nav__link" href="{{ route('panel.perfil.editar') }}">Panel</a>
                    </li>
                    <li class="nav__item"> <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <a class="nav__link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <x-icons.logout class="nav__icon"/>
                            Salir
                        </a>
                    </li>
                @else
                @endauth
            </ul>
        </div>
    </div>
</nav>