<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('blog-personal.index') }}">
            ~/LHMQMQ
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('blog-personal.index') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog-personal.acerca-de') }}">Acerca de</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog-personal.form-suscripcion') }}">Sucribirse</a>
                </li>
            </ul>
        </div>
    </div>
</nav>