<x-layouts.app>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-end border-bottom border-dark pb-3 mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb font-monospace text-uppercase mb-1 small">
                    <li class="breadcrumb-item"><a href="{{ route('public.inicio') }}" class="text-muted text-decoration-none">../Proyectos</a></li>
                    <li class="breadcrumb-item active" style="color: var(--primary);">./{{ Str::slug($proyecto->nombre) }}</li>
                </ol>
            </nav>
            <h1 class="h2 fw-bold mb-0 text-uppercase" style="font-family: var(--font-code);">
                {{ $proyecto->nombre }}
            </h1>
        </div>
        
        <div class="d-none d-md-block">
            <span class="badge border border-dark rounded-0 font-monospace px-3 py-2
                {{ $proyecto->estado ? 'bg-success text-white' : 'bg-warning text-dark' }}">
                STATUS: {{ $proyecto->estado ? 'PRODUCTION_READY' : 'IN_DEVELOPMENT' }}
            </span>
        </div>
    </div>

    <div class="card border border-2 border-dark rounded-0 mb-5 bg-light position-relative" style="box-shadow: 8px 8px 0px var(--primary-light);">
        <div class="card-header bg-dark border-bottom border-secondary py-2 d-flex justify-content-between align-items-center">
            <div class="d-flex gap-2">
                <div class="rounded-circle bg-danger" style="width: 10px; height: 10px;"></div>
                <div class="rounded-circle bg-warning" style="width: 10px; height: 10px;"></div>
                <div class="rounded-circle bg-success" style="width: 10px; height: 10px;"></div>
            </div>
            <small class="text-muted font-monospace">preview_render.png</small>
            <small class="text-muted font-monospace">100%</small>
        </div>

        <div class="card-body p-0 bg-white d-flex align-items-center justify-content-center overflow-hidden" style="min-height: 400px;">
            @foreach($proyecto->documentos as $imagen)
                @if($imagen->es_portada)
                    <img src="{{ $imagen->url_publica }}" 
                        class="img-fluid w-100 object-fit-contain" 
                        alt="{{ $proyecto->nombre }}">
                @else
                    <div class="text-center text-muted font-monospace py-5">
                        <i class="ri-image-off-line fs-1"></i><br>
                        [NO_VISUAL_DATA]
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="row gy-5">
        
        <div class="col-lg-8 pe-lg-5">
            
            <div class="mb-5">
                <h3 class="h5 fw-bold text-uppercase border-bottom border-dark pb-2 mb-3" 
                    style="font-family: var(--font-code); color: var(--primary);">
                    <span class="text-secondary opacity-50">></span> Problem_Statement (El Desafío)
                </h3>
                <div class="text-dark opacity-75" style="line-height: 1.8;">
                    {{ $proyecto->descripcion }} 
                    {{-- Si tienes campos separados para 'desafio' y 'solucion', úsalos aquí --}}
                </div>
            </div>

            @if($proyecto->solucion) 
            <div class="mb-5">
                <h3 class="h5 fw-bold text-uppercase border-bottom border-dark pb-2 mb-3" 
                    style="font-family: var(--font-code); color: var(--primary);">
                    <span class="text-secondary opacity-50">></span> Resolution_Logic (La Solución)
                </h3>
                <div class="text-dark opacity-75" style="line-height: 1.8;">
                    {{ $proyecto->solucion }}
                </div>
            </div>
            @endif

            <div class="mt-5">
                <a href="{{ route('public.inicio') }}" class="btn btn-outline-custom font-monospace rounded-0">
                    <i class="ri-arrow-left-line me-2"></i> cd .. (Volver)
                </a>
            </div>
        </div>

        <div class="col-lg-4">
            
            <div class="card border border-2 border-dark rounded-0 bg-light">
                <div class="card-header bg-white border-bottom border-dark fw-bold font-monospace text-uppercase py-3">
                    System_Properties
                </div>
                
                <div class="card-body p-0">
                    <table class="table table-sm mb-0 font-monospace" style="font-size: 0.9rem;">
                        <tbody>
                            <tr>
                                <td class="ps-3 py-3 text-muted border-bottom border-secondary">STACK:</td>
                                <td class="pe-3 py-3 text-end border-bottom border-secondary">
                                    <div class="d-flex flex-wrap gap-1 justify-content-end">
                                        <span class="badge bg-dark border border-secondary rounded-0">Laravel</span>
                                        <span class="badge bg-dark border border-secondary rounded-0">MySQL</span>
                                        <span class="badge bg-dark border border-secondary rounded-0">Bootstrap</span>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="ps-3 py-3 text-muted border-bottom border-secondary">DEPLOY_DATE:</td>
                                <td class="pe-3 py-3 text-end text-dark fw-bold border-bottom border-secondary">
                                    {{ $proyecto->fecha_realizacion ? \Carbon\Carbon::parse($proyecto->fecha_realizacion)->format('d-m-Y') : 'N/A' }}
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-3 py-3 text-muted border-bottom border-secondary">CLIENT_ID:</td>
                                <td class="pe-3 py-3 text-end text-dark">
                                    {{-- $proyecto->cliente ?? 'Personal Project' --}}
                                    Proyecto Personal
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-light border-top border-dark p-3">
                    <div class="d-grid gap-2">
                        @if($proyecto->url_produccion)
                            <a href="{{ $proyecto->url_produccion }}" target="_blank" class="btn btn-primary-custom rounded-0 fw-bold d-flex justify-content-between align-items-center">
                                <span>LAUNCH_SYSTEM()</span> <i class="ri-external-link-line"></i>
                            </a>
                        @endif

                        @if($proyecto->url_repositorio)
                            <a href="{{ $proyecto->url_repositorio }}" target="_blank" class="btn btn-outline-dark rounded-0 font-monospace d-flex justify-content-between align-items-center bg-white">
                                <span>VIEW_SOURCE_CODE</span> <i class="ri-github-line"></i>
                            </a>
                        @else
                            <button disabled class="btn btn-light border border-secondary rounded-0 font-monospace text-muted d-flex justify-content-between">
                                <span>SOURCE_PRIVATE</span>
                                <i class="ri-lock-line"></i>
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-4 p-3 border border-dark bg-white position-relative">
                <div class="position-absolute bg-white px-2" style="top: -12px; left: 10px;">
                    <span class="text-muted font-monospace small">NOTE:</span>
                </div>
                <p class="small text-muted fst-italic mb-0">
                    "Este proyecto fue diseñado siguiendo la metodología MVC, priorizando la escalabilidad de la base de datos relacional."
                </p>
            </div>

        </div>

    </div>

</div>


</x-layouts.app>