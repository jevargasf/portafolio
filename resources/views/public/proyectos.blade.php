<x-layouts.app>

    <div class="container px-4 my-5">
        
        <div class="text-center mb-5">
            <h1 class="fw-bolder text-uppercase">Mis Proyectos</h1>
            <p class="text-muted">Explora mi portafolio completo y filtra por tecnologías.</p>
        </div>

        <div class="card mb-5 border-0 shadow-sm bg-light">
            <div class="card-body p-4">
                <form action="{{ route('public.proyectos') }}" method="GET">
                    <div class="row g-3 align-items-end">
                        
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-uppercase">Buscar</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="ri-search-line"></i></span>
                                <input type="text" name="search" class="form-control border-start-0 ps-0" 
                                       placeholder="Escribe lo que quieres buscar..." 
                                       value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-bold small text-uppercase">Tecnología</label>
                            <select class="form-select" name="tech">
                                <option value="">Todas</option>
                                <option value="laravel" {{ request('tech') == 'laravel' ? 'selected' : '' }}>Laravel</option>
                                <option value="php" {{ request('tech') == 'php' ? 'selected' : '' }}>PHP</option>
                                <option value="javascript" {{ request('tech') == 'javascript' ? 'selected' : '' }}>JavaScript</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-bold small text-uppercase">Año</label>
                            <select class="form-select" name="year">
                                <option value="">Todos</option>
                                <option value="2025" {{ request('year') == '2025' ? 'selected' : '' }}>2025</option>
                                <option value="2024" {{ request('year') == '2024' ? 'selected' : '' }}>2024</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary-custom w-100 fw-bold">
                                APLICAR
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @forelse($proyectos as $proyecto)
                    <div class="card mb-4 border-0 shadow-sm overflow-hidden">
                        <div class="row g-0">
                            
                            <div class="col-md-4 bg-light d-flex align-items-center justify-content-center">
                                @php
                                    $portada = $proyecto->documentos->where('es_portada', 1)->first();
                                    $imgUrl = $portada ? $portada->url_publica : 'https://dummyimage.com/600x400/dee2e6/6c757d.jpg&text=Proyecto';
                                @endphp
                                <img src="{{ $imgUrl }}" class="img-fluid rounded-start h-100 w-100" style="object-fit: cover; min-height: 250px;" alt="{{ $proyecto->nombre }}">
                            </div>
                            
                            <div class="col-md-8">
                                <div class="card-body p-4 d-flex flex-column h-100 justify-content-center">
                                    <h3 class="card-title fw-bold text-uppercase mb-2">{{ $proyecto->nombre }}</h3>
                                    
                                    <div class="mb-3">
                                        @foreach($proyecto->tecnologias->take(5) as $tech)
                                            <span class="badge badge-custom">
                                                {{ $tech->nombre }}
                                            </span>
                                        @endforeach
                                    </div>

                                    <p class="card-text text-muted mb-4">
                                        {{ Str::limit($proyecto->descripcion, 150) }}
                                    </p>
                                    
                                    <div>
                                        <a href="{{ route('public.detalle-proyecto', $proyecto->slug) }}" class="btn btn-outline-custom px-4">
                                            [ VER DETALLE ]
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info text-center py-5">
                        <i class="ri-search-eye-line fs-1 d-block mb-3"></i>
                        No se encontraron proyectos con esos filtros.
                    </div>
                @endforelse
            </div>
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $proyectos->appends(request()->query())->links() }}
        </div>

    </div>

</x-layouts.app>