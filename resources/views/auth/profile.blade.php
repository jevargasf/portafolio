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
                                    <i class="ri-admin-line"></i>
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
                                    <i class="ri-user-smile-line"></i>
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
                            <i class="ri-logout-box-r-line me-1"></i> Cancelar y Salir
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </div>

</x-layouts.app>