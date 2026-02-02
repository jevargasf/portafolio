@props(['item'])

<div class="mb-4 position-relative">
    <div class="position-absolute bg-dark rounded-circle border border-white" 
         style="width: 16px; height: 16px; left: -33px; top: 5px;"></div>
    
    <div class="card border-0 bg-light shadow-sm rounded-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <h5 class="fw-bold text-uppercase mb-0">{{ $item->cargo }}</h5>
                <span class="badge bg-dark text-white rounded-0">
                    {{ $item->fecha_inicio ? $item->fecha_inicio->format('M Y') : '' }} - 
                    {{ $item->es_actual ? 'Actualidad' : ($item->fecha_fin ? $item->fecha_fin->format('M Y') : '') }}
                </span>
            </div>
            <h6 class="text-primary fw-bold mb-3">{{ $item->empresa }}</h6>
            <p class="mb-0 text-muted small text-justify">
                {{ $item->descripcion_tareas }}
            </p>
        </div>
    </div>
</div>