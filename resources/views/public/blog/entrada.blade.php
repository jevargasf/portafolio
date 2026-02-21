<x-layouts.blog>
    <div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            
            <header class="mb-5">
                <h1 class="fw-bolder mb-2">{{ $entrada->titulo }}</h1>
                <div class="text-muted fst-italic">
                    Publicado el {{ $entrada->fecha_publicacion->format('d/m/Y') }}
                </div>
            </header>

            @if(isset($entrada->portada))
                <figure class="mb-4">
                    <img class="img-fluid rounded" src="{{ asset('storage/' . $entrada->portada) }}" alt="{{ $entrada->titulo }}">
                </figure>
            @endif

            <section class="mb-5 render-wysiwyg">
                {!! $entrada->contenido !!}
            </section>

            <div class="mt-4 pt-4 border-top">
                <a href="{{ route('public.blog-personal') }}" class="btn btn-outline-secondary">
                    &larr; Volver al blog
                </a>
            </div>

        </div>
    </div>
</div>

<style>
    /* * Por qué esto es necesario:
     * Los editores WYSIWYG a menudo insertan imágenes sin clases responsivas (como .img-fluid de Bootstrap).
     * Esta regla fuerza a que cualquier imagen dentro de tu contenido no desborde el contenedor col-lg-8 en móviles.
     */
    .render-wysiwyg img {
        max-width: 100%;
        height: auto;
        border-radius: 0.375rem; /* Opcional: para mantener consistencia con Bootstrap */
    }

    /* Opcional: Ajustar el espaciado de los iframes (ej: videos de YouTube) insertados por el WYSIWYG */
    .render-wysiwyg iframe {
        max-width: 100%;
    }
</style>
</x-layouts.blog>