<x-layouts.panel>
    <h2 class="text-center mt-3">Editar Proyecto: {{ $proyecto->nombre }}</h2>
    <x-ui.feedback />

    <div class="card p-4 mx-auto my-5 form-admin" style="max-width: 800px;">
        
        <form action="{{ route('panel.proyectos.editar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <input type="hidden" name="id" value="{{ $proyecto->id }}">

            <div class="row mb-3">
                <div class="col-md-8 text-start">
                    <label for="nombre" class="form-label">Nombre del Proyecto <span class="text-danger">*</span></label>
                    <input type="text" name="nombre" class="form-control" id="nombre" 
                           value="{{ old('nombre', $proyecto->nombre) }}" required>
                </div>
                <div class="col-md-4 text-start">
                    <label for="fecha_realizacion" class="form-label">Fecha Realización</label>
                    <input type="date" name="fecha_realizacion" class="form-control" id="fecha_realizacion" 
                           value="{{ old('fecha_realizacion', $proyecto->fecha_realizacion ? $proyecto->fecha_realizacion->format('Y-m-d') : '') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="text-start">
                    <label for="slug" class="form-label">Ruta visible del proyecto <span class="text-danger">*</span></label>
                    <input type="text" name="slug" class="form-control" id="slug" value="{{ old('slug') }}" required placeholder="Ej: ecommerce-laravel">
                </div>
            </div>

            <div class="mb-3 text-start">
                <label for="imagen_portada" class="form-label">Imagen de Portada (Opcional)</label>
                <input class="form-control" type="file" id="imagen_portada" name="imagen_portada" accept="image/*">
                <div class="form-text">Sube una nueva imagen solo si deseas reemplazar la actual.</div>
                
                {{-- 
                @if($proyecto->imagen_portada)
                    <div class="mt-2">
                        <small>Imagen actual:</small>
                        <img src="{{ asset($proyecto->imagen_portada) }}" alt="Portada actual" style="height: 50px;" class="d-block border rounded">
                    </div>
                @endif 
                --}}
            </div>

            <div class="mb-3 text-start">
                <label for="descripcion" class="form-label">Descripción General</label>
                <textarea name="descripcion" class="form-control" id="descripcion" rows="3">{{ old('descripcion', $proyecto->descripcion) }}</textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 text-start">
                    <label for="desafio" class="form-label">El Desafío / Problema</label>
                    <textarea name="desafio" class="form-control" id="desafio" rows="4">{{ old('desafio', $proyecto->desafio) }}</textarea>
                </div>
                <div class="col-md-6 text-start">
                    <label for="solucion" class="form-label">La Solución / Resultado</label>
                    <textarea name="solucion" class="form-control" id="solucion" rows="4">{{ old('solucion', $proyecto->solucion) }}</textarea>
                </div>
            </div>

            <div class="mb-3 text-start">
                <label class="form-label">Tecnologías Utilizadas</label>
                <div class="card p-3 bg-light" style="max-height: 150px; overflow-y: auto;">
                    <div class="row">
                        @if(isset($tecnologias) && count($tecnologias) > 0)
                            @foreach($tecnologias as $tecnologia)
                                <div class="col-md-4 col-6">
                                    <div class="form-check">
                                        @php
                                            $seleccionadas = old('tecnologias', $proyecto->tecnologias->pluck('id')->toArray());
                                        @endphp

                                        <input class="form-check-input" type="checkbox" name="tecnologias[]" 
                                               value="{{ $tecnologia->id }}" id="tec_{{ $tecnologia->id }}" 
                                               {{ in_array($tecnologia->id, $seleccionadas) ? 'checked' : '' }}>
                                        
                                        <label class="form-check-label" for="tec_{{ $tecnologia->id }}">
                                            {{ $tecnologia->nombre }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-muted small">No hay tecnologías registradas.</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 text-start">
                    <label for="horas_trabajo" class="form-label">Horas</label>
                    <input type="number" name="horas_trabajo" class="form-control" 
                           value="{{ old('horas_trabajo', $proyecto->horas_trabajo) }}">
                </div>
                <div class="col-md-4 text-start">
                    <label for="url_repositorio" class="form-label">Repo Git</label>
                    <input type="url" name="url_repositorio" class="form-control" 
                           value="{{ old('url_repositorio', $proyecto->url_repositorio) }}">
                </div>
                <div class="col-md-4 text-start">
                    <label for="url_produccion" class="form-label">Demo URL</label>
                    <input type="url" name="url_produccion" class="form-control" 
                           value="{{ old('url_produccion', $proyecto->url_produccion) }}">
                </div>
            </div>

            <div class="mb-3 text-start">
                <label for="estado" class="form-label">Visibilidad</label>
                <select name="estado" id="estado" class="form-select">
                    <option value="1" {{ old('estado', $proyecto->estado) == '1' ? 'selected' : '' }}>Visible</option>
                    <option value="0" {{ old('estado', $proyecto->estado) == '0' ? 'selected' : '' }}>Borrador</option>
                </select>
            </div>

            <div class="d-grid mt-4">
                <button class="btn btn-warning" type="submit">Actualizar Proyecto</button>
                <a href="{{ route('panel.proyectos.listar') }}" class="btn btn-link text-muted mt-2">Cancelar</a>
            </div>
        </form>
    </div>
</x-layouts.panel>