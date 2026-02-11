<x-layouts.panel>
    @push('head')
    <script src="https://cdn.tiny.cloud/1/20vvoyoklfl2p1xc7h86d36uv1g96toffzlwcv5olapa54bb/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
    @endpush
    <div class="container py-5">
        
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb font-mono x-small mb-1 text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('panel.inicio') }}" class="text-decoration-none text-muted">Panel</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('panel.blog.listar') }}" class="text-decoration-none text-muted">Blog</a></li>
                        <li class="breadcrumb-item active text-dark">Nueva Entrada</li>
                    </ol>
                </nav>
                <h1 class="h3 fw-bold mb-0 text-dark font-mono">Escribir Entrada</h1>
            </div>
            <a href="{{ route('panel.blog.listar') }}" class="btn btn-ghost-custom text-muted x-small">
                <i class="ri-arrow-left-line"></i> Volver
            </a>
        </div>

        <form action="{{ route('panel.blog.crear') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row g-4">
                
                <div class="col-lg-8">
                    <div class="card border shadow-sm rounded-0 h-100">
                        <div class="card-body p-4">
                            
                            <div class="mb-4">
                                <label for="titulo" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Título del Post</label>
                                <input type="text" class="form-control rounded-0 form-control-lg fw-bold" 
                                       id="titulo" name="titulo" placeholder="Ej: Cómo configurar un servidor Linux desde cero"
                                       required value="{{ old('titulo') }}">
                                @error('titulo') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="slug" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Slug (URL)</label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-0 bg-light text-muted border-end-0">javiervargas.cl/blog/</span>
                                    <input type="text" class="form-control rounded-0 border-start-0 ps-0 text-muted" 
                                           id="slug" name="slug" placeholder="como-configurar-linux"
                                           required value="{{ old('slug') }}">
                                </div>
                                <div class="form-text x-small font-mono text-muted">Se genera automáticamente al escribir el título, pero puedes editarlo.</div>
                                @error('slug') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="extracto" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Extracto / Bajada</label>
                                <textarea class="form-control rounded-0" id="extracto" name="extracto" rows="3" 
                                          placeholder="Breve resumen que aparecerá en Google y tarjetas..." required>{{ old('extracto') }}</textarea>
                                @error('extracto') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-0">
                                <label for="editor_contenido" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Contenido</label>
                                <textarea id="editor_contenido" name="contenido">{{ old('contenido') }}</textarea>
                                @error('contenido') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    
                    <div class="card border shadow-sm rounded-0 mb-4">
                        <div class="card-header bg-light border-bottom py-2">
                            <span class="font-mono x-small text-uppercase fw-bold text-dark">Publicación</span>
                        </div>
                        <div class="card-body p-3">
                            
                            <div class="mb-3">
                                <label class="form-label font-mono x-small text-uppercase text-muted fw-bold">Estado</label>
                                <select class="form-select rounded-0" name="estado">
                                    <option value="1" {{ old('estado') == 1 ? 'selected' : '' }}>Borrador</option>
                                    <option value="2" {{ old('estado') == 2 ? 'selected' : '' }}>Publicado</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label font-mono x-small text-uppercase text-muted fw-bold">Visibilidad (Scope)</label>
                                <div class="d-flex gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="scope" id="scope_prof" value="profesional" checked>
                                        <label class="form-check-label small" for="scope_prof">Profesional</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="scope" id="scope_pers" value="personal" {{ old('scope') == 'personal' ? 'checked' : '' }}>
                                        <label class="form-check-label small" for="scope_pers">Personal</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="fecha_publicacion" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Fecha Publicación</label>
                                <input type="date" class="form-control rounded-0" id="fecha_publicacion" name="fecha_publicacion" 
                                       value="{{ old('fecha_publicacion') }}">
                                <div class="form-text x-small text-muted">Dejar vacío para publicar "ahora".</div>
                            </div>

                            <hr class="text-muted opacity-25">

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary-custom rounded-0 font-mono">
                                    <i class="ri-send-plane-fill me-1"></i> Guardar Entrada
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card border shadow-sm rounded-0">
                        <div class="card-header bg-light border-bottom py-2">
                            <span class="font-mono x-small text-uppercase fw-bold text-dark">Imagen Portada</span>
                        </div>
                        <div class="card-body p-3 text-center">
                            
                            <div class="image-upload-wrapper border border-dashed p-4 mb-2 bg-light">
                                <i class="ri-image-add-line display-4 text-muted opacity-50"></i>
                                <p class="small text-muted mb-2 mt-2">Arrastra o haz clic</p>
                                <input type="file" class="form-control d-none" id="imagen_portada" name="imagen_portada" accept="image/*">
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-0 font-mono" onclick="document.getElementById('imagen_portada').click()">
                                    Elegir Archivo
                                </button>
                            </div>
                            <div id="preview-container" class="mt-2 d-none">
                                <img id="preview-img" src="" class="img-fluid border rounded-0" style="max-height: 150px;">
                                <button type="button" class="btn btn-link text-danger x-small text-decoration-none mt-1" onclick="resetImage()">Quitar imagen</button>
                            </div>
                            @error('imagen_portada') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror

                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>

    @push('scripts')        
        <script src="{{ asset('js/blog/agregar.js') }}"></script>
    @endpush

</x-layouts.panel>