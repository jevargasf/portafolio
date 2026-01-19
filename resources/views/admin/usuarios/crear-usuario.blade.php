<x-layouts.dashboard>
    <h2 class="text-center mt-3">Crear Usuario</h2>
    <div class="card p-4 mx-auto my-5 text-center form-admin" id="formCrearUsuario">
        <form action="{{ route('usuarios.crear') }}" method="POST">
            @csrf


            <div class="mb-3">
                <label for="run" class="form-label">RUN</label>
                <input type="text" name="run" class="form-control" id="run" placeholder="12.345.678-0">
            </div>

            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" name="nombres" class="form-control" id="nombres" max="100">
            </div>

            <div class="mb-3">
                <label for="apellido_paterno" class="form-label">Apellido paterno</label>
                <input type="text" name="apellido_paterno" class="form-control" id="apellido_paterno" max="100">
            </div>

            <div class="mb-3">
                <label for="apellido_materno" class="form-label">Apellido materno</label>
                <input type="text" name="apellido_materno" class="form-control" id="apellido_materno" max="100">
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico</label>
                <input type="email" name="correo" class="form-control" id="correo" placeholder="correo@ejemplo.com">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>

            <div class="mb-3">
                <label for="password_rep" class="form-label">Repita su contraseña</label>
                <input type="password" name="password_rep" class="form-control" id="password_rep">
            </div>

            <button class="btn btn-primary" type="submit">Crear Usuario</button>
        </form>
    </div>
</x-layouts.dashboard>