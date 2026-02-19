<x-layouts.panel>

    <div class="container py-5">
        
        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb font-mono x-small mb-1 text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('panel.inicio') }}" class="text-decoration-none text-muted">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('panel.perfil.certificaciones.listar') }}" class="text-decoration-none text-muted">Certificaciones</a></li>
                        <li class="breadcrumb-item active text-dark">Nueva</li>
                    </ol>
                </nav>
                <h1 class="h3 fw-bold mb-0 text-dark font-mono">Registrar Certificación</h1>
            </div>
            <a href="{{ route('panel.perfil.certificaciones.listar') }}" class="btn btn-ghost-custom text-muted x-small">
                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M7.82843 10.9999H20V12.9999H7.82843L13.1924 18.3638L11.7782 19.778L4 11.9999L11.7782 4.22168L13.1924 5.63589L7.82843 10.9999Z"></path></svg> Volver
            </a>
        </div>

        <div class="card border shadow-sm rounded-0">
            <div class="card-body p-4">
                
                {{-- FORMULARIO --}}
                <form action="{{ route('panel.perfil.certificaciones.agregar') }}" method="POST">
                    @csrf

                    <div class="row g-4">
                        
                        {{-- Fila 1: Datos Básicos --}}
                        <div class="col-md-6">
                            <label for="nombre" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Nombre del Curso / Certificación</label>
                            <input type="text" class="form-control rounded-0" id="nombre" name="nombre" 
                                   placeholder="Ej: Curso de Laravel Avanzado" required value="{{ old('nombre') }}">
                            @error('nombre') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="organizacion" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Organización / Plataforma</label>
                            <input type="text" class="form-control rounded-0" id="organizacion" name="organizacion" 
                                   placeholder="Ej: Udemy, Coursera, Google" required value="{{ old('organizacion') }}">
                            @error('organizacion') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        {{-- Fila 2: Detalles Específicos (Horas y URL) --}}
                        <div class="col-md-4">
                            <label for="numero_horas" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Número de Horas</label>
                            <div class="input-group">
                                <input type="number" class="form-control rounded-0" id="numero_horas" name="numero_horas" 
                                       placeholder="Ej: 40" min="1" required value="{{ old('numero_horas') }}">
                                <span class="input-group-text rounded-0 bg-light text-muted font-mono x-small">Hrs</span>
                            </div>
                            @error('numero_horas') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-8">
                            <label for="url_certificado" class="form-label font-mono x-small text-uppercase text-muted fw-bold">URL del Certificado (Opcional)</label>
                            <div class="input-group">
                                <span class="input-group-text rounded-0 bg-light border-end-0 text-muted"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M18.3638 15.5355L16.9496 14.1213L18.3638 12.7071C20.3164 10.7545 20.3164 7.58866 18.3638 5.63604C16.4112 3.68341 13.2453 3.68341 11.2927 5.63604L9.87849 7.05025L8.46428 5.63604L9.87849 4.22182C12.6122 1.48815 17.0443 1.48815 19.778 4.22182C22.5117 6.95549 22.5117 11.3876 19.778 14.1213L18.3638 15.5355ZM15.5353 18.364L14.1211 19.7782C11.3875 22.5118 6.95531 22.5118 4.22164 19.7782C1.48797 17.0445 1.48797 12.6123 4.22164 9.87868L5.63585 8.46446L7.05007 9.87868L5.63585 11.2929C3.68323 13.2455 3.68323 16.4113 5.63585 18.364C7.58847 20.3166 10.7543 20.3166 12.7069 18.364L14.1211 16.9497L15.5353 18.364ZM14.8282 7.75736L16.2425 9.17157L9.17139 16.2426L7.75717 14.8284L14.8282 7.75736Z"></path></svg></span>
                                <input type="url" class="form-control rounded-0 border-start-0 ps-0" id="url_certificado" name="url_certificado" 
                                       placeholder="https://certificado.com/verificar/..." value="{{ old('url_certificado') }}">
                            </div>
                            @error('url_certificado') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        {{-- Fila 3: Fechas --}}
                        <div class="col-md-6">
                            <label for="fecha_inicio" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Fecha Inicio</label>
                            <input type="date" class="form-control rounded-0" id="fecha_inicio" name="fecha_inicio" 
                                   required value="{{ old('fecha_inicio') }}">
                            @error('fecha_inicio') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="fecha_fin" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Fecha Término</label>
                            <input type="date" class="form-control rounded-0" id="fecha_fin" name="fecha_fin" 
                                   value="{{ old('fecha_fin') }}">
                            @error('fecha_fin') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        {{-- Fila 4: Descripción --}}
                        <div class="col-12">
                            <label for="descripcion" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Descripción / Habilidades Aprendidas</label>
                            <textarea class="form-control rounded-0" id="descripcion" name="descripcion" rows="3" 
                                      placeholder="Breve resumen de lo aprendido...">{{ old('descripcion') }}</textarea>
                            @error('descripcion') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                        </div>

                        {{-- Fila 5: Estado --}}
                        <div class="col-12">
                            <div class="form-check form-switch">
                                {{-- Input hidden para enviar '0' si el switch está apagado --}}
                                <input type="hidden" name="estado" value="0">
                                <input class="form-check-input" type="checkbox" role="switch" id="estado" name="estado" value="1" checked>
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
                            <svg class="me-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M7 19V13H17V19H19V7.82843L16.1716 5H5V19H7ZM4 3H17L21 7V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3ZM9 15V19H15V15H9Z"></path></svg> Guardar Certificación
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</x-layouts.panel>