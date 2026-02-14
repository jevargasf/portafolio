<x-layouts.app>

    <div class="container px-4 my-5">

    
    <div class="mb-5 border-bottom border-dark pb-3 mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb font-monospace text-uppercase mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('public.inicio') }}" class="text-muted text-decoration-none">~/Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="color: var(--primary);">
                    ./Profile_Config
                </li>
            </nav>
        </nav>
    </div>

<div class="row gy-5 mb-5">
    <div class="col-lg-6 pe-lg-5">
        <div class="d-flex align-items-center gap-4 mb-4">
            <div class="position-relative">
                <div class="position-absolute w-100 h-100 bg-dark" style="top: 5px; left: 5px; z-index: 0;"></div>
                <img src="{{ $perfil->foto_perfil->url_publica }}" alt="Javier" 
                     class="position-relative border border-2 border-dark" 
                     style="width: 100px; height: 100px; object-fit: cover; z-index: 1;">
            </div>
            <div>
                <h1 class="h2 fw-bold mb-0 text-uppercase" style="font-family: var(--font-code);">
                    Javier Vargas
                </h1>
                <p class="text-muted font-monospace mb-0">
                    <span style="color: var(--primary);">root@sociodev</span>
                </p>
            </div>
        </div>

        <h3 class="h5 fw-bold text-uppercase mb-3" style="font-family: var(--font-code);">
            > System_Philosophy
        </h3>
        <p class="text-dark">
            Programar es escribir las reglas de la interacción social digital. 
            Como <strong>Sociólogo</strong> y <strong>Desarrollador</strong>, no solo construyo funciones; 
            analizo el impacto y la lógica detrás de cada línea de código.
        </p>
        <p class="text-muted small">
            Enfoque: <strong>Primeros Principios</strong>. Descompongo problemas complejos (como el Cubo Rubik) 
            a sus bases matemáticas para reconstruir soluciones eficientes, no parches.
        </p>
        
        <a href="/cv" class="btn btn-outline-custom font-monospace btn-sm mt-2">
            DOWNLOAD_CV.PDF
        </a>
    </div>

    <div class="col-lg-6">
        <div class="card border border-2 border-dark rounded-0 shadow" style="background-color: #1e1e1e;">
            <div class="card-header border-bottom border-secondary bg-dark py-2 d-flex">
                 <div class="d-flex gap-2">
                    <span class="rounded-circle bg-danger" style="width: 10px; height: 10px;"></span>
                    <span class="rounded-circle bg-warning" style="width: 10px; height: 10px;"></span>
                    <span class="rounded-circle bg-success" style="width: 10px; height: 10px;"></span>
                </div>
                <small class="text-muted font-monospace mx-auto">javier@skills: ~/json</small>
            </div>
            <div class="card-body font-monospace p-3 text-light" style="font-size: 0.8rem;">
                <span class="text-success">javier@skills:~$</span> cat stack.json<br>
                <span style="color: #ce9178;">{</span><br>
                &nbsp;&nbsp;<span style="color: #9cdcfe;">"backend"</span>: <span style="color: #ce9178;">"Laravel, PHP, Django, Node.js, SQL"</span>,<br>
                &nbsp;&nbsp;<span style="color: #9cdcfe;">"frontend"</span>: <span style="color: #ce9178;">"CSS, JavaScript, Bootstrap, Blade, React"</span>,<br>
                &nbsp;&nbsp;<span style="color: #9cdcfe;">"analysis"</span>: <span style="color: #ce9178;">"Python"</span><br>
                <span style="color: #ce9178;">}</span>
                <span class="blink-cursor">_</span>
            </div>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col-12">
        <h3 class="h4 fw-bold mb-4 border-bottom border-dark pb-2 text-uppercase" 
            style="font-family: var(--font-code); color: var(--primary);">
            > System_Logs: Trayectoria
        </h3>
    </div>

