<x-layouts.blog>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-sm border-0 bg-white">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="card-title h4 mb-4" style="font-family: monospace; font-weight: 600;">>_ Suscripción al Blog</h2>
                        
                        <div class="mb-4 text-muted small">
                            <p class="mb-2 fw-bold text-dark">Política de Datos del Blog:</p>
                            <ul class="list-unstyled mb-0" style="padding-left: 0.75rem; border-left: 2px solid #dee2e6;">
                                <li class="mb-2">
                                    <span class="text-dark" style="font-weight: 500;">Datos Mínimos:</span> Almacenaré exclusivamente tu dirección de correo electrónico. No requiero la creación de cuentas.
                                </li>
                                <li class="mb-2">
                                    <span class="text-dark" style="font-weight: 500;">Finalidad Exclusiva:</span> Utilizaré este canal estrictamente para enviarte notificaciones sobre nuevas publicaciones.
                                </li>
                                <li class="mb-2">
                                    <span class="text-dark" style="font-weight: 500;">Aislamiento:</span> No implemento rastreo de terceros ni analizo tu comportamiento en este sitio.
                                </li>
                                <li class="mb-2">
                                    <span class="text-dark" style="font-weight: 500;">Validación de Datos:</span> Requeriré tu confirmación a través de un enlace seguro enviado a tu bandeja de entrada para prevenir suscripciones no autorizadas.
                                </li>
                                <li>
                                    <span class="text-dark" style="font-weight: 500;">Seguridad Defensiva:</span> Me reservo el derecho de bloquear el acceso y tomar medidas ante la detección de actividad anómala.
                                </li>
                            </ul>
                        </div>

                        <div id="alert-container"></div>

                        <form id="formSuscripcion" action="/suscribirse" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="correo" class="form-label visually-hidden">Escribe tu dirección de correo electrónico</label>
                                <input type="email" 
                                    class="form-control form-control-lg bg-light border-0" 
                                    id="correo" 
                                    name="correo" 
                                    placeholder="usuario@tudominio.com" 
                                    required 
                                    autocomplete="off">
                                <div class="invalid-feedback" id="correo-error"></div>
                            </div>

                            <button type="submit" class="btn btn-dark w-100 py-2" id="btnSubmit">
                                <span id="btnText">Solicitar Notificaciones</span>
                                <span class="spinner-border spinner-border-sm d-none" id="btnSpinner" role="status" aria-hidden="true"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js\blog\suscriptores\formSuscripcion.js') }}"></script>
    @endpush
</x-layouts.blog>