<x-layouts.main-panel>

    <h2 class="section__title panel__title">Iniciar Sesión</h2>
    <div class="card form__login">
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form__group">
                <label for="correo" class="form__label">Correo electrónico</label>
                <input type="email" name="correo" class="form__input" id="correo" placeholder="correo@ejemplo.com">
            </div>

            <div class="form__group">
                <label for="password" class="form__label">Contraseña</label>
                <input type="password" name="password" class="form__input" id="password">
            </div>
            <div class="button__container">
                <button class="btn__brand--primary" type="submit">Entrar</button>
            </div>
        </form>
    </div>
</x-layouts.main-panel>