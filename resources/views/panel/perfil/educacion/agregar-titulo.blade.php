<x-layouts.panel>

    <div class="container py-5">
        
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb font-mono x-small mb-1 text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('panel.inicio') }}" class="text-decoration-none text-muted">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('panel.perfil.educacion.listar') }}" class="text-decoration-none text-muted">Educación</a></li>
                        <li class="breadcrumb-item active text-dark">Nuevo Título</li>
                    </ol>
                </nav>
                <h1 class="h3 fw-bold mb-0 text-dark font-mono">Registrar Título Académico</h1>
            </div>
            <a href="{{ route('panel.perfil.educacion.listar') }}" class="btn btn-ghost-custom text-muted x-small">
                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M7.82843 10.9999H20V12.9999H7.82843L13.1924 18.3638L11.7782 19.778L4 11.9999L11.7782 4.22168L13.1924 5.63589L7.82843 10.9999Z"></path></svg> Volver
            </a>
        </div>

        <div class="card border shadow-sm rounded-0">
            <div class="card-body p-4">
                
                <form action="{{ route('panel.perfil.educacion.agregar') }}" method="POST">
                    @csrf

                    <div class="row g-4">
                        
                        {{-- Fila 1: Datos Principales --}}
                        <div class="col-md-6">
                            <label for="nombre_titulo" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Nombre del Título / Grado</label>
                            <input type="text" class="form-control rounded-0" id="nombre_titulo" name="nombre_titulo" 
                                   placeholder="Ej: Ingeniero Civil Informático" required value="{{ old('nombre_titulo') }}">
                            @error('nombre_titulo') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="institucion" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Institución Educativa</label>
                            <input type="text" class="form-control rounded-0" id="institucion" name="institucion" 
                                   placeholder="Ej: Universidad de Chile" required value="{{ old('institucion') }}">
                            @error('institucion') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        {{-- Fila 2: Ubicación --}}
                        <div class="col-md-6">
                            <label for="region_select" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Región</label>
                            <select class="form-select rounded-0" id="region_select">
                                <option value="" selected disabled>Seleccionar Región...</option>
                                @foreach($regiones as $region)
                                    <option value="{{ $region->id }}">{{ $region->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="comuna_id" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Comuna</label>
                            <select class="form-select rounded-0 bg-light" id="comuna_id" name="comuna_id" required disabled>
                                <option value="" selected disabled>Esperando Región...</option>
                            </select>
                            @error('comuna_id') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        {{-- Fila 3: Fechas --}}
                        <div class="col-md-6">
                            <label for="fecha_inicio" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Fecha Inicio</label>
                            <input type="date" class="form-control rounded-0" id="fecha_inicio" name="fecha_inicio" 
                                   required value="{{ old('fecha_inicio') }}">
                            @error('fecha_inicio') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="fecha_obtencion" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Fecha de Obtención / Egreso</label>
                            <input type="date" class="form-control rounded-0" id="fecha_obtencion" name="fecha_obtencion" 
                                   required value="{{ old('fecha_obtencion') }}">
                            <div class="form-text x-small font-mono text-muted mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM11 7H13V9H11V7ZM11 11H13V17H11V11Z"></path></svg> Si cursas actualmente, indica fecha estimada.
                            </div>
                            @error('fecha_obtencion') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        {{-- Estado Oculto --}}
                        <input type="hidden" name="estado" value="1">

                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-5 pt-4 border-top">
                        <a href="{{ route('panel.perfil.educacion.listar') }}" class="btn btn-ghost-custom text-muted">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary-custom px-4">
                            <svg class="me-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M7 19V13H17V19H19V7.82843L16.1716 5H5V19H7ZM4 3H17L21 7V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3ZM9 15V19H15V15H9Z"></path></svg> Guardar Título
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            window.regiones = @json($regiones);
        </script>
        {{-- USAMOS EL MISMO SCRIPT DE EXPERIENCIAS (Ruta corregida para reutilizar lógica) --}}
        <script src="{{ asset('js/portafolio/perfil/educacion/agregar.js') }}"></script>
    @endpush

</x-layouts.panel>