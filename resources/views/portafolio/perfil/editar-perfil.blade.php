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
                    <div class="card-header">Detalles de la Cuenta</div>
                    <div class="card-body">
                        
                        <form id="formPerfil" action="{{ route('panel.perfil.editar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') 

                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="nombres">Nombres (Usuario)</label>
                                    <input class="form-control" id="nombres" type="text" value="{{ $usuario->nombres }}" disabled readonly>
                                    <div class="form-text text-muted">Para cambiar tu nombre o correo, ve a configuración de cuenta.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="correo">Correo Electrónico</label>
                                    <input class="form-control" id="correo" type="text" value="{{ $usuario->correo }}" disabled readonly>
                                </div>
                            </div>

                            <hr>

                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="ocupacion">Ocupación / Título Profesional</label>
                                    <input class="form-control" id="ocupacion" name="ocupacion" type="text" placeholder="Ej: Desarrollador Full Stack" value="{{ old('ocupacion', $perfil->ocupacion ?? '') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="telefono">Teléfono de Contacto</label>
                                    <input class="form-control" id="telefono" name="telefono" type="tel" placeholder="+569..." value="{{ old('telefono', $perfil->telefono ?? '') }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1" for="biografia">Biografía / Resumen Profesional</label>
                                <textarea class="form-control" id="biografia" name="biografia" rows="4" placeholder="Cuéntanos sobre ti, tu experiencia y tus objetivos...">{{ old('biografia', $perfil->biografia ?? '') }}</textarea>
                            </div>

                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1 fw-bold" for="imagen_portada">Actualizar Foto de Perfil</label>
                                    <input class="form-control" type="file" name="foto_perfil" accept="image/*">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1 fw-bold" for="archivo_cv">Subir/Actualizar CV (PDF)</label>
                                    <input class="form-control" type="file" name="archivo_cv" accept=".pdf">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="small mb-1 fw-bold">Enlaces Profesionales</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M6.94048 4.99993C6.94011 5.81424 6.44608 6.54702 5.69134 6.85273C4.9366 7.15845 4.07187 6.97605 3.5049 6.39155C2.93793 5.80704 2.78195 4.93715 3.1105 4.19207C3.43906 3.44699 4.18654 2.9755 5.00048 2.99993C6.08155 3.03238 6.94097 3.91837 6.94048 4.99993ZM7.00048 8.47993H3.00048V20.9999H7.00048V8.47993ZM13.3205 8.47993H9.34048V20.9999H13.2805V14.4299C13.2805 10.7699 18.0505 10.4299 18.0505 14.4299V20.9999H22.0005V13.0699C22.0005 6.89993 14.9405 7.12993 13.2805 10.1599L13.3205 8.47993Z"></path></svg>
                                    </span>
                                    <input type="url" class="form-control" name="redes[linkedin]" placeholder="URL de LinkedIn" 
                                        value="{{ $perfil ? ($perfil->redesSociales->where('nombre_red', 'LinkedIn')->first()->url ?? '') : '' }}">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12.001 2C6.47598 2 2.00098 6.475 2.00098 12C2.00098 16.425 4.86348 20.1625 8.83848 21.4875C9.33848 21.575 9.52598 21.275 9.52598 21.0125C9.52598 20.775 9.51348 19.9875 9.51348 19.15C7.00098 19.6125 6.35098 18.5375 6.15098 17.975C6.03848 17.6875 5.55098 16.8 5.12598 16.5625C4.77598 16.375 4.27598 15.9125 5.11348 15.9C5.90098 15.8875 6.46348 16.625 6.65098 16.925C7.55098 18.4375 8.98848 18.0125 9.56348 17.75C9.65098 17.1 9.91348 16.6625 10.201 16.4125C7.97598 16.1625 5.65098 15.3 5.65098 11.475C5.65098 10.3875 6.03848 9.4875 6.67598 8.7875C6.57598 8.5375 6.22598 7.5125 6.77598 6.1375C6.77598 6.1375 7.61348 5.875 9.52598 7.1625C10.326 6.9375 11.176 6.825 12.026 6.825C12.876 6.825 13.726 6.9375 14.526 7.1625C16.4385 5.8625 17.276 6.1375 17.276 6.1375C17.826 7.5125 17.476 8.5375 17.376 8.7875C18.0135 9.4875 18.401 10.375 18.401 11.475C18.401 15.3125 16.0635 16.1625 13.8385 16.4125C14.201 16.725 14.5135 17.325 14.5135 18.2625C14.5135 19.6 14.501 20.675 14.501 21.0125C14.501 21.275 14.6885 21.5875 15.1885 21.4875C19.259 20.1133 21.9999 16.2963 22.001 12C22.001 6.475 17.526 2 12.001 2Z"></path></svg>
                                    </span>
                                    <input type="url" class="form-control" name="redes[github]" placeholder="URL de GitHub"
                                        value="{{ $perfil ? ($perfil->redesSociales->where('nombre_red', 'GitHub')->first()->url ?? '') : '' }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="esta_disponible" name="esta_disponible" value="1" 
                                    {{ old('esta_disponible', $perfil->esta_disponible ?? 0) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="esta_disponible">Estoy disponible para nuevas ofertas laborales</label>
                                </div>
                            </div>

                            <button class="btn btn-primary-custom" type="submit">Guardar Cambios del Perfil</button>
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