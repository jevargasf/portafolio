<x-layouts.panel>
    <div class="row mt-5 ms-2 me-3">
        <h2 class="col-10">Listado de Entradas</h2>
        <a class="btn btn-primary-custom d-flex align-items-center justify-content-center float-end col-2" href="{{ route('panel.blog.crear.form') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 24px; height: 24px;"><path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"></path></svg>
            <span class="ms-1">Crear Entrada</span>
        </a>
    </div>
    <div class="m-3">
        <table id="tablaEntradas" class="display table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Estado</th>
                        <th>Scope</th>
                        <th>Fecha publicación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
        </table>
    </div>
    @push('scripts')
        <script>
            window.proyectos = @json($entradas->items());
        </script>
        <script>
            const rutaEditarBase = "{{ route('panel.blog.editar.form') }}";
            const rutaEliminarBase = "{{ route('panel.blog.eliminar') }}";
        </script>
        <script src="{{ asset('js/blog/listar.js') }}"></script>
    @endpush
</x-layouts.panel>