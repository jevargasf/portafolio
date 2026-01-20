<div>
    @if (session('success'))
        <x-ui.alert type="success" class="mb-4">
            <i class="ri-checkbox-circle-line me-1"></i> {{ session('success') }}
        </x-ui.alert>
    @endif

    @if ($errors->any())
        <x-ui.alert type="danger" class="mb-4">
            <div class="d-flex align-items-center mb-1">
                <i class="ri-error-warning-line me-2"></i>
                <strong>Por favor corrige los siguientes errores:</strong>
            </div>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-ui.alert>
    @endif
    
    @if (session('error'))
        <x-ui.alert type="danger" class="mb-4">
             <i class="ri-close-circle-line me-1"></i> {{ session('error') }}
        </x-ui.alert>
    @endif
</div>