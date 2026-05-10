<x-layouts.app>
    <header class="py-5 hero-header">
        <div class="container py-lg-5">
            <div class="row align-items-center gy-4">
                
                <div class="col-lg-7">
                    
                    <!-- badge -->
                    <div class="hero-badge d-inline-flex align-items-center px-2 py-1 mb-3">
                        <span class="dot-available pe-1">●</span>
                        <span class="status-text">Estado_Actual: </span>
                        <strong class="status-value">Disponible</strong>
                    </div>

                    <!-- título hero -->
                    <h1 class="hero-title">
                        {{ strtoupper($perfil->usuario->nombre_completo ?? 'JAVIER') }}
                    </h1>
                    
                    <!-- ocupación profesional -->
                    <h2 class="hero-subtitle">
                        <span>&lt;</span> 
                        {{ $perfil->ocupacion ?? 'Desarrollador Full Stack' }}
                        <span>/&gt;</span>
                    </h2>

                    <p class="hero-lead">
                        {{ $perfil->index_bio }}
                        <br><br>
                        <span class="hero-specialty">
                            {{ $perfil->index_especialidad }}
                        </span>
                    </p>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="#proyectos" class="btn-primary-custom px-4 py-3 d-flex align-items-center gap-2">
                            <span>VER PROYECTOS</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M13.0001 16.1716L18.3641 10.8076L19.7783 12.2218L12.0001 20L4.22192 12.2218L5.63614 10.8076L11.0001 16.1716V4H13.0001V16.1716Z"></path></svg>
                        </a>

                        <a href="" class="btn-outline-custom px-4 py-3 d-inline-flex align-items-center">
                            DESCARGAR CV
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 position-relative">
                    <div class="position-absolute w-100 h-100 hero-photo-backdrop"></div>
                        @php
                            $fotoUrl = ($perfil && $perfil->foto_perfil) 
                                ? $perfil->foto_perfil->url_publica 
                                : 'https://dummyimage.com/400x400/dee2e6/6c757d.jpg&text=JAVIER';
                        @endphp
                        <img class="img-fluid position-relative w-100 hero-photo" 
                             src="{{ $fotoUrl }}" 
                             alt="Foto de {{ $perfil->usuario->nombres ?? 'Javier' }}" />
                    <div class="position-absolute p-2 hero-photo-label">
                        Actualmente interesado en <br> <strong>Servidores Web Locales</strong>
                    </div>
                </div>

            </div>
        </div>
    </header>

<section id="proyectos" class="py-5">
    <div class="container py-lg-4">
        
        <div class="mb-5 pb-3 d-flex align-items-end section-header">
            <h2 class="mb-0 section-title">
                <span class="section-title-prefix">./</span>Proyectos_Desplegados
            </h2>
            <span class="ms-3 section-badge">
                Total: {{ $perfil->proyectos->count() }}
            </span>
        </div>

        <div class="row g-4">
            @foreach($perfil->proyectos as $proyecto)
            <div class="col-lg-6 col-xl-4">
                
                <div class="project-card-wrapper h-100">
                    
                    <div class="position-relative h-100 project-card">
                        
                        <div class="project-card-header py-2 d-flex justify-content-between align-items-center">
                            <span class="project-id">
                                ID: #{{ str_pad($proyecto->id, 3, '0', STR_PAD_LEFT) }}
                            </span>
                            <span class="project-status {{ $proyecto->estado ? 'status-prod' : 'status-dev' }}">
                                {{ $proyecto->estado ? '● PRODUCTION' : '○ DEVELOPMENT' }}
                            </span>
                        </div>

                        <div class="project-image-wrapper p-3 pb-0">
                            <div class="ratio ratio-16x9 position-relative overflow-hidden project-image-container group-hover-zoom">
                                <div class="overlay-tech d-flex align-items-center justify-content-center">
                                    <span class="project-hover-btn">VIEW_SOURCE</span>
                                </div>
                            @php
                                $portada = $proyecto->documentos->where('es_portada', 1)->first();
                                $imgProyecto = $portada ? $portada->url_publica : 'https://dummyimage.com/600x400/dee2e6/6c757d.jpg&text=Proyecto';
                            @endphp
                                @if($imgProyecto)
                                    <img src="{{ $imgProyecto }}" 
                                         class="img-fluid object-fit-cover" 
                                         alt="{{ $proyecto->nombre }}">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 project-no-image">
                                        [NO_IMAGE_DATA]
                                    </div>
                                @endif
                            
                            </div>
                        </div>

                        <div class="project-card-body p-3">
                            <h3 class="project-title mb-3">
                                {{ Str::limit($proyecto->nombre, 25) }}
                            </h3>

                            <p class="project-desc mb-4">
                                {{ Str::limit($proyecto->descripcion, 90) }}
                            </p>

                            <div class="project-meta p-2 mb-4">
                                <div class="row g-0">
                                    <div class="col-4 meta-label">STACK:</div>
                                    <div class="col-8 text-end meta-value">Laravel, Vue, MySQL</div>
                                </div>
                                <div class="row g-0 mt-1">
                                    <div class="col-4 meta-label">TYPE:</div>
                                    <div class="col-8 text-end meta-value">Full Stack System</div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('public.detalle-proyecto', $proyecto) }}" class="btn-outline-custom p-2 d-flex justify-content-between align-items-center">
                                    <span>ANALIZAR CASO</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path></svg>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            @endforeach
        </div>
        
        <div class="mt-5 d-flex justify-content-center">
            <a href="#" class="load-more-btn">
                [ LOAD_MORE_DATA... ]
            </a>
        </div>

    </div>
</section>

    <footer class="py-4 footer-brutal">
        <div class="container text-center">
            <p class="m-0 footer-text">
                Mis Redes: 
                @if($perfil)
                    @foreach($perfil->redesSociales as $red)
                        <a href="{{ $red->url }}" target="_blank" class="footer-link mx-1">
                            {{ $red->nombre_red }}
                        </a> 
                        {{ $loop->last ? '' : ',' }}
                    @endforeach
                @else
                    LinkedIn, GitHub
                @endif
                | Contacto
            </p>
        </div>
    </footer>

</x-layouts.app>