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
                <h3>Tecnologías, Herramientas y Habilidades</h3>
                <div class="profile__json-technologies">
<pre>
<span class="json-global">{</span>    
@foreach($tecnologiasAgrupadas as $key => $grupo)
  @if($key === 11)
"Diseño"<span class="json-punctuation">:</span><span class="json-nested-1"> [</span> 
        @foreach($grupo as $tecnologia)<span class="json-string">"{{ $tecnologia->nombre
}}"</span>@if(!$loop->last)<span class="json-punctuation">,</span>@endif

        @endforeach<span class="json-nested-1">]</span><span class="json-punctuation">,</span>
@elseif($key === 12)"Código"<span class="json-punctuation">:</span><span class="json-nested-1"> [</span>
    @foreach($grupo as $tecnologia)
    <span class="json-string">"{{ $tecnologia->nombre
}}"</span>@if(!$loop->last)<span class="json-punctuation">,</span>@endif

    @endforeach
<span class="json-nested-1">]</span><span class="json-punctuation">,</span>
@elseif($key === 13)"Testing"<span class="json-punctuation">:</span><span class="json-nested-1"> [</span>
    @foreach($grupo as $tecnologia)
    <span class="json-string">"{{ $tecnologia->nombre }}"</span>@if(!$loop->last)<span class="json-punctuation">,</span>@endif
    
    @endforeach
    <span class="json-nested-1">]</span><span class="json-punctuation">,</span>
@elseif($key === 14)"Despliegue"<span class="json-punctuation">:</span><span class="json-nested-1"> [</span>
    @foreach($grupo as $tecnologia)
    <span class="json-string">"{{ $tecnologia->nombre }}"</span>@if(!$loop->last)<span class="json-punctuation">,</span>@endif
    
    @endforeach
    <span class="json-nested-1">]</span><span class="json-punctuation">,</span>
@elseif($key === 21)"Front-End"<span class="json-punctuation">:</span><span class="json-nested-1"> [</span>
    @foreach($grupo as $tecnologia)
    <span class="json-string">"{{ $tecnologia->nombre }}"</span>@if(!$loop->last)<span class="json-punctuation">,</span>@endif
    
    @endforeach
    <span class="json-nested-1">]</span><span class="json-punctuation">,</span>
@elseif($key === 22)"Back-End"<span class="json-punctuation">:</span><span class="json-nested-1"> [</span>
    @foreach($grupo as $tecnologia)
    <span class="json-string">"{{ $tecnologia->nombre }}"</span>@if(!$loop->last)<span class="json-punctuation">,</span>@endif
    
    @endforeach
    <span class="json-nested-1">]</span><span class="json-punctuation">,</span>
@elseif($key === 23)"Base de Datos"<span class="json-punctuation">:</span><span class="json-nested-1"> [</span>
    @foreach($grupo as $tecnologia)
    <span class="json-string">"{{ $tecnologia->nombre }}"</span>@if(!$loop->last)<span class="json-punctuation">,</span>@endif
    
    @endforeach
    <span class="json-nested-1">]</span><span class="json-punctuation">,</span>
@elseif($key === 24)"APIs"<span class="json-punctuation">:</span><span class="json-nested-1"> [</span>
    @foreach($grupo as $tecnologia)
    <span class="json-string">"{{ $tecnologia->nombre }}"</span>@if(!$loop->last)<span class="json-punctuation">,</span>@endif
    
    @endforeach
        <span class="json-nested-1">]</span>
    @endif
@endforeach<span class="json-global">}</span>
</pre>
                </div>
            </section>
            <!-- DERECHA: CERTIFICACIONES ? -->
            <!-- <section class="profile__certifications">
                <h3>Certificaciones</h3>
            </section> -->
        </aside>
    </div>

 
</x-layouts.app>