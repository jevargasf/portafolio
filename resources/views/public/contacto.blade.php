<x-layouts.app :perfil=$perfil >
    <x-nav.back/>
    <main class="contact"> 
        <h2>Contacto</h2> 
        <p>Realizo servicios de asesoría en temas de desarrollo de herramientas web para la gestión organizacional, análisis de datos para investigación. Siempre estoy abierto a participar en nuevos proyectos. Si crees que puedo ayudarte, no dudes en contactarme.</p>

        <p>Pronto implementaré un formulario de contacto funcional. Sin embargo, de momento puedes escribirme por los siguientes canales:</p>
        <!-- COLUMNA 2: METADATA (FICHA TÉCNICA) -->
        <div class="contact-card">
            <a class="btn__brand--outline contact-channel" href="mailto:jevargasf@gmail.com">
                <x-icons.mail class="nav__icon" />
                Envíame un correo
            </a>
            <a class="btn__brand--outline contact-channel" target="_blank" href="https://www.github.com/jevargasf">
                <x-icons.github class="nav__icon" />
                Contáctame por GitHub
            </a>
        </div>
    
    </main>
</x-layouts.app>