<x-layouts.app>

    <div class="container px-4 my-5">
        
        <div class="mb-4">
            <a href="{{ route('public.inicio') }}" class="btn-ghost-custom fw-bold">
                <i class="ri-arrow-left-line me-1"></i> < Volver al inicio
            </a>
        </div>

        <div class="row g-5">
            
            <div class="col-lg-8">
                
                <div class="card border-dark rounded-0 shadow-sm mb-5">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex flex-column flex-md-row align-items-center gap-4">
                            @if($perfil->foto_perfil)
                            <img src="{{ $perfil->foto_perfil->url_publica }}" 
                                 class="rounded-circle border border-2 border-dark" 
                                 style="width: 100px; height: 100px; object-fit: cover;" alt="Avatar">
                            @endif

                            <div class="flex-grow-1 text-center text-md-start">
                                
                                <h1 class="display-5 fw-bolder text-uppercase mb-2">
                                    {{ $perfil->usuario->nombre_completo }}
                                </h1>
                                <h4 class="text-primary fw-bold mb-3">{{ $perfil->ocupacion }}</h4>
                                <p class="lead text-muted fs-6 mb-4">
                                    {{ $perfil->biografia }}
                                </p>
                                
                                @if($perfil->cv)
                                    <a href="{{ $perfil->cv->url_publica }}" target="_blank" class="btn btn-primary-custom rounded-0 px-4 py-2 fw-bold">
                                        <i class="ri-file-download-line me-2"></i> DESCARGAR CV
                                    </a>
                                @else
                                    <button class="btn btn-ghost-custom rounded-0 px-4 py-2" disabled>
                                        CV No disponible
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <h3 class="fw-bold text-uppercase mb-4 border-bottom border-dark pb-2">
                        <i class="ri-briefcase-line me-2"></i> Experiencia Laboral
                    </h3>

                    <div class="border-start border-2 border-dark ms-3 ps-4 position-relative">
                        
                        @foreach($perfil->experiencias->take(2) as $exp)
                            <x-ui.timeline-item :item="$exp" />
                        @endforeach

                        @if($perfil->experiencias->count() > 2)
                            <div class="collapse" id="collapseExperiencia">
                                @foreach($perfil->experiencias->skip(2) as $exp)
                                    <x-ui.timeline-item :item="$exp" />
                                @endforeach
                            </div>
                            
                            <button class="btn btn-outline-dark btn-sm rounded-0 mt-3 fw-bold" type="button" 
                                    data-bs-toggle="collapse" data-bs-target="#collapseExperiencia" 
                                    aria-expanded="false" aria-controls="collapseExperiencia"
                                    onclick="this.innerText = this.innerText == 'VER HISTORIAL COMPLETO' ? 'MOSTRAR MENOS' : 'VER HISTORIAL COMPLETO'">
                                VER HISTORIAL COMPLETO
                            </button>
                        @endif
                    </div>
                </div>

            </div>

            <div class="col-lg-4">
                
                <div class="card border-dark rounded-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white rounded-0 fw-bold text-uppercase py-3">
                        <i class="ri-graduation-cap-line me-2"></i> Educación
                    </div>
                    <div class="list-group list-group-flush">
                        @forelse($perfil->educacion as $edu)
                            <div class="list-group-item p-3 border-bottom">
                                <h6 class="fw-bold mb-1">{{ $edu->titulo_obtenido }}</h6>
                                <div class="small text-muted mb-2">{{ $edu->institucion }}</div>
                                <span class="badge bg-light text-dark border border-secondary rounded-0">
                                    {{ $edu->fecha_inicio ? $edu->fecha_inicio->format('Y') : '' }} - 
                                    {{ $edu->fecha_fin ? $edu->fecha_fin->format('Y') : 'Presente' }}
                                </span>
                            </div>
                        @empty
                            <div class="p-3 text-muted small">No hay información registrada.</div>
                        @endforelse
                    </div>
                </div>

                <div class="card border-dark rounded-0 shadow-sm">
                    <div class="card-header bg-white border-bottom border-dark rounded-0 fw-bold text-uppercase py-3">
                        <i class="ri-award-line me-2"></i> Certificaciones
                    </div>
                    <div class="card-body p-0">
                        @foreach($perfil->certificaciones->take(3) as $cert)
                            <div class="p-3 border-bottom {{ $loop->last ? 'border-bottom-0' : '' }}">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark">{{ $cert->nombre }}</h6>
                                        <small class="text-muted">{{ $cert->organizacion }}</small>
                                    </div>
                                    @if($cert->url_certificado)
                                        <a href="{{ $cert->url_certificado }}" target="_blank" class="text-dark" title="Ver Credencial">
                                            <i class="ri-external-link-line"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        @if($perfil->certificaciones->count() > 3)
                            <div class="collapse" id="collapseCerts">
                                @foreach($perfil->certificaciones->skip(3) as $cert)
                                    <div class="p-3 border-bottom border-top bg-light">
                                        <h6 class="fw-bold mb-0 small">{{ $cert->nombre }}</h6>
                                        <small class="text-muted">{{ $cert->organizacion }}</small>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-light rounded-0 text-muted small py-2" type="button" 
                                        data-bs-toggle="collapse" data-bs-target="#collapseCerts">
                                    Ver todas (+{{ $perfil->certificaciones->count() - 3 }})
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>