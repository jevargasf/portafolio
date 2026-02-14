<x-layouts.app>

    <!-- <header class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="card border-2 shadow-sm rounded-0 p-4 p-lg-5 bg-white">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    
                    <div class="col-md-5 mb-4 mb-md-0 text-center">
                        @php
                            // Lógica para obtener la foto: si existe en BD usa esa, sino una default
                            $fotoUrl = ($perfil && $perfil->foto_perfil) 
                                ? $perfil->foto_perfil->url_publica 
                                : 'https://dummyimage.com/400x400/dee2e6/6c757d.jpg&text=JAVIER';
                        @endphp
                        <img class="img-fluid rounded border border-dark" 
                             src="{{ $fotoUrl }}" 
                             alt="Foto de {{ $perfil->usuario->nombres ?? 'Javier' }}" 
                             style="width: 100%; max-width: 350px; aspect-ratio: 1/1; object-fit: cover;" />
                    </div>

                    <div class="col-md-7">
                        <div class="text-center text-md-start">
                            <h1 class="display-5 fw-bolder text-dark mb-2">
                                HOLA, SOY {{ strtoupper($perfil->usuario->nombres ?? 'JAVIER') }}
                            </h1>
                            <div class="fs-4 mb-4 text-muted fst-italic">
                                {{ strtoupper($perfil->ocupacion ?? 'DESARROLLADOR FULL STACK') }}
                            </div>
                            
                    <div class="col-md-6">
                            <a class="btn btn-primary-custom btn-lg px-4 w-100 mb-2" href="">
                                [ DESCARGAR CV ]
                            </a>
                            <a class="btn btn-outline-custom btn-lg px-4 w-100" href="{{ route('public.proyectos') }}">
                                [ VER PROYECTOS ]
                            </a>
                    </div>        

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header> -->

    <header class="py-5 bg-white border-bottom border-2" style="border-color: var(--primary) !important;">
        <div class="container py-lg-5">
            <div class="row align-items-center gy-4">
                
                <div class="col-lg-7">
                    
                    <div class="mb-3 d-inline-flex align-items-center px-2 py-1 border border-dark bg-light rounded-1 font-monospace small">
                        <span class="text-success me-2">●</span>
                        <span class="text-muted">System.status: </span>
                        <strong class="ms-1 text-dark">Ready_to_work</strong>
                    </div>

                    <h1 class="display-3 fw-bold mb-3 lh-1 text-dark">
                        {{ strtoupper($perfil->usuario->nombre_completo ?? 'JAVIER') }}
                    </h1>
                    
                    <h2 class="h3 mb-4" style="color: var(--primary); font-family: var(--font-code);">
                        <span class="text-dark opacity-50">&lt;</span> 
                        {{ strtoupper($perfil->ocupacion ?? 'DESARROLLADOR FULL STACK') }}
                        <span class="text-dark opacity-50">/&gt;</span>
                    </h2>

                    <p class="lead text-secondary mb-5 pe-lg-5" style="font-size: 1.15rem;">
                        Desarrollador con base en <strong>Sociología</strong> y <strong>Ciencias Exactas</strong>. 
                        No solo escribo código; diseño sistemas analizando el problema desde sus primeros principios.
                        <br><br>
                        <span class="fs-6 fst-italic text-muted">
                            Especialista en Desarrollo Web, Lógica Algorítmica y Arquitectura de Datos.
                        </span>
                    </p>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="#proyectos" class="btn btn-primary-custom btn-lg px-4 py-3 d-flex align-items-center gap-2">
                            <span>VER PROYECTOS</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M13.0001 16.1716L18.3641 10.8076L19.7783 12.2218L12.0001 20L4.22192 12.2218L5.63614 10.8076L11.0001 16.1716V4H13.0001V16.1716Z"></path></svg>
                        </a>

                        <a href="" class="btn btn-outline-custom btn-lg px-4 py-3">
                            DESCARGAR CV
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 position-relative">
                    <div class="position-absolute w-100 h-100 border border-2 border-dark" 
                        style="top: 15px; left: 15px; z-index: 0; background-color: var(--primary-light);"></div>
                        @php
                            $fotoUrl = ($perfil && $perfil->foto_perfil) 
                                ? $perfil->foto_perfil->url_publica 
                                : 'https://dummyimage.com/400x400/dee2e6/6c757d.jpg&text=JAVIER';
                        @endphp
                        <img class="img-fluid position-relative border border-2 border-dark shadow-none w-100" 
                             src="{{ $fotoUrl }}" 
                             alt="Foto de {{ $perfil->usuario->nombres ?? 'Javier' }}" 
                             style="z-index: 1; object-fit: cover; aspect-ratio: 1/1;" />
                    <div class="position-absolute bg-white border border-dark p-2 font-monospace small" 
                        style="bottom: -15px; right: -15px; z-index: 2; box-shadow: 4px 4px 0px var(--primary);">
                        Actualmente interesado en <br> <strong>filosofía First Principles</strong>
                    </div>
                </div>

            </div>
        </div>
    </header>

