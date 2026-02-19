<x-layouts.panel>
    <div class="row mt-5 ms-2 me-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb font-mono x-small mb-1 text-uppercase">
                <li class="breadcrumb-item"><a href="{{ route('panel.inicio') }}" class="text-decoration-none text-muted">Panel</a></li>
                <li class="breadcrumb-item"><a href="{{ route('panel.perfil.editar.form') }}" class="text-decoration-none text-muted">Perfil</a></li>
                <li class="breadcrumb-item active text-dark">Experiencias Laborales</li>
            </ol>
        </nav>
        <h2 class="col-10">Listado de Experiencias Laborales</h2>
        <a class="btn btn-primary-custom d-flex align-items-center justify-content-center float-end col-2" href="{{ route('panel.perfil.experiencias.agregar.form') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 24px; height: 24px;"><path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path></svg>
            <span class="ms-1">Agregar Experiencia</span>
        </a>
    </div>
    <div class="m-3">
        <table id="tablaExperiencias" class="display table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cargo</th>
                        <th>Organización</th>
                        <th>Fecha inicio</th>
                        <th>Fecha término</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
        </table>
    </div>
    @push('scripts')
        <script>
            window.experiencias = @json($experiencias->items());
        </script>
        <script>
            const rutaEditarBase = "{{ route('panel.perfil.experiencias.editar.form') }}";
            const rutaEliminarBase = "{{ route('panel.perfil.experiencias.eliminar') }}";
        </script>
        <script src="{{ asset('js/portafolio/perfil/experiencias/listar.js') }}"></script>
    @endpush
</x-layouts.panel>