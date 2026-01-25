<x-layouts.panel>
    
    <h2 class="text-center mt-3">Crear Nuevo Proyecto</h2>
    
    <x-ui.feedback />

<div class="card p-4 mx-auto my-5 form-admin" style="max-width: 800px;">
        <form action="{{ route('panel.proyectos.crear') }}" method="POST">
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
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" id="descripcion" rows="3">{{ old('descripcion') }}</textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 text-start">
                    <label for="horas_trabajo" class="form-label">Horas Invertidas</label>
                    <input type="number" name="horas_trabajo" class="form-control" id="horas_trabajo" placeholder="Ej: 40" value="{{ old('horas_trabajo') }}">
                </div>
                
                <div class="col-md-4 text-start">
                    <label for="url_repositorio" class="form-label">URL Repositorio (Git)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="ri-github-fill"></i></span>
                        <input type="url" name="url_repositorio" class="form-control" placeholder="https://github.com/..." value="{{ old('url_repositorio') }}">
                    </div>
                </div>

                <div class="col-md-4 text-start">
                    <label for="url_produccion" class="form-label">URL Demo / Producción</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="ri-global-line"></i></span>
                        <input type="url" name="url_produccion" class="form-control" placeholder="https://miweb.com" value="{{ old('url_produccion') }}">
                    </div>
                </div>
            </div>

            <div class="mb-3 text-start">
                <label for="estado" class="form-label">Estado de visibilidad</label>
                <select name="estado" id="estado" class="form-select">
                    <option value="1" selected>Visible (Publicado)</option>
                    <option value="0">Oculto (Borrador)</option>
                </select>
            </div>

            <div class="d-grid mt-4">
                <button class="btn btn-primary" type="submit">
                    <i class="ri-save-line me-1"></i> Guardar Proyecto
                </button>
            </div>

        </form>
    </div>

</x-layouts.panel>