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
                                <a href="{{ $usuario->perfil->cv->url_publica }}" target="_blank" class="btn btn-outline-custom btn-info-custom">
                                    <i class="ri-file-download-line"></i> Descargar mi CV actual
                                </a>
                            </div>
                        @else
                            <div class="alert alert-warning small">
                                <i class="ri-alert-line"></i> No has subido tu Curriculum Vitae.
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
                                    <span class="input-group-text"><i class="ri-linkedin-fill"></i></span>
                                    <input type="url" class="form-control" name="redes[linkedin]" placeholder="URL de LinkedIn" 
                                        value="{{ $perfil ? ($perfil->redesSociales->where('nombre_red', 'LinkedIn')->first()->url ?? '') : '' }}">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ri-github-fill"></i></span>
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
                                <h5 class="card-title text-primary"><i class="ri-briefcase-line me-2"></i>Experiencia</h5>
                                <p class="card-text small text-muted">Gestiona tu historial laboral.</p>
                            </div>
                            <span class="h2 font-weight-bold text-gray-800">{{ $perfil ? $perfil->experiencias->count() : 0 }}</span>
                        </div>
                        <a href="#" class="btn btn-sm btn-outline-custom mt-3 stretched-link">Gestionar</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 border-left-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title text-success"><i class="ri-graduation-cap-line me-2"></i>Educación</h5>
                                <p class="card-text small text-muted">Títulos y cursos realizados.</p>
                            </div>
                            <span class="h2 font-weight-bold text-gray-800">{{ $perfil ? $perfil->educacion->count() : 0 }}</span>
                        </div>
                        <a href="#" class="btn btn-sm btn-outline-success mt-3 stretched-link">Gestionar</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 border-left-info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title text-info"><i class="ri-code-box-line me-2"></i>Certificaciones</h5>
                                <p class="card-text small text-muted">Certificaciones y capacitaciones realizadas.</p>
                            </div>
                            <span class="h2 font-weight-bold text-gray-800">0</span>
                        </div>
                        <a href="#" class="btn btn-sm btn-outline-info mt-3 stretched-link">Gestionar</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-layouts.panel>