<x-layouts.app :perfil=$perfil >
    <div class="back-link">
        <a class="back-link__btn" href="{{ route('public.inicio') }}">Volver</a>
    </div>

    <!-- HEADER DEL PROYECTO CON -->
    <header class="project__header">
    <!-- TÍTUTLO -->
        <h1 class="project__title">
            {{ $proyecto->nombre }}
        </h1>
        <!-- IMAGEN DE PORTADA -->
        @php
            $portada = $proyecto->documentos->where('es_portada', 1)->first();
            $imgProyecto = $portada ? $portada->url_publica : 'https://dummyimage.com/600x400/dee2e6/6c757d.jpg&text=Proyecto';
        @endphp
        @if($imgProyecto)
        <img src="{{ $imgProyecto }}"  
            class="project__image" 
            alt="{{ $proyecto->nombre }}"
        >
        @endif
    </header>

    <!-- CONTENEDOR DE INFORMACIÓN CON 2 COLUMNAS --> 
    <main class="project-content">  
        <div class="project-content__wrapper">
            <section class="project-content__context">
                <p class="project-content__text">
                    {{ $proyecto->descripcion }}
                </p>
            </section>
            <section class="project-content__context">
                <h2 class="project-content__title">Desafío: </h2>
                <p class="project-content__text">
                    {{ $proyecto->desafio }}
                </p>
            </section>

            <section class="project-content__context">
                <h2 class="project-content__title">Solución: </h2>
                <p class="project-content__text">
                    {{ $proyecto->solucion }}
                </p>
            </section>
        </div>
        <!-- COLUMNA 2: METADATA (FICHA TÉCNICA) -->
        <aside class="project-content__meta project-meta">
            <div class="project-content__dates">
                <span>Fecha despliegue:</span>
                <span>{{ $proyecto->fecha_realizacion->format('d/m/Y') }}</span>
            </div>
        <!-- STACK (BADGES) -->
         <div class="project-content__stack">
            <span>Tecnologías:</span>
            @foreach($proyecto->tecnologias as $tecnologia)
            <div class="badge__brand stack__value">{{ $tecnologia->nombre }}</div>
            @endforeach
         </div>
        <!-- CONTENEDOR DE BOTONES DE LINKS Y DOCUMENTOS -->
         <div class="project-content__links">
            @if($proyecto->url_produccion)
                <a class="btn-brand--primary" href="{{ $proyecto->url_produccion }}" target="_blank" rel="noopener noreferrer">Ver Proyecto Desplegado</a>
            @endif
            @if($proyecto->url_repositorio)
            <a class="btn-brand--outline" href="{{ $proyecto->url_repositorio }}" target="_blank" rel="noopener noreferrer">Repositorio Proyecto</a>
            @else
                <span class="text-muted">El código fuente de este proyecto es privado.</span>
            @endif
         </div>
        </aside>
    
    </main>

</x-layouts.app>