<x-layouts.panel>

    <div class="container-fluid px-4">
        <h2 class="mt-4">Mi Perfil Profesional</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Edita tu información, foto y CV</li>
        </ol>

        <x-ui.feedback />

        <div class="row">
            <div class="col-xl-4">
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Foto de Perfil</div>
                    <div class="card-body text-center">
                        @php
                            $foto = $usuario->perfil ? $usuario->perfil->foto_perfil : null;
                            $fotoUrl = $foto ? $foto->url_publica : asset('img/default-avatar.png'); // Asegúrate de tener una imagen default
                        @endphp
                        
                        <img class="img-account-profile rounded-circle mb-2" src="{{ $fotoUrl }}" alt="Foto de Perfil" style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #dee2e6;">
                        
                        <div class="small font-italic text-muted mb-4">JPG o PNG no mayor a 4MB</div>
                        
                        </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">Estado y CV</div>
                    <div class="card-body">
                        @if($usuario->perfil && $usuario->perfil->cv)
                            <div class="d-grid mb-3">
                                <a href="{{ $usuario->perfil->cv->url_publica }}" target="_blank" class="btn btn-outline-custom btn-info-outline-custom">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M13 12H16L12 16L8 12H11V8H13V12ZM15 4H5V20H19V8H15V4ZM3 2.9918C3 2.44405 3.44749 2 3.9985 2H16L20.9997 7L21 20.9925C21 21.5489 20.5551 22 20.0066 22H3.9934C3.44476 22 3 21.5447 3 21.0082V2.9918Z"></path></svg> Descargar mi CV actual
                                </a>
                            </div>
                        @else
                            <div class="alert alert-warning small">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12.8659 3.00017L22.3922 19.5002C22.6684 19.9785 22.5045 20.5901 22.0262 20.8662C21.8742 20.954 21.7017 21.0002 21.5262 21.0002H2.47363C1.92135 21.0002 1.47363 20.5525 1.47363 20.0002C1.47363 19.8246 1.51984 19.6522 1.60761 19.5002L11.1339 3.00017C11.41 2.52187 12.0216 2.358 12.4999 2.63414C12.6519 2.72191 12.7782 2.84815 12.8659 3.00017ZM4.20568 19.0002H19.7941L11.9999 5.50017L4.20568 19.0002ZM10.9999 16.0002H12.9999V18.0002H10.9999V16.0002ZM10.9999 9.00017H12.9999V14.0002H10.9999V9.00017Z"></path></svg> No has subido tu Curriculum Vitae.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

