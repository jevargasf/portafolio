<x-layouts.panel>

    {{-- Script de TinyMCE en el Head --}}
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
                        <li class="breadcrumb-item active text-dark">Editar Entrada</li>
                    </ol>
                </nav>
                <h1 class="h3 fw-bold mb-0 text-dark font-mono">Editar Entrada</h1>
            </div>
            <a href="{{ route('panel.blog.listar') }}" class="btn btn-ghost-custom text-muted x-small">
                <i class="ri-arrow-left-line"></i> Volver
            </a>
        </div>

        {{-- ACTION apunta a update, METHOD POST simulando PUT --}}
        <form action="{{ route('panel.blog.editar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            {{-- INPUT HIDDEN CON EL ID (REQUISITO SOLICITADO) --}}
            <input type="hidden" name="id" value="{{ $entrada->id }}">

            <div class="row g-4">
                
                {{-- COLUMNA IZQUIERDA: CONTENIDO --}}
                <div class="col-lg-8">
                    <div class="card border shadow-sm rounded-0 h-100">
                        <div class="card-body p-4">
                            
                            {{-- Título --}}
                            <div class="mb-4">
                                <label for="titulo" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Título del Post</label>
                                <input type="text" class="form-control rounded-0 form-control-lg fw-bold" 
                                       id="titulo" name="titulo" placeholder="Ej: Cómo configurar un servidor Linux"
                                       required value="{{ old('titulo', $entrada->titulo) }}">
                                @error('titulo') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                            </div>

                            {{-- Slug --}}
                            <div class="mb-4">
                                <label for="slug" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Slug (URL)</label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-0 bg-light text-muted border-end-0">javiervargas.cl/blog/</span>
                                    <input type="text" class="form-control rounded-0 border-start-0 ps-0 text-muted" 
                                           id="slug" name="slug" placeholder="como-configurar-linux"
                                           required value="{{ old('slug', $entrada->slug) }}">
                                </div>
                                <div class="form-text x-small font-mono text-muted">Edita esto solo si es estrictamente necesario (afecta SEO).</div>
                                @error('slug') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                            </div>

                            {{-- Extracto --}}
                            <div class="mb-4">
                                <label for="extracto" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Extracto / Bajada</label>
                                <textarea class="form-control rounded-0" id="extracto" name="extracto" rows="3" 
                                          required>{{ old('extracto', $entrada->extracto) }}</textarea>
                                @error('extracto') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                            </div>

                            {{-- Contenido (TinyMCE) --}}
                            <div class="mb-0">
                                <label for="editor_contenido" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Contenido</label>
                                {{-- El contenido va DENTRO de las etiquetas textarea --}}
                                <textarea id="editor_contenido" name="contenido">{{ old('contenido', $entrada->contenido) }}</textarea>
                                @error('contenido') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror
                            </div>

                        </div>
                    </div>
                </div>

                {{-- COLUMNA DERECHA: CONFIGURACIÓN --}}
                <div class="col-lg-4">
                    
                    {{-- 1. PUBLICACIÓN --}}
                    <div class="card border shadow-sm rounded-0 mb-4">
                        <div class="card-header bg-light border-bottom py-2">
                            <span class="font-mono x-small text-uppercase fw-bold text-dark">Publicación</span>
                        </div>
                        <div class="card-body p-3">
                            
                            {{-- Estado --}}
                            <div class="mb-3">
                                <label class="form-label font-mono x-small text-uppercase text-muted fw-bold">Estado</label>
                                <select class="form-select rounded-0" name="estado">
                                    <option value="1" {{ old('estado', $entrada->estado) == 1 ? 'selected' : '' }}>Borrador</option>
                                    <option value="2" {{ old('estado', $entrada->estado) == 2 ? 'selected' : '' }}>Publicado</option>
                                </select>
                            </div>

                            {{-- Scope --}}
                            <div class="mb-3">
                                <label class="form-label font-mono x-small text-uppercase text-muted fw-bold">Visibilidad (Scope)</label>
                                <div class="d-flex gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="scope" id="scope_prof" value="profesional" 
                                            {{ old('scope', $entrada->scope) == 'profesional' ? 'checked' : '' }}>
                                        <label class="form-check-label small" for="scope_prof">Profesional</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="scope" id="scope_pers" value="personal" 
                                            {{ old('scope', $entrada->scope) == 'personal' ? 'checked' : '' }}>
                                        <label class="form-check-label small" for="scope_pers">Personal</label>
                                    </div>
                                </div>
                            </div>

                            {{-- Fecha --}}
                            <div class="mb-3">
                                <label for="fecha_publicacion" class="form-label font-mono x-small text-uppercase text-muted fw-bold">Fecha Publicación</label>
                                <input type="date" class="form-control rounded-0" id="fecha_publicacion" name="fecha_publicacion" 
                                       value="{{ old('fecha_publicacion', optional($entrada->fecha_publicacion)->format('Y-m-d')) }}">
                            </div>

                            <hr class="text-muted opacity-25">

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary-custom rounded-0 font-mono">
                                    <i class="ri-save-line me-1"></i> Actualizar Entrada
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- 2. IMAGEN DESTACADA --}}
                    <div class="card border shadow-sm rounded-0">
                        <div class="card-header bg-light border-bottom py-2">
                            <span class="font-mono x-small text-uppercase fw-bold text-dark">Imagen Portada</span>
                        </div>
                        <div class="card-body p-3 text-center">
                            
                            {{-- LÓGICA VISUAL: Si hay imagen, ocultamos el Uploader y mostramos el Preview --}}
                            @php
                                $tienePortada = $entrada->portada && $entrada->portada->ruta_archivo;
                                $rutaPortada = $tienePortada ? asset('storage/' . $entrada->portada->ruta_archivo) : '';
                            @endphp

                            <div class="image-upload-wrapper border border-dashed p-4 mb-2 bg-light {{ $tienePortada ? 'd-none' : '' }}">
                                <i class="ri-image-add-line display-4 text-muted opacity-50"></i>
                                <p class="small text-muted mb-2 mt-2">Arrastra o haz clic para cambiar</p>
                                <input type="file" class="form-control d-none" id="imagen_portada" name="imagen_portada" accept="image/*">
                                <button type="button" class="btn btn-sm btn-outline-secondary rounded-0 font-mono" onclick="document.getElementById('imagen_portada').click()">
                                    Elegir Archivo
                                </button>
                            </div>

                            {{-- Contenedor de Previsualización --}}
                            <div id="preview-container" class="mt-2 {{ $tienePortada ? '' : 'd-none' }}">
                                <img id="preview-img" src="{{ $rutaPortada }}" class="img-fluid border rounded-0" style="max-height: 150px;">
                                <div class="mt-2">
                                    <button type="button" class="btn btn-link text-primary x-small text-decoration-none" onclick="document.getElementById('imagen_portada').click()">Cambiar</button>
                                    <span class="text-muted">|</span>
                                    <button type="button" class="btn btn-link text-danger x-small text-decoration-none" onclick="resetImage()">Quitar</button>
                                </div>
                            </div>
                            
                            @error('imagen_portada') <span class="text-danger x-small font-mono">{{ $message }}</span> @enderror

                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        {{-- Reutilizamos el JS de agregar, pero ten en cuenta que el listener del título podría
             modificar el slug. Si prefieres que el slug NO cambie al editar título, deberías crear un editar.js aparte --}}
        <script src="{{ asset('js/blog/agregar.js') }}"></script>
    @endpush

</x-layouts.panel>