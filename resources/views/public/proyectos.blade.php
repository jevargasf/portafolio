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
                            <svg class="text-muted fs-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M2.9918 21C2.44405 21 2 20.5551 2 20.0066V3.9934C2 3.44476 2.45531 3 2.9918 3H21.0082C21.556 3 22 3.44495 22 3.9934V20.0066C22 20.5552 21.5447 21 21.0082 21H2.9918ZM20 15V5H4V19L14 9L20 15ZM20 17.8284L14 11.8284L6.82843 19H20V17.8284ZM8 11C6.89543 11 6 10.1046 6 9C6 7.89543 6.89543 7 8 7C9.10457 7 10 7.89543 10 9C10 10.1046 9.10457 11 8 11Z"></path></svg>
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
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M5.88401 18.6533C5.58404 18.4526 5.32587 18.1975 5.0239 17.8369C4.91473 17.7065 4.47283 17.1524 4.55811 17.2583C4.09533 16.6833 3.80296 16.417 3.50156 16.3089C2.9817 16.1225 2.7114 15.5499 2.89784 15.0301C3.08428 14.5102 3.65685 14.2399 4.17672 14.4263C4.92936 14.6963 5.43847 15.1611 6.12425 16.0143C6.03025 15.8974 6.46364 16.441 6.55731 16.5529C6.74784 16.7804 6.88732 16.9182 6.99629 16.9911C7.20118 17.1283 7.58451 17.1874 8.14709 17.1311C8.17065 16.7489 8.24136 16.3783 8.34919 16.0358C5.38097 15.3104 3.70116 13.3952 3.70116 9.63971C3.70116 8.40085 4.0704 7.28393 4.75917 6.3478C4.5415 5.45392 4.57433 4.37284 5.06092 3.15636C5.1725 2.87739 5.40361 2.66338 5.69031 2.57352C5.77242 2.54973 5.81791 2.53915 5.89878 2.52673C6.70167 2.40343 7.83573 2.69705 9.31449 3.62336C10.181 3.41879 11.0885 3.315 12.0012 3.315C12.9129 3.315 13.8196 3.4186 14.6854 3.62277C16.1619 2.69 17.2986 2.39649 18.1072 2.52651C18.1919 2.54013 18.2645 2.55783 18.3249 2.57766C18.6059 2.66991 18.8316 2.88179 18.9414 3.15636C19.4279 4.37256 19.4608 5.45344 19.2433 6.3472C19.9342 7.28337 20.3012 8.39208 20.3012 9.63971C20.3012 13.3968 18.627 15.3048 15.6588 16.032C15.7837 16.447 15.8496 16.9105 15.8496 17.4121C15.8496 18.0765 15.8471 18.711 15.8424 19.4225C15.8412 19.6127 15.8397 19.8159 15.8375 20.1281C16.2129 20.2109 16.5229 20.5077 16.6031 20.9089C16.7114 21.4504 16.3602 21.9773 15.8186 22.0856C14.6794 22.3134 13.8353 21.5538 13.8353 20.5611C13.8353 20.4708 13.836 20.3417 13.8375 20.1145C13.8398 19.8015 13.8412 19.599 13.8425 19.4094C13.8471 18.7019 13.8496 18.0716 13.8496 17.4121C13.8496 16.7148 13.6664 16.2602 13.4237 16.051C12.7627 15.4812 13.0977 14.3973 13.965 14.2999C16.9314 13.9666 18.3012 12.8177 18.3012 9.63971C18.3012 8.68508 17.9893 7.89571 17.3881 7.23559C17.1301 6.95233 17.0567 6.54659 17.199 6.19087C17.3647 5.77663 17.4354 5.23384 17.2941 4.57702L17.2847 4.57968C16.7928 4.71886 16.1744 5.0198 15.4261 5.5285C15.182 5.69438 14.8772 5.74401 14.5932 5.66413C13.7729 5.43343 12.8913 5.315 12.0012 5.315C11.111 5.315 10.2294 5.43343 9.40916 5.66413C9.12662 5.74359 8.82344 5.69492 8.57997 5.53101C7.8274 5.02439 7.2056 4.72379 6.71079 4.58376C6.56735 5.23696 6.63814 5.77782 6.80336 6.19087C6.94565 6.54659 6.87219 6.95233 6.61423 7.23559C6.01715 7.8912 5.70116 8.69376 5.70116 9.63971C5.70116 12.8116 7.07225 13.9683 10.023 14.2999C10.8883 14.3971 11.2246 15.4769 10.5675 16.0482C10.3751 16.2156 10.1384 16.7802 10.1384 17.4121V20.5611C10.1384 21.5474 9.30356 22.2869 8.17878 22.09C7.63476 21.9948 7.27093 21.4766 7.36613 20.9326C7.43827 20.5204 7.75331 20.2116 8.13841 20.1276V19.1381C7.22829 19.1994 6.47656 19.0498 5.88401 18.6533Z"></path></svg>
                                 source_code
                            </a>

                            <a href="{{ route('public.detalle-proyecto', $proyecto) }}" class="btn btn-primary-custom rounded-0 d-flex align-items-center gap-2 px-4">
                                <span>OPEN_RECORD</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path></svg>
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