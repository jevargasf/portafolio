<x-layouts.app>

    <header class="py-5">
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
                            
                            <a class="btn btn-outline-dark btn-lg px-4 rounded-0" href="#proyectos">
                                [ VER PROYECTOS ]
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <section id="proyectos" class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            
            <div class="text-center mb-5">
                <h2 class="fw-bolder">PROYECTOS DESTACADOS</h2>
                <hr class="mx-auto" style="width: 50px; border-top: 3px solid #333;">
            </div>

            <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center">
                
                @forelse($perfil->proyectos as $proyecto)
                    <div class="col mb-5">
                        <div class="card h-100 border-dark rounded-0 shadow-sm h-100">
                            @php
                                // Buscamos la portada (definimos esto en pasos anteriores)
                                $portada = $proyecto->documentos->where('es_portada', 1)->first();
                                $imgProyecto = $portada ? $portada->url_publica : 'https://dummyimage.com/600x400/dee2e6/6c757d.jpg&text=Proyecto';
                            @endphp
                            
                            <a href="{{ route('public.detalle-proyecto', $proyecto->slug) }}">
                                <img class="card-img-top rounded-0" src="{{ $imgProyecto }}" alt="{{ $proyecto->nombre }}" style="height: 200px; object-fit: cover;" />
                            </a>

                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder mb-3 text-uppercase">
                                        {{ $proyecto->nombre }}
                                    </h5>
                                    
                                    <div class="d-flex justify-content-center flex-wrap gap-2">
                                        @foreach($proyecto->tecnologias->take(4) as $tech)
                                            <span class="badge border border-dark text-dark bg-transparent rounded-0">
                                                {{ strtoupper($tech->nombre) }}
                                            </span>
                                        @endforeach
                                        
                                        @if($proyecto->tecnologias->count() > 4)
                                            <span class="badge text-muted small">+{{ $proyecto->tecnologias->count() - 4 }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-sm btn-dark mt-auto rounded-0 w-100" href="{{ route('public.detalle-proyecto', $proyecto->slug) }}">
                                        Ver detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Aún no hay proyectos públicos para mostrar.</p>
                    </div>
                @endforelse

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