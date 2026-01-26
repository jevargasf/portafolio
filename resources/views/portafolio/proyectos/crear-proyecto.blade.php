<x-layouts.panel>
    <h2 class="text-center mt-3">Crear Nuevo Proyecto</h2>
    <x-ui.feedback />

    <div class="card p-4 mx-auto my-5 form-admin" style="max-width: 800px;">
        <form action="{{ route('panel.proyectos.crear') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <div class="col-md-8 text-start">
                    <label for="nombre" class="form-label">Nombre del Proyecto <span class="text-danger">*</span></label>
                    <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre') }}" required placeholder="Ej: E-commerce Laravel">
                </div>
                <div class="col-md-4 text-start">
                    <label for="fecha_realizacion" class="form-label">Fecha Realización</label>
                    <input type="date" name="fecha_realizacion" class="form-control" id="fecha_realizacion" value="{{ old('fecha_realizacion') }}">
                </div>
            </div>

            <div class="mb-3 text-start">
                <label for="imagen_portada" class="form-label">Imagen de Portada</label>
                <input class="form-control" type="file" id="imagen_portada" name="imagen_portada" accept="image/*">
            </div>

            <div class="mb-3 text-start">
                <label for="descripcion" class="form-label">Descripción General</label>
                <textarea name="descripcion" class="form-control" id="descripcion" rows="3" placeholder="Resumen general del proyecto...">{{ old('descripcion') }}</textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 text-start">
                    <label for="desafio" class="form-label">El Desafío / Problema</label>
                    <textarea name="desafio" class="form-control" id="desafio" rows="4" placeholder="¿Qué problema técnico o de negocio intentabas resolver?">{{ old('desafio') }}</textarea>
                </div>
                <div class="col-md-6 text-start">
                    <label for="solucion" class="form-label">La Solución / Resultado</label>
                    <textarea name="solucion" class="form-control" id="solucion" rows="4" placeholder="¿Cómo lo lograste y qué impacto tuvo?">{{ old('solucion') }}</textarea>
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
                                        <input class="form-check-input" type="checkbox" name="tecnologias[]" value="{{ $tecnologia->id }}" id="tec_{{ $tecnologia->id }}" 
                                        {{ (is_array(old('tecnologias')) && in_array($tecnologia->id, old('tecnologias'))) ? 'checked' : '' }}>
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
                    <input type="number" name="horas_trabajo" class="form-control" placeholder="Ej: 40" value="{{ old('horas_trabajo') }}">
                </div>
                <div class="col-md-4 text-start">
                    <label for="url_repositorio" class="form-label">Repo Git</label>
                    <input type="url" name="url_repositorio" class="form-control" placeholder="https://github.com/..." value="{{ old('url_repositorio') }}">
                </div>
                <div class="col-md-4 text-start">
                    <label for="url_produccion" class="form-label">Demo URL</label>
                    <input type="url" name="url_produccion" class="form-control" placeholder="https://..." value="{{ old('url_produccion') }}">
                </div>
            </div>

            <div class="mb-3 text-start">
                <label for="estado" class="form-label">Visibilidad</label>
                <select name="estado" id="estado" class="form-select">
                    <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Visible</option>
                    <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Borrador</option>
                </select>
            </div>

            <div class="d-grid mt-4">
                <button class="btn btn-primary" type="submit">Guardar Proyecto</button>
            </div>
        </form>
    </div>
</x-layouts.panel>