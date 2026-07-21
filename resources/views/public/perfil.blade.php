<x-layouts.app :perfil=$perfil>
    <x-nav.back/>

    <div class="profile">
        <main class="profile__main">
            <section class="profile__about">
                <h2>Perfil Profesional</h2>
                <p>{{ $perfil->biografia }}</p>
            </section>

            <section class="profile__trajectory">
                <h2>Trayectoria Profesional</h2>
                <div class="trajectory-container">
                    @foreach($timeline as $hito)
                    @if($hito['es_hito'] === true)
                    <div class="trajectory__milestone">
                        <span class="milestone__title">
                            {{ $hito['titulo'] }}
                        </span>
                        <span class="milestone__description">
                            {{ $hito['fecha'] ? $hito['fecha']->format('m/Y') : '' }} - {{ $hito['fecha_fin'] ? $hito['fecha_fin']->format('m/Y') : 'Actualidad' }} - {{ $hito['subtitulo'] }}
                        </span>
                    </div>
                    @else
                    <div class="trajectory__milestone--cert">
                        <span class="milestone__title--cert">
                            {{ $hito['titulo'] }}
                        </span>
                        <span class="milestone__description--cert">
                            {{ $hito['fecha'] ? $hito['fecha']->format('m/Y') : '' }} - {{ $hito['fecha_fin'] ? $hito['fecha_fin']->format('m/Y') : 'Actualidad' }} - {{ $hito['subtitulo'] }}
                        </span>
                    </div>
                    @endif
                    @if(!$loop->last)
                    <div class="trajectory__line"></div>
                    @endif
                    @endforeach
                </div>
            </section>
        </main>

        <aside class="profile__aside">
            <section class="profile__technologies">
                <h3>Tecnologías, Herramientas y Habilidades</h3>
                <div class="profile__json-technologies">
<pre>
<span class="json-global">{</span>    
@foreach($tecnologiasAgrupadas as $key => $grupo)
  @if($key === 21)
"Frontend"<span class="json-punctuation">:</span><span class="json-nested-1"> [</span> 
        @foreach($grupo as $tecnologia)<span class="json-string">"{{ $tecnologia->nombre
}}"</span>@if(!$loop->last)<span class="json-punctuation">,</span>@endif

        @endforeach<span class="json-nested-1">]</span><span class="json-punctuation">,</span>
@elseif($key === 22)"Backend"<span class="json-punctuation">:</span><span class="json-nested-1"> [</span>
    @foreach($grupo as $tecnologia)
    <span class="json-string">"{{ $tecnologia->nombre
}}"</span>@if(!$loop->last)<span class="json-punctuation">,</span>@endif

    @endforeach
<span class="json-nested-1">]</span><span class="json-punctuation">,</span>
@elseif($key === 23)"Bases_de_datos"<span class="json-punctuation">:</span><span class="json-nested-1"> [</span>
    @foreach($grupo as $tecnologia)
    <span class="json-string">"{{ $tecnologia->nombre }}"</span>@if(!$loop->last)<span class="json-punctuation">,</span>@endif
    
    @endforeach
    <span class="json-nested-1">]</span><span class="json-punctuation">,</span>
@elseif($key === 14)"Infraestructura_OS"<span class="json-punctuation">:</span><span class="json-nested-1"> [</span>
    @foreach($grupo as $tecnologia)
    <span class="json-string">"{{ $tecnologia->nombre }}"</span>@if(!$loop->last)<span class="json-punctuation">,</span>@endif
    
    @endforeach
    <span class="json-nested-1">]</span><span class="json-punctuation">,</span>
@elseif($key === 31)"Seguridad_web"<span class="json-punctuation">:</span><span class="json-nested-1"> [</span>
    @foreach($grupo as $tecnologia)
    <span class="json-string">"{{ $tecnologia->nombre }}"</span>@if(!$loop->last)<span class="json-punctuation">,</span>@endif
    
    @endforeach
    <span class="json-nested-1">]</span><span class="json-punctuation">,</span>
@elseif($key === 22)"Back-End"<span class="json-punctuation">:</span><span class="json-nested-1"> [</span>
    @foreach($grupo as $tecnologia)
    <span class="json-string">"{{ $tecnologia->nombre }}"</span>@if(!$loop->last)<span class="json-punctuation">,</span>@endif
    
    @endforeach
    <span class="json-nested-1">]</span><span class="json-punctuation">,</span>
@elseif($key === 41)"IA_Datos"<span class="json-punctuation">:</span><span class="json-nested-1"> [</span>
    @foreach($grupo as $tecnologia)
    <span class="json-string">"{{ $tecnologia->nombre }}"</span>@if(!$loop->last)<span class="json-punctuation">,</span>@endif
    
    @endforeach
    <span class="json-nested-1">]
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