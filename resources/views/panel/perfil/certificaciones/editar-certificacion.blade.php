<x-layouts.panel>

    <div class="container py-5">
        
        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb font-mono x-small mb-1 text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('panel.inicio') }}" class="text-decoration-none text-muted">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('panel.perfil.certificaciones.listar') }}" class="text-decoration-none text-muted">Certificaciones</a></li>
                        <li class="breadcrumb-item active text-dark">Editar</li>
                    </ol>
                </nav>
                <h1 class="h3 fw-bold mb-0 text-dark font-mono">Editar Certificación</h1>
            </div>
            <a href="{{ route('panel.perfil.certificaciones.listar') }}" class="btn btn-ghost-custom text-muted x-small">
                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M7.82843 10.9999H20V12.9999H7.82843L13.1924 18.3638L11.7782 19.778L4 11.9999L11.7782 4.22168L13.1924 5.63589L7.82843 10.9999Z"></path></svg> Volver
            </a>
        </div>

        <div class="card border shadow-sm rounded-0">
            <div class="card-body p-4">
                
                {{-- FORMULARIO --}}
                {{-- Asegúrate de que la ruta 'update' exista en tu web.php --}}
                <form action="{{ route('panel.perfil.certificaciones.editar') }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- ID OCULTO (CRÍTICO PARA EL CONTROLADOR) --}}
                    <input type="hidden" name="id" value="{{ $certificacion->id }}">

                    <div class="row g-4">
                        
                        {{-- Fila 1: Datos Básicos --}}
                        <div class="col-md-6">
                            <label for="nombre" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Nombre del Curso / Certificación</label>
                            <input type="text" class="form-control rounded-0" id="nombre" name="nombre" 
                                   placeholder="Ej: Curso de Laravel Avanzado" required 
                                   value="{{ old('nombre', $certificacion->nombre) }}">
                            @error('nombre') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="organizacion" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Organización / Plataforma</label>
                            <input type="text" class="form-control rounded-0" id="organizacion" name="organizacion" 
                                   placeholder="Ej: Udemy, Coursera" required 
                                   value="{{ old('organizacion', $certificacion->organizacion) }}">
                            @error('organizacion') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        {{-- Fila 2: Detalles Específicos --}}
                        <div class="col-md-4">
                            <label for="numero_horas" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Número de Horas</label>
                            <div class="input-group">
                                <input type="number" class="form-control rounded-0" id="numero_horas" name="numero_horas" 
                                       placeholder="Ej: 40" min="1" required 
                                       value="{{ old('numero_horas', $certificacion->numero_horas) }}">
                                <span class="input-group-text rounded-0 bg-light text-muted font-mono x-small">Hrs</span>
                            </div>
                            @error('numero_horas') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-8">
                            <label for="url_certificado" class="form-label font-mono x-small text-uppercase text-muted fw-bold">URL del Certificado (Opcional)</label>
                            <div class="input-group">
                                <span class="input-group-text rounded-0 bg-light border-end-0 text-muted"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M18.3638 15.5355L16.9496 14.1213L18.3638 12.7071C20.3164 10.7545 20.3164 7.58866 18.3638 5.63604C16.4112 3.68341 13.2453 3.68341 11.2927 5.63604L9.87849 7.05025L8.46428 5.63604L9.87849 4.22182C12.6122 1.48815 17.0443 1.48815 19.778 4.22182C22.5117 6.95549 22.5117 11.3876 19.778 14.1213L18.3638 15.5355ZM15.5353 18.364L14.1211 19.7782C11.3875 22.5118 6.95531 22.5118 4.22164 19.7782C1.48797 17.0445 1.48797 12.6123 4.22164 9.87868L5.63585 8.46446L7.05007 9.87868L5.63585 11.2929C3.68323 13.2455 3.68323 16.4113 5.63585 18.364C7.58847 20.3166 10.7543 20.3166 12.7069 18.364L14.1211 16.9497L15.5353 18.364ZM14.8282 7.75736L16.2425 9.17157L9.17139 16.2426L7.75717 14.8284L14.8282 7.75736Z"></path></svg></span>
                                <input type="url" class="form-control rounded-0 border-start-0 ps-0" id="url_certificado" name="url_certificado" 
                                       placeholder="https://..." 
                                       value="{{ old('url_certificado', $certificacion->url_certificado) }}">
                            </div>
                            @error('url_certificado') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        {{-- Fila 3: Fechas --}}
                        <div class="col-md-6">
                            <label for="fecha_inicio" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Fecha Inicio / Emisión</label>
                            {{-- NOTA: Usamos 'format' porque el input date requiere Y-m-d estricto --}}
                            <input type="date" class="form-control rounded-0" id="fecha_inicio" name="fecha_inicio" 
                                   required 
                                   value="{{ old('fecha_inicio', optional($certificacion->fecha_inicio)->format('Y-m-d')) }}">
                            @error('fecha_inicio') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="fecha_fin" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Fecha Término / Vencimiento</label>
                            <input type="date" class="form-control rounded-0" id="fecha_fin" name="fecha_fin" 
                                   value="{{ old('fecha_fin', optional($certificacion->fecha_fin)->format('Y-m-d')) }}">
                            <div class="form-text x-small font-mono text-muted mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM11 7H13V9H11V7ZM11 11H13V17H11V11Z"></path></svg> Dejar vacío si no aplica o es indefinido.
                            </div>
                            @error('fecha_fin') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        {{-- Fila 4: Descripción --}}
                        <div class="col-12">
                            <label for="descripcion" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Descripción / Habilidades</label>
                            {{-- En textareas, el valor va DENTRO de las etiquetas, no en un atributo value --}}
                            <textarea class="form-control rounded-0" id="descripcion" name="descripcion" rows="3" 
                                      placeholder="Breve resumen...">{{ old('descripcion', $certificacion->descripcion) }}</textarea>
                            @error('descripcion') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        {{-- Fila 5: Estado --}}
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input type="hidden" name="estado" value="0">
                                {{-- Verificamos si es 1 para marcar checked --}}
                                <input class="form-check-input" type="checkbox" role="switch" id="estado" name="estado" value="1" 
                                       {{ old('estado', $certificacion->estado) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label font-mono x-small text-uppercase text-muted fw-bold ms-2" for="estado">
                                    Visible en Portafolio
                                </label>
                            </div>
                        </div>

                    </div>

                    {{-- Botones --}}
                    <div class="d-flex justify-content-end gap-3 mt-5 pt-4 border-top">
                        <a href="{{ route('panel.perfil.certificaciones.listar') }}" class="btn btn-ghost-custom text-muted">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary-custom px-4">
                            <svg class="me-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M7 19V13H17V19H19V7.82843L16.1716 5H5V19H7ZM4 3H17L21 7V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3ZM9 15V19H15V15H9Z"></path></svg> Actualizar Certificación
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</x-layouts.panel>