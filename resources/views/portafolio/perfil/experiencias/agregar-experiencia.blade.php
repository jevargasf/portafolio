<x-layouts.panel>

    <div class="container py-5">
        
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb font-mono x-small mb-1 text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('panel.inicio') }}" class="text-decoration-none text-muted">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('panel.perfil.experiencias.listar') }}" class="text-decoration-none text-muted">Experiencia</a></li>
                        <li class="breadcrumb-item active text-dark">Nueva</li>
                    </ol>
                </nav>
                <h1 class="h3 fw-bold mb-0 text-dark font-mono">Registrar Experiencia</h1>
            </div>
            <a href="{{ route('panel.perfil.experiencias.listar') }}" class="btn btn-light border rounded-0 text-muted font-mono x-small">
                <i class="ri-arrow-left-line"></i> Volver
            </a>
        </div>

        <div class="card border shadow-sm rounded-0">
            <div class="card-body p-4">
                
                <form action="{{ route('panel.perfil.experiencias.agregar') }}" method="POST">
                    @csrf
                    
                    <div class="row g-4">
                        
                        <div class="col-md-6">
                            <label for="cargo" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Cargo / Rol</label>
                            <input type="text" class="form-control rounded-0" id="cargo" name="cargo" 
                                   placeholder="Ej: Full Stack Developer" required value="{{ old('cargo') }}">
                            @error('cargo') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="organizacion" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Organización / Empresa</label>
                            <input type="text" class="form-control rounded-0" id="organizacion" name="organizacion" 
                                   placeholder="Ej: Microsoft" required value="{{ old('organizacion') }}">
                            @error('organizacion') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

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

                        <div class="col-md-4">
                            <label for="fecha_inicio" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Fecha Inicio</label>
                            <input type="date" class="form-control rounded-0" id="fecha_inicio" name="fecha_inicio" 
                                   required value="{{ old('fecha_inicio') }}">
                            @error('fecha_inicio') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="fecha_fin" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Fecha Fin</label>
                            <input type="date" class="form-control rounded-0" id="fecha_fin" name="fecha_fin" 
                                   value="{{ old('fecha_fin') }}">
                            @error('fecha_fin') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-4 d-flex align-items-center pt-4">
                            <div class="form-check">
                                <input type="hidden" name="es_trabajo_actual" value="0">
                                <input class="form-check-input rounded-0" type="checkbox" value="1" id="es_trabajo_actual" name="es_trabajo_actual"
                                       {{ old('es_trabajo_actual') ? 'checked' : '' }}>
                                <label class="form-check-label font-mono x-small text-uppercase fw-bold pt-1" for="es_trabajo_actual">
                                    Es Trabajo Actual
                                </label>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="descripcion" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Descripción de Funciones</label>
                            <textarea class="form-control rounded-0" id="descripcion" name="descripcion" rows="5" 
                                      placeholder="Describe tus responsabilidades, tecnologías usadas y logros...">{{ old('descripcion') }}</textarea>
                            @error('descripcion') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        <input type="hidden" name="estado" value="1">

                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-5 pt-4 border-top">
                        <a href="{{ route('panel.perfil.experiencias.listar') }}" class="btn btn-light border rounded-0 font-mono text-muted">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-dark rounded-0 font-mono px-4">
                            <i class="ri-save-line me-1"></i> Guardar Experiencia
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
        <script src="{{ asset('js/portafolio/perfil/experiencias/agregar.js') }}"></script>
    @endpush

</x-layouts.panel>