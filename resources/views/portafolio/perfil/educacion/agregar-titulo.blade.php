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
                <i class="ri-arrow-left-line"></i> Volver
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
                                <i class="ri-information-line"></i> Si cursas actualmente, indica fecha estimada.
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
                            <i class="ri-save-line me-1"></i> Guardar Título
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