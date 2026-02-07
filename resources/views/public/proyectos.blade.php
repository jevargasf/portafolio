<x-layouts.app>

<div class="container py-5">

    <div class="mb-4 border-bottom border-dark pb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb font-monospace text-uppercase mb-2">
                <li class="breadcrumb-item"><a href="{{ route('public.inicio') }}" class="text-muted text-decoration-none">~/Home</a></li>
                <li class="breadcrumb-item active" style="color: var(--primary);">./Projects_Directory</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-end">
            <h1 class="h2 fw-bold mb-0 text-uppercase" style="font-family: var(--font-code);">
                <span class="text-secondary opacity-50">></span> Base_de_Proyectos
            </h1>
            <span class="badge bg-white text-dark border border-dark rounded-0 font-monospace">
                Total_Records: {{ $proyectos->count() }}
            </span>
        </div>
    </div>

    <div class="card border-0 rounded-0 mb-5 shadow" style="background-color: #1e1e1e;">
        <div class="card-header border-bottom border-secondary bg-dark py-2">
            <small class="text-muted font-monospace">query_console.exe</small>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('public.proyectos') }}" method="GET">
                <div class="row g-3">
                    
                    <div class="col-lg-6">
                        <label class="form-label text-secondary font-monospace small mb-1">> SEARCH_QUERY:</label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark border-secondary text-success font-monospace rounded-0">$</span>
                            <input type="text" name="search" class="form-control bg-dark border-secondary text-white font-monospace rounded-0" 
                                   placeholder="Nombre del proyecto..." value="{{ request('search') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label text-secondary font-monospace small mb-1">> FILTER_BY_STACK:</label>
                        <select name="tecnologia" class="form-select bg-dark border-secondary text-white font-monospace rounded-0">
                            <option value="">[ ALL_STACKS ]</option>
                            <option value="laravel">Laravel</option>
                            <option value="vue">Vue.js</option>
                            <option value="python">Python</option>
                            </select>
                    </div>

                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100 rounded-0 font-monospace fw-bold text-uppercase border border-success">
                            RUN_FILTER()
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex flex-column gap-4">
        
        @forelse($proyectos as $proyecto)
        <div class="card border border-2 border-dark rounded-0 bg-white shadow-sm overflow-hidden project-card-hover">
            <div class="row g-0">
                
                <div class="col-md-4 border-end border-dark position-relative bg-light d-flex align-items-center justify-content-center overflow-hidden">
                    <div class="position-absolute top-0 start-0 m-2">
                        <span class="badge rounded-0 border border-dark text-uppercase font-monospace
                            {{ $proyecto->estado ? 'bg-success text-white' : 'bg-warning text-dark' }}">
                            {{ $proyecto->estado ? '● Production' : '○ Dev_Build' }}
                        </span>
                    </div>

                    @php
                        $portada = $proyecto->documentos->where('es_portada', 1)->first();
                        $imgUrl = $portada ? $portada->url_publica : 'https://dummyimage.com/600x400/dee2e6/6c757d.jpg&text=Proyecto';
                    @endphp
                    @if($imgUrl)
                        <img src="{{ $imgUrl }}" 
                             class="img-fluid w-100 h-100 object-fit-cover" 
                             alt="{{ $proyecto->nombre }}"
                             style="min-height: 250px;">
                    @else
                        <div class="text-center py-5">
                            <i class="ri-image-line text-muted fs-1"></i>
                            <div class="font-monospace small text-muted mt-2">[NO_IMAGE_DATA]</div>
                        </div>
                    @endif
                </div>

                <div class="col-md-8 d-flex flex-column">
                    
                    <div class="card-header bg-white border-bottom border-dark py-2 d-flex justify-content-between align-items-center">
                        <small class="text-muted font-monospace">ID: #{{ str_pad($proyecto->id, 3, '0', STR_PAD_LEFT) }}</small>
                        <small class="font-monospace fw-bold text-uppercase" style="color: var(--primary);">
                            {{ $proyecto->fecha_realizacion ? \Carbon\Carbon::parse($proyecto->fecha_realizacion)->format('Y') : 'N/A' }}
                        </small>
                    </div>

                    <div class="card-body d-flex flex-column h-100">
                        <h3 class="card-title h4 fw-bold text-uppercase mb-3" style="font-family: var(--font-code);">
                            {{ $proyecto->nombre }}
                        </h3>

                        <div class="mb-3">
                            <span class="badge bg-light text-dark border border-dark rounded-0 font-monospace me-1">LARAVEL</span>
                            <span class="badge bg-light text-dark border border-dark rounded-0 font-monospace me-1">MYSQL</span>
                            <span class="badge bg-light text-dark border border-dark rounded-0 font-monospace">BOOTSTRAP</span>
                        </div>

                        <p class="card-text text-secondary mb-4 flex-grow-1">
                            {{ Str::limit($proyecto->descripcion, 150) }}
                        </p>

                        <div class="d-flex justify-content-between align-items-center border-top border-light pt-3 mt-auto">
                            <a href="#" class="text-decoration-none text-muted font-monospace small">
                                <i class="ri-github-line"></i> source_code
                            </a>

                            <a href="{{ route('public.detalle-proyecto', $proyecto) }}" class="btn btn-primary-custom rounded-0 d-flex align-items-center gap-2 px-4">
                                <span>OPEN_RECORD</span>
                                <i class="ri-arrow-right-line"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="alert alert-dark font-monospace rounded-0 border-2 border-dark" role="alert">
            <span class="text-danger fw-bold">ERROR 404:</span> No matching records found in database query.
        </div>
        @endforelse

        <div class="mt-4">
            {{-- $proyectos->links() --}} </div>

    </div>
</div>

</x-layouts.app>