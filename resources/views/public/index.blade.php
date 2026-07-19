<x-layouts.app :perfil=$perfil >
    <header class="hero__header">
        <div class="hero__wrapper">
            <div class="hero__description">
            <!-- badge -->
                <div class="badge__brand">
                    <span class="hero__badge--dot">●</span>
                    <span class="hero__badge--status">Estado_Actual: </span>
                    <strong class="hero__badge--value">Disponible</strong>
                </div>

                <!-- título hero -->
                <h1 class="hero__title">
                    {{ strtoupper($perfil->usuario->nombre_completo ?? 'JAVIER') }}
                </h1>
                
                <!-- ocupación profesional -->
                <h2 class="hero__subtitle">
                    <span>&lt;</span> 
                    {{ $perfil->ocupacion ?? 'Desarrollador Full Stack' }}
                    <span>/&gt;</span>
                </h2>

                <p class="hero__lead">
                    {{ $perfil->index_bio }}
                    <br><br>
                    <span class="hero__specialty">
                        {{ $perfil->index_especialidad }}
                    </span>
                </p>

                <!-- contenedor botones -->
                <div class="hero__buttons">
                    <a href="#proyectos" class="btn__brand--primary">
                        <span>VER PROYECTOS</span>
                        <!-- AQUÍ IBA UN ÍCONO DE FLECHA -->
                    </a>

                    <a href="{{ route('public.descargar-cv')}}" class="btn__brand--outline">
                        DESCARGAR CV
                    </a>
                </div>
            </div>
                <!-- img header -->
            <div  class="hero__image">
                    @php
                        $fotoUrl = ($perfil && $perfil->foto_perfil) 
                            ? $perfil->foto_perfil->url_publica 
                            : 'https://dummyimage.com/400x400/dee2e6/6c757d.jpg&text=JAVIER';
                    @endphp
                    <img class="hero__image--photo" 
                            src="{{ $fotoUrl }}" 
                            alt="Foto de {{ $perfil->usuario->nombres ?? 'Javier' }}" />
                <div class="hero__image--label">
                    Actualmente interesado en <br> <strong>Servidores Web Locales</strong>
                </div>
            </div>                
        </div>
    </header>

<!-- PROYECTOS -->
<section id="proyectos" class="projects-section">
    <div class="section__wrapper">

        <div class="projects-section__header">
            <h2 class="section__title projects-section__title">
                Mis Proyectos
            </h2>
            <span class="badge__brand">
                Total: {{ $perfil->proyectos->count() }}
            </span>
        </div>

        <div class="project-cards__wrapper">
            @foreach($perfil->proyectos as $proyecto)
                <div class="card">
                    <div class="project-card__btn">
                        <a href="{{ route('public.detalle-proyecto', $proyecto) }}">
                        <div class="project-card__header">
                            <span class="project-card__type">
                                WEB
                            </span>
                            <div class="project-card__status">
                                <span class="project-card__status-value {{ $proyecto->estado ? 'status-prod' : 'status-dev' }}">
                                    {{ $proyecto->estado ? '● EN PRODUCCIÓN' : '○ EN DESARROLLO' }}
                                </span>
                            </div>

                        </div>

                        <div class="project-card__image-wrapper">
                            @php
                                $portada = $proyecto->documentos->where('es_portada', 1)->first();
                                $imgProyecto = $portada ? $portada->url_publica : 'https://dummyimage.com/600x400/dee2e6/6c757d.jpg&text=Proyecto';
                            @endphp
                                @if($imgProyecto)
                                    <img src="{{ $imgProyecto }}" 
                                            class="project-card__image" 
                                            alt="{{ $proyecto->nombre }}">
                                @else
                                    <div class="project-card__image--no-image">
                                        [NO_IMAGE_DATA]
                                    </div>
                                @endif
                            
                        </div>

                        <div class="project-card__body">
                            <h3 class="project-card__title">
                                {{ $proyecto->nombre }}
                            </h3>

                            <p class="project-card__description">
                                {{ $proyecto->descripcion }}
                            </p>

                            <div class="project-card__stack">
                                @foreach($proyecto->tecnologias as $tecnologia)
                                <div class="badge__brand stack__value">{{ $tecnologia->nombre }}</div>
                                @endforeach

                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- <div class="more__container"> 
            
            <a href="#" class="more__btn">
                [ CARGAR__MÁS... ]
            </a>
        </div> -->
    </div>    
    <dialog id="proximamenteAlert">
        <x-icons.info-circled/>
        <h4>Portafolio en Desarrollo</h4>
        <p>
            Próximamente: Fichas de detalle proyecto, información profesional y formulario de contacto.
        </p>
        <form method="dialog">
            <button class="btn__brand--primary">Aceptar</button>
        </form>
    </dialog>    
</section>


    @push('scripts')
        <script src="{{ asset('js/public/nav.js') }}"></script>
        <script src="{{ asset('js/public/index.js') }}"></script>
    @endpush
</x-layouts.app>