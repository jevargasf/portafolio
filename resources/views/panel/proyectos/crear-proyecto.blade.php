@php
    $oldJson = old('tecnologias_ordenadas');
    if ($oldJson) {
        $oldArray = json_decode($oldJson, true) ?? [];
        $idsSeleccionados = array_column($oldArray, 'id');
    } else {
        $idsSeleccionados = isset($proyecto) ? $proyecto->tecnologias->pluck('id')->toArray() : [];
    }
@endphp

<x-layouts.panel>
    <h3 class="ection__title panel__title">Crear Nuevo Proyecto</h3>
    <x-ui.feedback />

    <div class="card panel__form">
        <form action="{{ route('panel.proyectos.crear') }}" method="POST" enctype="multipart/form-data" id="formCrear">
            @csrf

            <div class="form__row">
                <div class="form__group">
                    <label for="nombre" class="form__label">Nombre del Proyecto <span class="text-danger">*</span></label>
                    <input type="text" name="nombre" class="form__input" id="nombre" value="{{ old('nombre') }}" required placeholder="Ej: E-commerce Laravel">
                </div>
                <div class="form__group">
                    <label for="fecha_realizacion" class="form__label">Fecha Realización</label>
                    <input type="date" name="fecha_realizacion" class="form__input" id="fecha_realizacion" value="{{ old('fecha_realizacion') }}">
                </div>
            </div>

            <div class="form__row">
                <div class="form__group">
                    <label for="slug" class="form__label">Ruta visible del proyecto <span class="text-danger">*</span></label>
                    <input type="text" name="slug" class="form__input" id="slug" value="{{ old('slug') }}" required placeholder="Ej: ecommerce-laravel">
                </div>
            </div>

            <div class="form__row">
                <label for="imagen_portada" class="form__label">Imagen de Portada</label>
                <input class="form__input" type="file" id="imagen_portada" name="imagen_portada" accept="image/*">
            </div>

            <div class="form__row">
                <label for="descripcion" class="form__label">Descripción General</label>
                <textarea name="descripcion" class="form__input" id="descripcion" rows="3" placeholder="Resumen general del proyecto...">{{ old('descripcion') }}</textarea>
            </div>

            <div class="form__row" style="--form-grid-columns: 1fr 1fr;">
                <div class="form__group">
                    <label for="desafio" class="form__label">El Desafío / Problema</label>
                    <textarea name="desafio" class="form__input" id="desafio" rows="4" placeholder="¿Qué problema técnico o de negocio intentabas resolver?">{{ old('desafio') }}</textarea>
                </div>
                <div class="form__group">
                    <label for="solucion" class="form__label">La Solución / Resultado</label>
                    <textarea name="solucion" class="form__input" id="solucion" rows="4" placeholder="¿Cómo lo lograste y qué impacto tuvo?">{{ old('solucion') }}</textarea>
                </div>
            </div>
            <div class="form__row">
                <label class="form__label">Tecnologías Utilizadas</label>
                <div class="form__group--checkboxes">

                    @if(isset($tecnologias) && count($tecnologias) > 0)
                        @foreach($tecnologias as $tecnologia)
                            <div class="form__checkbox">
                                <input class="form__check--input" type="checkbox" value="{{ $tecnologia->id }}" id="tec_{{ $tecnologia->id }}" 
                                {{ in_array($tecnologia->id, $idsSeleccionados) ? 'checked' : '' }}>
                                <label class="form__check--label" for="tec_{{ $tecnologia->id }}">
                                    {{ $tecnologia->nombre }}
                                </label>
                            
                            </div>
                        @endforeach
                    @else
                        <div class="text-muted small">No hay tecnologías registradas.</div>
                    @endif
                </div>
                    <div id="containerChecked"></div>
                    <input type="hidden" name="tecnologias_ordenadas" id="tecnologiasOrdenadas">
            </div>

            <div class="form__row">
                <div class="form__group">
                    <label for="horas_trabajo" class="form__label">Horas</label>
                    <input type="number" name="horas_trabajo" class="form__input" placeholder="Ej: 40" value="{{ old('horas_trabajo') }}">
                </div>
                <div class="form__group">
                    <label for="url_repositorio" class="form__label">Repo Git</label>
                    <input type="url" name="url_repositorio" class="form__input" placeholder="https://github.com/..." value="{{ old('url_repositorio') }}">
                </div>
                <div class="form__group">
                    <label for="url_produccion" class="form__label">Demo URL</label>
                    <input type="url" name="url_produccion" class="form__input" placeholder="https://..." value="{{ old('url_produccion') }}">
                </div>
            </div>

            <div class="form__row">
                <label for="estado" class="form__label">Visibilidad</label>
                <select name="estado" id="estado" class="form__select">
                    <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Visible</option>
                    <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Borrador</option>
                </select>
            </div>

            <div class="form__row">
                <button class="btn__brand--primary" type="submit">Guardar Proyecto</button>
                <a href="{{ route('panel.proyectos.listar') }}" class="btn__brand--outline">Cancelar</a>
            </div>
        </form>
    </div>
    @push('scripts')    
        <script>
            window.oldTecnologias = {!! old('tecnologias_ordenadas', 'null') !!};
        </script>

        <script src="{{ asset('js/portafolio/proyectos/crear.js') }}"></script>
    @endpush
</x-layouts.panel>