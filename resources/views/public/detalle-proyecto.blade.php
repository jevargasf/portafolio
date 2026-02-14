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
                        <svg class="fs-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M2.9918 21C2.44405 21 2 20.5551 2 20.0066V3.9934C2 3.44476 2.45531 3 2.9918 3H21.0082C21.556 3 22 3.44495 22 3.9934V20.0066C22 20.5552 21.5447 21 21.0082 21H2.9918ZM20 15V5H4V19L14 9L20 15ZM20 17.8284L14 11.8284L6.82843 19H20V17.8284ZM8 11C6.89543 11 6 10.1046 6 9C6 7.89543 6.89543 7 8 7C9.10457 7 10 7.89543 10 9C10 10.1046 9.10457 11 8 11Z"></path></svg><br>
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
                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M7.82843 10.9999H20V12.9999H7.82843L13.1924 18.3638L11.7782 19.778L4 11.9999L11.7782 4.22168L13.1924 5.63589L7.82843 10.9999Z"></path></svg>
                     cd .. (Volver)
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
                                <span>LAUNCH_SYSTEM()</span> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M10 6V8H5V19H16V14H18V20C18 20.5523 17.5523 21 17 21H4C3.44772 21 3 20.5523 3 20V7C3 6.44772 3.44772 6 4 6H10ZM21 3V11H19L18.9999 6.413L11.2071 14.2071L9.79289 12.7929L17.5849 5H13V3H21Z"></path></svg>
                            </a>
                        @endif

                        @if($proyecto->url_repositorio)
                            <a href="{{ $proyecto->url_repositorio }}" target="_blank" class="btn btn-outline-dark rounded-0 font-monospace d-flex justify-content-between align-items-center bg-white">
                                <span>VIEW_SOURCE_CODE</span> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M5.88401 18.6533C5.58404 18.4526 5.32587 18.1975 5.0239 17.8369C4.91473 17.7065 4.47283 17.1524 4.55811 17.2583C4.09533 16.6833 3.80296 16.417 3.50156 16.3089C2.9817 16.1225 2.7114 15.5499 2.89784 15.0301C3.08428 14.5102 3.65685 14.2399 4.17672 14.4263C4.92936 14.6963 5.43847 15.1611 6.12425 16.0143C6.03025 15.8974 6.46364 16.441 6.55731 16.5529C6.74784 16.7804 6.88732 16.9182 6.99629 16.9911C7.20118 17.1283 7.58451 17.1874 8.14709 17.1311C8.17065 16.7489 8.24136 16.3783 8.34919 16.0358C5.38097 15.3104 3.70116 13.3952 3.70116 9.63971C3.70116 8.40085 4.0704 7.28393 4.75917 6.3478C4.5415 5.45392 4.57433 4.37284 5.06092 3.15636C5.1725 2.87739 5.40361 2.66338 5.69031 2.57352C5.77242 2.54973 5.81791 2.53915 5.89878 2.52673C6.70167 2.40343 7.83573 2.69705 9.31449 3.62336C10.181 3.41879 11.0885 3.315 12.0012 3.315C12.9129 3.315 13.8196 3.4186 14.6854 3.62277C16.1619 2.69 17.2986 2.39649 18.1072 2.52651C18.1919 2.54013 18.2645 2.55783 18.3249 2.57766C18.6059 2.66991 18.8316 2.88179 18.9414 3.15636C19.4279 4.37256 19.4608 5.45344 19.2433 6.3472C19.9342 7.28337 20.3012 8.39208 20.3012 9.63971C20.3012 13.3968 18.627 15.3048 15.6588 16.032C15.7837 16.447 15.8496 16.9105 15.8496 17.4121C15.8496 18.0765 15.8471 18.711 15.8424 19.4225C15.8412 19.6127 15.8397 19.8159 15.8375 20.1281C16.2129 20.2109 16.5229 20.5077 16.6031 20.9089C16.7114 21.4504 16.3602 21.9773 15.8186 22.0856C14.6794 22.3134 13.8353 21.5538 13.8353 20.5611C13.8353 20.4708 13.836 20.3417 13.8375 20.1145C13.8398 19.8015 13.8412 19.599 13.8425 19.4094C13.8471 18.7019 13.8496 18.0716 13.8496 17.4121C13.8496 16.7148 13.6664 16.2602 13.4237 16.051C12.7627 15.4812 13.0977 14.3973 13.965 14.2999C16.9314 13.9666 18.3012 12.8177 18.3012 9.63971C18.3012 8.68508 17.9893 7.89571 17.3881 7.23559C17.1301 6.95233 17.0567 6.54659 17.199 6.19087C17.3647 5.77663 17.4354 5.23384 17.2941 4.57702L17.2847 4.57968C16.7928 4.71886 16.1744 5.0198 15.4261 5.5285C15.182 5.69438 14.8772 5.74401 14.5932 5.66413C13.7729 5.43343 12.8913 5.315 12.0012 5.315C11.111 5.315 10.2294 5.43343 9.40916 5.66413C9.12662 5.74359 8.82344 5.69492 8.57997 5.53101C7.8274 5.02439 7.2056 4.72379 6.71079 4.58376C6.56735 5.23696 6.63814 5.77782 6.80336 6.19087C6.94565 6.54659 6.87219 6.95233 6.61423 7.23559C6.01715 7.8912 5.70116 8.69376 5.70116 9.63971C5.70116 12.8116 7.07225 13.9683 10.023 14.2999C10.8883 14.3971 11.2246 15.4769 10.5675 16.0482C10.3751 16.2156 10.1384 16.7802 10.1384 17.4121V20.5611C10.1384 21.5474 9.30356 22.2869 8.17878 22.09C7.63476 21.9948 7.27093 21.4766 7.36613 20.9326C7.43827 20.5204 7.75331 20.2116 8.13841 20.1276V19.1381C7.22829 19.1994 6.47656 19.0498 5.88401 18.6533Z"></path></svg>
                            </a>
                        @else
                            <button disabled class="btn btn-light border border-secondary rounded-0 font-monospace text-muted d-flex justify-content-between">
                                <span>SOURCE_PRIVATE</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M19 10H20C20.5523 10 21 10.4477 21 11V21C21 21.5523 20.5523 22 20 22H4C3.44772 22 3 21.5523 3 21V11C3 10.4477 3.44772 10 4 10H5V9C5 5.13401 8.13401 2 12 2C15.866 2 19 5.13401 19 9V10ZM5 12V20H19V12H5ZM11 14H13V18H11V14ZM17 10V9C17 6.23858 14.7614 4 12 4C9.23858 4 7 6.23858 7 9V10H17Z"></path></svg>
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