<ul class="nav flex-column p-4 h-100" id="sidebar">
  
  <a class="navbar-brand p-2 align-middle d-flex align-items-center mb-4" href="{{ route('inicio') }}">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 28px; height: 28px;" class="me-2 text-primary">
      <path d="M20.0833 15.1999L21.2854 15.9212C21.5221 16.0633 21.5989 16.3704 21.4569 16.6072C21.4146 16.6776 21.3557 16.7365 21.2854 16.7787L12.5144 22.0412C12.1977 22.2313 11.8021 22.2313 11.4854 22.0412L2.71451 16.7787C2.47772 16.6366 2.40093 16.3295 2.54301 16.0927C2.58523 16.0223 2.64413 15.9634 2.71451 15.9212L3.9166 15.1999L11.9999 20.0499L20.0833 15.1999ZM20.0833 10.4999L21.2854 11.2212C21.5221 11.3633 21.5989 11.6704 21.4569 11.9072C21.4146 11.9776 21.3557 12.0365 21.2854 12.0787L11.9999 17.6499L2.71451 12.0787C2.47772 11.9366 2.40093 11.6295 2.54301 11.3927C2.58523 11.3223 2.64413 11.2634 2.71451 11.2212L3.9166 10.4999L11.9999 15.3499L20.0833 10.4999ZM12.5144 1.30864L21.2854 6.5712C21.5221 6.71327 21.5989 7.0204 21.4569 7.25719C21.4146 7.32757 21.3557 7.38647 21.2854 7.42869L11.9999 12.9999L2.71451 7.42869C2.47772 7.28662 2.40093 6.97949 2.54301 6.7427C2.58523 6.67232 2.64413 6.61343 2.71451 6.5712L11.4854 1.30864C11.8021 1.11864 12.1977 1.11864 12.5144 1.30864ZM11.9999 3.33233L5.88723 6.99995L11.9999 10.6676L18.1126 6.99995L11.9999 3.33233Z"></path>
    </svg>
    <span class="fw-bold">
        Mi Panel
    </span>
  </a>
      
    <li class="nav-item">
    <span class="nav-link text-uppercase text-muted small mt-2">Mi Espacio</span>
    </li>

    <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('panel.inicio') ? 'active' : '' }}" 
        href="{{ route('panel.inicio') }}">
        <i class="ri-home-smile-line me-2"></i> Inicio
    </a>
    </li>

    <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('panel.proyectos.*') ? 'active' : '' }}" 
        href="{{ route('panel.proyectos.listar') }}">
        <i class="ri-folder-open-line me-2"></i> Mis Proyectos
    </a>
    </li>

    <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('panel.perfil.*') ? 'active' : '' }}" 
        href="{{ route('panel.perfil.editar.form') }}">
        <i class="ri-user-settings-line me-2"></i> Mi Perfil
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('public.inicio') ? 'active' : '' }}" 
        href="{{ route('public.inicio') }}">
        <i class="ri-home-smile-line me-2"></i> Volver Vista Pública
    </a>
    </li>
  <li class="nav-item mt-auto pt-4 border-top">
    <a class="nav-link" href="{{ route('auth.form-seleccionar-perfil') }}">
        <i class="ri-history-line me-2"></i> Seleccionar perfil
    </a>
  </li>
  <li class="nav-item"> 
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <a class="nav-link text-danger d-flex align-items-center" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 20px; height: 20px;" class="me-2">
            <path d="M4 18H6V20H18V4H6V6H4V3C4 2.44772 4.44772 2 5 2H19C19.5523 2 20 2.44772 20 3V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V18ZM6 11H13V13H6V16L1 12L6 8V11Z"></path>
        </svg>
        Cerrar Sesión
    </a>
  </li>

</ul>