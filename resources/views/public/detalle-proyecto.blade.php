<x-layouts.app>

    <div class="container px-4 my-5">
        
        <div class="mb-4">
            <a href="{{ route('public.proyectos') }}" class="text-decoration-none text-dark fw-bold">
                <i class="ri-arrow-left-line me-1"></i> < Volver al listado
            </a>
        </div>

        <div class="mb-5">
            <h1 class="display-4 fw-bolder text-uppercase mb-2">{{ $proyecto->nombre }}</h1>
            <p class="lead text-muted">{{ $proyecto->descripcion }}</p>
        </div>

        <div class="card border-0 shadow-sm mb-5 overflow-hidden">
            <div id="carouselProyecto" class="carousel slide bg-light" data-bs-ride="carousel">
                
                <div class="carousel-indicators">
                    @foreach($proyecto->documentos as $index => $doc)
                        @if(in_array(strtolower($doc->extension), ['jpg', 'jpeg', 'png', 'webp']))
                            <button type="button" data-bs-target="#carouselProyecto" data-bs-slide-to="{{ $loop->index }}" 
                                    class="{{ $loop->first ? 'active' : '' }}" aria-current="true"></button>
                        @endif
                    @endforeach
                </div>

                <div class="carousel-inner">
                    @php $hasImages = false; @endphp
                    
                    @foreach($proyecto->documentos as $doc)
                        @if(in_array(strtolower($doc->extension), ['jpg', 'jpeg', 'png', 'webp']))
                            @php $hasImages = true; @endphp
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <div class="d-flex justify-content-center align-items-center" style="height: 500px; background-color: #f8f9fa;">
                                    <img src="{{ $doc->url_publica }}" class="d-block mh-100 mw-100" alt="Captura de pantalla {{ $index + 1 }}" style="object-fit: contain;">
                                </div>
                            </div>
                        @endif
                    @endforeach

                    @if(!$hasImages)
                        <div class="carousel-item active">
                            <div class="d-flex justify-content-center align-items-center" style="height: 500px; background-color: #e9ecef;">
                                <span class="text-muted">Sin imágenes disponibles</span>
                            </div>
                        </div>
                    @endif
                </div>

                @if($hasImages && $proyecto->documentos->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselProyecto" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselProyecto" data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                @endif
            </div>
        </div>

        <div class="row gx-5">
            
            <div class="col-lg-8 mb-5 mb-lg-0">
                <h3 class="fw-bold text-uppercase mb-4 border-bottom pb-2">Contexto</h3>

                <div class="mb-4">
                    <h5 class="fw-bold"><i class="ri-flag-line me-2 text-danger"></i>El Desafío</h5>
                    <p class="text-justify">
                        {{ $proyecto->desafio ?? 'No se ha especificado el desafío para este proyecto.' }}
                    </p>
                </div>

                <div class="mb-4">
                    <h5 class="fw-bold"><i class="ri-lightbulb-line me-2 text-warning"></i>La Solución</h5>
                    <p class="text-justify">
                        {{ $proyecto->solucion ?? 'No se ha detallado la solución técnica.' }}
                    </p>
                </div>

                <div class="mt-5">
                    <h6 class="fw-bold text-uppercase text-muted small">Competencias Clave</h6>
                    <p>
                        Desarrollo Full Stack, Diseño de Bases de Datos, Arquitectura MVC, 
                        Integración de APIs REST.
                    </p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-dark rounded-0 shadow-sm">
                    <div class="card-header bg-dark text-white rounded-0 fw-bold text-uppercase py-3">
                        Ficha Técnica
                    </div>
                    <div class="card-body p-4">
                        
                        <div class="d-grid gap-2 mb-4">
                            @if($proyecto->url_produccion)
                                <a href="{{ $proyecto->url_produccion }}" target="_blank" class="btn btn-outline-dark fw-bold">
                                    <i class="ri-external-link-line me-2"></i> VISITAR PROYECTO
                                </a>
                            @endif

                            @if($proyecto->url_repositorio)
                                <a href="{{ $proyecto->url_repositorio }}" target="_blank" class="btn btn-outline-secondary fw-bold">
                                    <i class="ri-github-line me-2"></i> VER CÓDIGO (GITHUB)
                                </a>
                            @endif

                            @php
                                $pdfDoc = $proyecto->documentos->filter(fn($d) => strtolower($d->extension) === 'pdf')->first();
                            @endphp

                            @if($pdfDoc)
                                <a href="{{ $pdfDoc->url_publica }}" target="_blank" class="btn btn-dark fw-bold mt-2">
                                    <i class="ri-file-pdf-line me-2"></i> DOCUMENTACIÓN PDF
                                </a>
                            @else
                                <button class="btn btn-light text-muted border border-dashed mt-2" disabled>
                                    <i class="ri-file-forbid-line me-2"></i> Sin Documentación
                                </button>
                            @endif
                        </div>

                        <hr>

                        <div class="mb-4">
                            <h6 class="fw-bold small text-uppercase mb-3">Stack Tecnológico</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($proyecto->tecnologias as $tech)
                                    <span class="badge bg-white text-dark border border-dark rounded-0 py-2 px-3">
                                        @if($tech->icono_class) 
                                            <i class="{{ $tech->icono_class }} me-1"></i> 
                                        @endif
                                        {{ strtoupper($tech->nombre) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div class="small text-muted">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold">Fecha Realización:</span>
                                <span>
                                    {{ $proyecto->fecha_realizacion ? $proyecto->fecha_realizacion->format('d/m/Y') : 'N/A' }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Horas de Trabajo:</span>
                                <span>{{ $proyecto->horas_trabajo ?? 0 }} horas</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div> </div>

</x-layouts.app>