<div class="col-lg-8 mx-auto">
    <div class="border-start border-2 border-dark ps-4 position-relative py-2">
        
        @foreach($timeline as $item)
            
            {{-- LÓGICA PARA ITEMS GRANDES (Major Releases) --}}
            @if($item['es_hito'])
                <div class="mb-5 position-relative">
                    <div class="position-absolute border border-dark rounded-circle d-flex align-items-center justify-content-center" 
                         style="width: 32px; height: 32px; left: -41px; top: 0px; background-color: {{ $item['tipo'] == 'WORK' ? 'var(--primary)' : 'white' }};">
                        
                        @if($item['tipo'] == 'WORK')
                            <svg class="text-white small" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M7 5V2C7 1.44772 7.44772 1 8 1H16C16.5523 1 17 1.44772 17 2V5H21C21.5523 5 22 5.44772 22 6V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V6C2 5.44772 2.44772 5 3 5H7ZM4 16V19H20V16H4ZM4 14H20V7H4V14ZM9 3V5H15V3H9ZM11 11H13V13H11V11Z"></path></svg>
                        @else
                            <svg class="text-dark small" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M13 21V23H11V21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H9C10.1947 3 11.2671 3.52375 12 4.35418C12.7329 3.52375 13.8053 3 15 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H13ZM20 19V5H15C13.8954 5 13 5.89543 13 7V19H20ZM11 19V7C11 5.89543 10.1046 5 9 5H4V19H11Z"></path></svg>
                        @endif
                    </div>
                    
                    <span class="badge bg-light text-dark border border-dark rounded-0 font-monospace mb-2">
                        {{ \Carbon\Carbon::parse($item['fecha'])->format('Y') }}
                    </span>

                    <h4 class="fw-bold h5 mb-1">{{ $item['titulo'] }}</h4>
                    <div class="text-muted small font-monospace text-uppercase mb-2">{{ $item['subtitulo'] }}</div>
                    
                    @if($item['descripcion'])
                        <p class="text-secondary small">{{ Str::limit($item['descripcion'], 150) }}</p>
                    @endif
                </div>

            {{-- LÓGICA PARA CERTIFICACIONES (Patches/Updates) --}}
            @else
                <div class="mb-4 position-relative">
                    <div class="position-absolute bg-white border border-2 border-secondary rounded-circle" 
                         style="width: 12px; height: 12px; left: -31px; top: 6px;"></div>
                    
                    <div class="d-flex align-items-center gap-2">
                        <span class="font-monospace text-muted small" style="min-width: 50px;">
                            {{ \Carbon\Carbon::parse($item['fecha'])->format('M Y') }}
                        </span>
                        
                        <div class="font-monospace small text-dark">
                            <span class="text-success">✔ Installed:</span> 
                            <strong>{{ $item['titulo'] }}</strong> 
                            <span class="text-muted">from {{ $item['subtitulo'] }}</span>
                        </div>
                    </div>
                </div>
            @endif

        @endforeach

    </div>
</div>
<!-- 
<div class="mt-5 pt-4 border-top border-dark">
    <h4 class="font-monospace text-uppercase mb-3 small text-muted">> Other_Dependencies (Certifications)</h4>
    
    <div class="d-flex flex-wrap gap-2">
        foreach(certificaciones as cert)
            <div class="border border-secondary px-2 py-1 bg-light font-monospace small d-flex align-items-center gap-2" 
                 title=" cert->nombre }} -  cert->fecha_obtencion }}">
                <svg class="text-muted" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M8 2V4H5L4.999 14H18.999L19 4H16V2H20C20.5523 2 21 2.44772 21 3V21C21 21.5523 20.5523 22 20 22H4C3.44772 22 3 21.5523 3 21V3C3 2.44772 3.44772 2 4 2H8ZM18.999 16H4.999L5 20H19L18.999 16ZM17 17V19H15V17H17ZM12 2L16 6H13V11H11V6H8L12 2Z"></path></svg> <span> Str::limit($cert->nombre, 20) }}</span>
                <span class="badge bg-secondary text-white" style="font-size: 0.6rem;">$cert->plataforma }}</span>
            </div>
        endforeach
    </div>
</div> -->

    </div>
</x-layouts.app>