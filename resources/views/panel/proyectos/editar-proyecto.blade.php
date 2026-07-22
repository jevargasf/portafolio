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
    <h3 class="section__title panel__title">Editar Proyecto: {{ $proyecto->nombre }}</h3>
    <x-ui.feedback />

    <div class="card panel__form">
        
        <form action="{{ route('panel.proyectos.editar') }}" method="POST" enctype="multipart/form-data" id="formEditar">
            @csrf
            
            <input type="hidden" name="id" value="{{ $proyecto->id }}">

            <div class="form__row" style="--form-grid-cols: 2fr 1fr;">
                <div class="form__group">
                    <label for="nombre" class="form__label">Nombre del Proyecto <span class="text-danger">*</span></label>
                    <input type="text" name="nombre" class="form__input" id="nombre" 
                           value="{{ old('nombre', $proyecto->nombre) }}" required>
                </div>
                <div class="form__group">
                    <label for="fecha_realizacion" class="form__label">Fecha Realización</label>
                    <input type="date" name="fecha_realizacion" class="form__input" id="fecha_realizacion" 
                           value="{{ old('fecha_realizacion', $proyecto->fecha_realizacion ? $proyecto->fecha_realizacion->format('Y-m-d') : '') }}">
                </div>
            </div>

            <div class="form__row">
                <div class="form__group">
                    <label for="slug" class="form__label">Ruta visible del proyecto <span class="text-danger">*</span></label>
                    <input type="text" name="slug" class="form__input" id="slug" value="{{ old('slug', $proyecto->slug) }}" required placeholder="Ej: ecommerce-laravel">
                </div>
            </div>

            <div class="form__row">
                <label for="imagen_portada" class="form__label">Imagen de Portada (Opcional)</label>
                <input class="form__input" type="file" id="imagen_portada" name="imagen_portada" accept="image/*">
                <div class="form__info">Sube una nueva imagen solo si deseas reemplazar la actual.</div>
                
                {{-- 
                @if($proyecto->imagen_portada)
                    <div class="form__group">
                        <small>Imagen actual:</small>
                        <img src="{{ asset($proyecto->imagen_portada) }}" alt="Portada actual" style="height: 50px;" class="d-block border rounded">
                    </div>
                @endif 
                --}}
            </div>

            <div class="form__row">
                <label for="descripcion" class="form__label">Descripción General</label>
                <textarea name="descripcion" class="form__input" id="descripcion" rows="3">{{ old('descripcion', $proyecto->descripcion) }}</textarea>
            </div>

            <div class="form__row" style="--form-grid-cols: 1fr 1fr;">
                <div class="form__group">
                    <label for="desafio" class="form__label">El Desafío / Problema</label>
                    <textarea name="desafio" class="form__input" id="desafio" rows="4">{{ old('desafio', $proyecto->desafio) }}</textarea>
                </div>
                <div class="form__group">
                    <label for="solucion" class="form__label">La Solución / Resultado</label>
                    <textarea name="solucion" class="form__input" id="solucion" rows="4">{{ old('solucion', $proyecto->solucion) }}</textarea>
                </div>
            </div>

            <div class="form__row" style="--form-grid-cols: 2fr 1fr;">
                <div>
                    <label class="form__label">Tecnologías Utilizadas</label>
                    <div class="form__group--checkboxes" id="containerCheckboxes">
                            @if(isset($tecnologias) && count($tecnologias) > 0)
                                @foreach($tecnologias as $tecnologia)
                                        <div class="form__checkbox">
                                            @php
                                                $seleccionadas = old('tecnologias', $proyecto->tecnologias->pluck('id')->toArray());
                                            @endphp

                                            <input class="form__check--input" type="checkbox" 
                                                value="{{ $tecnologia->id }}" id="tec_{{ $tecnologia->id }}" 
                                                {{ in_array($tecnologia->id, $idsSeleccionados) ? 'checked' : '' }}>
                                            
                                            <label class="form__check--label" for="tec_{{ $tecnologia->id }}">
                                                {{ $tecnologia->nombre }}
                                            </label>
                                        </div>
                                @endforeach
                            @else
                                <div class="form__info">No hay tecnologías registradas.</div>
                            @endif
                    </div>
                </div>
                <div id="containerChecked"></div>
                <input type="hidden" name="tecnologias_ordenadas" id="tecnologiasOrdenadas">
            </div>

            <div class="form__row" style="--form-grid-cols: 1fr 1fr 1fr;">
                <div class="form__group">
                    <label for="horas_trabajo" class="form__label">Horas</label>
                    <input type="number" name="horas_trabajo" class="form__input" 
                           value="{{ old('horas_trabajo', $proyecto->horas_trabajo) }}">
                </div>
                <div class="form__group">
                    <label for="url_repositorio" class="form__label">Repo Git</label>
                    <input type="url" name="url_repositorio" class="form__input" 
                           value="{{ old('url_repositorio', $proyecto->url_repositorio) }}">
                </div>
                <div class="form__group">
                    <label for="url_produccion" class="form__label">Demo URL</label>
                    <input type="url" name="url_produccion" class="form__input" 
                           value="{{ old('url_produccion', $proyecto->url_produccion) }}">
                </div>
            </div>
            <div class="form__row">
                <label for="tipo" class="form__label">Tipo de Proyecto</label>
                <select name="tipo" id="tipo" class="form__select">
                    <option value="1" {{ old('tipo', $proyecto->tipo) == '1' ? 'selected' : '' }}>Aplicación Web</option>
                    <option value="2" {{ old('tipo', $proyecto->tipo) == '2' ? 'selected' : '' }}>IA/Machine Learning</option>
                    <option value="3" {{ old('tipo', $proyecto->tipo) == '3' ? 'selected' : '' }}>Otro</option>
                    <option value="0" {{ old('tipo', $proyecto->tipo) == '0' ? 'selected' : '' }}>Ninguno</option>
                </select>
            </div>
            <div class="form__row">
                <label for="estado" class="form__label">Visibilidad</label>
                <select name="estado" id="estado" class="form__select">
                    <option value="1" {{ old('estado', $proyecto->estado) == '1' ? 'selected' : '' }}>En Producción</option>
                    <option value="2" {{ old('estado', $proyecto->estado) == '2' ? 'selected' : '' }}>Mínimo Producto Viable</option>
                    <option value="3" {{ old('estado', $proyecto->estado) == '3' ? 'selected' : '' }}>En Desarrollo</option>
                    <option value="0" {{ old('estado', $proyecto->estado) == '0' ? 'selected' : '' }}>Borrador (No Visible Públicamente)</option>
                </select>
            </div>

            <div class="form__row">
                <button class="btn-brand--primary" type="submit">Actualizar Proyecto</button>
                <a href="{{ route('panel.proyectos.listar') }}" class="btn-brand--outline">Cancelar</a>
            </div>
        </form>
    </div>
    @push('scripts')    
        <script>
            window.tecnologiasProyecto = @json($proyecto->tecnologias);
            window.tecnologias = @json($tecnologias);
            window.oldTecnologias = {!! old('tecnologias_ordenadas', 'null') !!};
        </script>

        <script src="{{ asset('js/portafolio/proyectos/editar.js') }}"></script>
    @endpush
</x-layouts.panel>