<div class="col-xl-8">
    <div class="card mb-4">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="perfilTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">Datos Generales</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="portada-tab" data-bs-toggle="tab" data-bs-target="#portada" type="button" role="tab" aria-controls="portada" aria-selected="false">Portada (Hero)</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="biografia-tab" data-bs-toggle="tab" data-bs-target="#biografia" type="button" role="tab" aria-controls="biografia" aria-selected="false">Biografía</button>
                </li>
            </ul>
        </div>
        
        <div class="card-body">
            
            <form id="formPerfil" action="{{ route('panel.perfil.editar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') 

                <div class="tab-content" id="perfilTabsContent">

                    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="nombres">Nombres (Usuario)</label>
                                <input class="form-control" id="nombres" type="text" value="{{ $usuario->nombres }}" disabled readonly>
                                <div class="form-text text-muted">Configuración de cuenta.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="correo">Correo Electrónico</label>
                                <input class="form-control" id="correo" type="text" value="{{ $usuario->correo }}" disabled readonly>
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="telefono">Teléfono de Contacto</label>
                                <input class="form-control" id="telefono" name="telefono" type="tel" placeholder="+569..." value="{{ old('telefono', $perfil->telefono ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="esta_disponible">Disponibilidad</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="esta_disponible" name="esta_disponible" value="1" 
                                    {{ old('esta_disponible', $perfil->esta_disponible ?? 0) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="esta_disponible">Disponible para ofertas</label>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <label class="small mb-1 fw-bold">Redes Sociales</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fab fa-linkedin"></i></span> <input type="url" class="form-control" name="redes[linkedin]" placeholder="URL de LinkedIn" 
                                value="{{ $perfil ? ($perfil->redesSociales->where('nombre_red', 'LinkedIn')->first()->url ?? '') : '' }}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fab fa-github"></i></span>
                            <input type="url" class="form-control" name="redes[github]" placeholder="URL de GitHub"
                                value="{{ $perfil ? ($perfil->redesSociales->where('nombre_red', 'GitHub')->first()->url ?? '') : '' }}">
                        </div>
                        
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1 fw-bold" for="imagen_portada">Actualizar Foto</label>
                                <input class="form-control" type="file" name="foto_perfil" accept="image/*">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1 fw-bold" for="archivo_cv">Actualizar CV (PDF)</label>
                                <input class="form-control" type="file" name="archivo_cv" accept=".pdf">
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="portada" role="tabpanel" aria-labelledby="portada-tab">
                        <div class="alert alert-info small mb-3">
                            Estos datos aparecerán en la pantalla principal "Hero" de tu sitio web.
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="ocupacion">Título Profesional / Ocupación</label>
                            <input class="form-control" id="ocupacion" name="ocupacion" type="text" 
                                placeholder="Ej: < DESARROLLADOR FULL STACK />" 
                                value="{{ old('ocupacion', $perfil->ocupacion ?? '') }}">
                            <div class="form-text">Este es el subtítulo grande debajo de tu nombre.</div>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="index_bio">Descripción Principal (Hero)</label>
                            <textarea class="form-control" id="index_bio" name="index_bio" rows="2" 
                                placeholder="Ej: Desarrollador con base en Sociología y Ciencias Exactas...">{{ old('index_bio', $perfil->index_bio ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="small mb-1" for="index_especialidad">Línea Secundaria / Especialidades</label>
                            <input class="form-control" id="index_especialidad" name="index_especialidad" type="text" 
                                placeholder="Ej: Especialista en Desarrollo Web, Lógica Algorítmica..." 
                                value="{{ old('index_especialidad', $perfil->index_especialidad ?? '') }}">
                        </div>
                    </div>

                    <div class="tab-pane fade" id="biografia" role="tabpanel" aria-labelledby="biografia-tab">
                        <div class="mb-3">
                            <label class="small mb-1" for="biografia">Biografía Completa</label>
                            <textarea class="form-control" id="biografia" name="biografia" rows="10" 
                                placeholder="Cuéntanos tu historia, tu experiencia detallada y tus objetivos...">{{ old('biografia', $perfil->biografia ?? '') }}</textarea>
                            <div class="form-text">Este texto aparecerá en la sección "Sobre Mí". Soporta saltos de línea.</div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="biografia_enfoque">Línea Secundaria / Especialidades</label>
                            <input class="form-control" id="biografia_enfoque" name="biografia_enfoque" type="text" 
                                placeholder="Ej: Enfoque: Primeros Principios. Descompongo problemas..." 
                                value="{{ old('biografia_enfoque', $perfil->biografia_enfoque ?? '') }}">
                        </div>
                    </div>

                </div> <div class="mt-4 text-end">
                    <button class="btn btn-primary-custom" type="submit">Guardar Todos los Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <h4 class="mb-3">Detalles de Trayectoria</h4>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-left-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title text-primary">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M7 5V2C7 1.44772 7.44772 1 8 1H16C16.5523 1 17 1.44772 17 2V5H21C21.5523 5 22 5.44772 22 6V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V6C2 5.44772 2.44772 5 3 5H7ZM4 16V19H20V16H4ZM4 14H20V7H4V14ZM9 3V5H15V3H9ZM11 11H13V13H11V11Z"></path></svg>
                                    Experiencia</h5>
                                <p class="card-text small text-muted">Gestiona tu historial laboral.</p>
                            </div>
                            <span class="h2 font-weight-bold text-gray-800">{{ $perfil ? $perfil->experiencias->count() : 0 }}</span>
                        </div>
                        <a href="{{ route('panel.perfil.experiencias.listar') }}" class="btn btn-sm btn-primary-outline-custom mt-3">Gestionar</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 border-left-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title text-success">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M4 11.3333L0 9L12 2L24 9V17.5H22V10.1667L20 11.3333V18.0113L19.7774 18.2864C17.9457 20.5499 15.1418 22 12 22C8.85817 22 6.05429 20.5499 4.22263 18.2864L4 18.0113V11.3333ZM6 12.5V17.2917C7.46721 18.954 9.61112 20 12 20C14.3889 20 16.5328 18.954 18 17.2917V12.5L12 16L6 12.5ZM3.96927 9L12 13.6846L20.0307 9L12 4.31541L3.96927 9Z"></path></svg>
                                    Educación</h5>
                                <p class="card-text small text-muted">Títulos y cursos realizados.</p>
                            </div>
                            <span class="h2 font-weight-bold text-gray-800">{{ $perfil ? $perfil->educacion->count() : 0 }}</span>
                        </div>
                        <a href="{{ route('panel.perfil.educacion.listar') }}" class="btn btn-sm btn-success-outline-custom mt-3">Gestionar</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 border-left-info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title text-info">
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M3 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3ZM4 5V19H20V5H4ZM20 12L16.4645 15.5355L15.0503 14.1213L17.1716 12L15.0503 9.87868L16.4645 8.46447L20 12ZM6.82843 12L8.94975 14.1213L7.53553 15.5355L4 12L7.53553 8.46447L8.94975 9.87868L6.82843 12ZM11.2443 17H9.11597L12.7557 7H14.884L11.2443 17Z"></path></svg>
                                    Certificaciones</h5>
                                <p class="card-text small text-muted">Certificaciones y capacitaciones realizadas.</p>
                            </div>
                            <span class="h2 font-weight-bold text-gray-800">0</span>
                        </div>
                        <a href="{{ route('panel.perfil.certificaciones.listar') }}" class="btn btn-sm btn-info-outline-custom mt-3">Gestionar</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-layouts.panel>