<x-layouts.app>

    <h2 class="text-center mt-3">Iniciar Sesión</h2>
    <div class="card p-4 mx-auto my-5 text-center" id="formLogin">
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico</label>
                <input type="email" name="correo" class="form-control" id="correo" placeholder="correo@ejemplo.com">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>

            <button class="btn btn-primary" type="submit">Entrar</button>
        </form>
    </div>
</x-layouts.app>