<section id="proyectos" class="py-5 bg-light">
    <div class="container py-lg-4">
        
        <div class="mb-5 border-bottom border-dark pb-3 d-flex align-items-end">
            <h2 class="h1 fw-bold mb-0 text-uppercase" style="color: var(--primary); font-family: var(--font-code);">
                <span class="text-secondary opacity-50">./</span>Proyectos_Desplegados
            </h2>
            <span class="ms-3 badge bg-white text-dark border border-dark rounded-0 font-monospace">
                Total: {{ $perfil->proyectos->count() }}
            </span>
        </div>

        <div class="row g-4">
            @foreach($perfil->proyectos as $proyecto)
            <div class="col-lg-6 col-xl-4">
                
                <div class="card h-100 border-0 bg-transparent">
                    
                    <div class="position-relative h-100 bg-white border border-2 border-dark" 
                         style="box-shadow: 6px 6px 0px var(--primary-light);">
                        
                        <div class="card-header bg-white border-bottom border-dark py-2 d-flex justify-content-between align-items-center">
                            <small class="font-monospace text-muted fw-bold">
                                ID: #{{ str_pad($proyecto->id, 3, '0', STR_PAD_LEFT) }}
                            </small>
                            <span class="badge rounded-0 fw-normal font-monospace
                                {{ $proyecto->estado ? 'bg-success text-white' : 'bg-warning text-dark' }}">
                                {{ $proyecto->estado ? '● PRODUCTION' : '○ DEVELOPMENT' }}
                            </span>
                        </div>

                        <div class="p-3 pb-0">
                            <div class="ratio ratio-16x9 border border-dark bg-light overflow-hidden position-relative group-hover-zoom">
                                <div class="overlay-tech d-flex align-items-center justify-content-center">
                                    <span class="btn btn-sm btn-light font-monospace">VIEW_SOURCE</span>
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
                                    <div class="d-flex align-items-center justify-content-center h-100 text-muted font-monospace">
                                        [NO_IMAGE_DATA]
                                    </div>
                                @endif
                            
                            </div>
                        </div>

                        <div class="card-body">
                            <h3 class="h5 fw-bold text-uppercase mb-3" style="font-family: var(--font-code);">
                                {{ Str::limit($proyecto->nombre, 25) }}
                            </h3>

                            <p class="card-text text-secondary small mb-4" style="min-height: 60px;">
                                {{ Str::limit($proyecto->descripcion, 90) }}
                            </p>

                            <div class="bg-light p-2 border border-start-0 border-end-0 border-dark mb-4 font-monospace" style="font-size: 0.8rem;">
                                <div class="row g-0">
                                    <div class="col-4 fw-bold text-uppercase text-muted">STACK:</div>
                                    <div class="col-8 text-end text-dark">Laravel, Vue, MySQL</div>
                                </div>
                                <div class="row g-0 mt-1">
                                    <div class="col-4 fw-bold text-uppercase text-muted">TYPE:</div>
                                    <div class="col-8 text-end text-dark">Full Stack System</div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('public.detalle-proyecto', $proyecto) }}" class="btn btn-outline-custom rounded-0 d-flex justify-content-between align-items-center">
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
            <a href="#" class="btn btn-link text-decoration-none text-muted font-monospace">
                [ LOAD_MORE_DATA... ]
            </a>
        </div>

    </div>
</section>

    <footer class="py-4 bg-white border-top border-2 border-dark">
        <div class="container text-center">
            <p class="m-0 fw-bold text-uppercase">
                Mis Redes: 
                @if($perfil)
                    @foreach($perfil->redesSociales as $red)
                        <a href="{{ $red->url }}" target="_blank" class="text-decoration-none text-dark mx-1">
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