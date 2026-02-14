<x-layouts.app>
    <div class="d-flex align-items-center justify-content-center min-vh-100 bg-light">

        <div class="card shadow-lg border-0 rounded-3" style="max-width: 500px; width: 100%;">
            <div class="card-body p-5">

                <div class="text-center mb-5">
                    <h3 class="fw-bold text-dark">Hola, {{ auth()->user()->nombres }}</h3>
                    <p class="text-muted">¿Cómo deseas ingresar hoy?</p>
                </div>

                <form action="{{ route('auth.seleccionar-perfil') }}" method="POST">
                    @csrf

                    <div class="d-grid gap-3">
                        
                        <button type="submit" name="perfilId" value="1" class="btn btn-select-profile p-4 text-start bg-white">
                            <div class="d-flex align-items-center">
                                <div class="me-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 14V16C8.68629 16 6 18.6863 6 22H4C4 17.5817 7.58172 14 12 14ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11ZM21 17H22V22H14V17H15V16C15 14.3431 16.3431 13 18 13C19.6569 13 21 14.3431 21 16V17ZM19 17V16C19 15.4477 18.5523 15 18 15C17.4477 15 17 15.4477 17 16V17H19Z"></path></svg>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">Modo Administrador</h5>
                                    <small class="text-muted">Gestión de usuarios y sistema</small>
                                </div>
                            </div>
                        </button>

                        <button type="submit" name="perfilId" value="2" class="btn btn-select-profile p-4 text-start bg-white">
                            <div class="d-flex align-items-center">
                                <div class="me-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM7 12H9C9 13.6569 10.3431 15 12 15C13.6569 15 15 13.6569 15 12H17C17 14.7614 14.7614 17 12 17C9.23858 17 7 14.7614 7 12Z"></path></svg>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">Mi Panel</h5>
                                    <small class="text-muted">Ver mis proyectos y perfil</small>
                                </div>
                            </div>
                        </button>

                    </div>
                </form>

                <div class="text-center mt-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-ghost-custom btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M5 22C4.44772 22 4 21.5523 4 21V3C4 2.44772 4.44772 2 5 2H19C19.5523 2 20 2.44772 20 3V6H18V4H6V20H18V18H20V21C20 21.5523 19.5523 22 19 22H5ZM18 16V13H11V11H18V8L23 12L18 16Z"></path></svg> Cancelar y Salir
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </div>

</x-layouts.app>