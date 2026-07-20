<x-layouts.app :perfil=$perfil>
    <div class="back-link">
        <a class="back-link__btn" href="{{ route('public.inicio') }}">Volver</a>
    </div>
    <!-- DOS COLUMNAS 60-40 -->
    <div class="profile">
        <main class="profile__main">
            <!-- IZQUIERDA: PERFIL PROFESIONAL -->
            <section class="profile__about">
                <h2>Perfil Profesional</h2>
                <p>{{ $perfil->biografia }}</p>
            </section>

            <!-- IZQUIERDA ABAJO: TRAYECTORIA LABORAL (LÍNEA DE TIEMPO) -->
            <section class="profile__trajectory">
                <h2>Trayectoria Profesional</h2>
            </section>
        </main>

        <aside class="profile__aside">
            <!-- DERECHA: STACK ORDENADO EN UN JSON POR TIPO -->
            <section class="profile__technologies">
                <h3>Tecnologías</h3>
                <div class="profile__json-technologies">
<pre>
{    
@foreach($tecnologiasAgrupadas as $key => $grupo)
  @if($key === 11)
"Diseño": [ 
        @foreach($grupo as $tecnologia)"{{ $tecnologia->nombre
}}"@if(!$loop->last),@endif

        @endforeach],
@elseif($key === 12)"Código": [
    @foreach($grupo as $tecnologia)
    "{{ $tecnologia->nombre
}}"@if(!$loop->last),@endif

    @endforeach
],
@elseif($key === 13)"Testing": [
    @foreach($grupo as $tecnologia)
    "{{ $tecnologia->nombre }}"@if(!$loop->last),@endif
    
    @endforeach
    ],
@elseif($key === 14)"Despliegue": [
    @foreach($grupo as $tecnologia)
    "{{ $tecnologia->nombre }}"@if(!$loop->last),@endif
    
    @endforeach
    ],
@elseif($key === 21)"Front-End": [
    @foreach($grupo as $tecnologia)
    "{{ $tecnologia->nombre }}"@if(!$loop->last),@endif
    
    @endforeach
    ],
@elseif($key === 22)"Back-End": [
    @foreach($grupo as $tecnologia)
    "{{ $tecnologia->nombre }}"@if(!$loop->last),@endif
    
    @endforeach
    ],
@elseif($key === 23)"Base de Datos": [
    @foreach($grupo as $tecnologia)
    "{{ $tecnologia->nombre }}"@if(!$loop->last),@endif
    
    @endforeach
    ],
@elseif($key === 24)"APIs": [
    @foreach($grupo as $tecnologia)
    "{{ $tecnologia->nombre }}"@if(!$loop->last),@endif
    
    @endforeach
        ]
    @endif
@endforeach}
</pre>
                </div>
            </section>
            <!-- DERECHA: CERTIFICACIONES ? -->
            <section class="profile__certifications">
                <h3>Certificaciones</h3>
            </section>
        </aside>
    </div>

 
</x-layouts.app>