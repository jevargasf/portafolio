<x-layouts.blog>
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col">
                <h1 class="fw-bold">Lo Humano Que Me Queda</h1>
                <p class="text-muted">Aquí ensayo el pensamiento.</p>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse ($entradas as $entrada)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body d-flex flex-column">
                            
                            <h5 class="card-title fw-bold">
                                {{ $entrada->titulo }} </h5>
                            
                            <h6 class="card-subtitle mb-3 text-muted small">
                                {{ $entrada->fecha_publicacion->format('d/m/Y') }}
                            </h6>
                            
                            <p class="card-text flex-grow-1 text-secondary">
                                {{ \Illuminate\Support\Str::limit($entrada->extracto ?? $entrada->contenido, 200) }}
                            </p>
                            
                            <a href="{{ url('/' . $entrada->slug) }}" class="btn btn-outline-custom mt-auto stretched-link">
                                Leer entrada
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Aún no hay entradas publicadas en esta categoría.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.blog>