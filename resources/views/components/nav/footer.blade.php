@props(['perfil'])
<footer class="footer">
        <div class="container">
            <ul class="footer__list">
                <li class="footer__element">
                    &copy; 2026 [ javier vargas fuentes ]
                </li>

                    
                <li class="footer__element">
                    mis redes: 
                    @if($perfil)
                        @foreach($perfil->redesSociales as $red)
                            <a href="{{ $red->url }}" target="_blank" class="footer__link">
                                {{ $red->nombre_red ?? 'Link' }}
                            </a> 
                        {{ $loop->last ? '' : ',' }}
                        @endforeach
                    @else
                        
                    @endif
                </li>
                    

                
            </ul>
        </div>
    </footer>