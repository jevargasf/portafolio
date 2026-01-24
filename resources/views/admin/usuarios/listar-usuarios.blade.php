<x-layouts.dashboard>
    <div class="row mt-5 ms-2 me-3">
        <h2 class="col-10">Listado de Usuarios</h2>
        <a class="btn btn-primary btn-action float-end col-2" href="{{ route('admin.usuarios.crear.form') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 24px; height: 24px;"><path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path></svg>
            Crear Usuario
        </a>
    </div>
    <div class="m-3">
        <table id="tablaUsuarios" class="display table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>RUN</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
        </table>
    </div>
    @push('scripts')
        <script>
            window.usuarios = @json($usuarios->items());
        </script>
        <script src="{{ asset('js/usuarios/listar.js') }}"></script>
    @endpush
</x-layouts.dashboard>