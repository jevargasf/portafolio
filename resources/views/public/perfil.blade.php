<x-layouts.app :perfil=$perfil>
    <div class="back-link">
        <a class="back-link__btn" href="{{ route('public.inicio') }}">Volver</a>
    </div>
    <!-- DOS COLUMNAS 60-40 -->
    <div class="profile">
        <main class="profile__main">
            <!-- IZQUIERDA: PERFIL PROFESIONAL -->
            <section class="profile__about">
            </section>

            <!-- IZQUIERDA ABAJO: TRAYECTORIA LABORAL (LÍNEA DE TIEMPO) -->
            <section class="profile__trajectory">

            </section>
        </main>

        <aside class="profile__aside">
            <!-- DERECHA: STACK ORDENADO EN UN JSON POR TIPO -->
            <section class="profile__technologies">

            </section>
            <!-- DERECHA: CERTIFICACIONES ? -->
            <section class="profile__certifications">
                
            </section>
        </aside>
    </div>

 
</x-layouts.app>