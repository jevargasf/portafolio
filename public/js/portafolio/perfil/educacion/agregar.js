/**
 * Script de Control: Agregar Título
 * Logic: First Principles (Data Binding & DOM Manipulation)
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // ==========================================
    // 1. VARIABLES DEL DOM
    // ==========================================
    const regionSelect  = document.getElementById('region_select');
    const comunaSelect  = document.getElementById('comuna_id');
    const checkActual   = document.getElementById('es_trabajo_actual');
    const fechaFinInput = document.getElementById('fecha_fin');

    // Validación de seguridad: Si no existen los elementos, detenemos el script
    if (!regionSelect || !comunaSelect) return;

    // ==========================================
    // 2. LÓGICA DE REGIONES Y COMUNAS (Cascading Select)
    // ==========================================
    regionSelect.addEventListener('change', function() {
        // Obtenemos el ID seleccionado (convertido a entero para comparar)
        const regionId = parseInt(this.value);

        // BUSCAMOS EN LA DATA GLOBAL (window.regiones)
        // Esto es mucho más rápido que leer el DOM
        const regionData = window.regiones.find(r => r.id === regionId);

        // Resetear select de comunas
        comunaSelect.innerHTML = '<option value="" selected disabled>[ SELECCIONAR_COMUNA ]</option>';
        
        if (regionData && regionData.comunas.length > 0) {
            // Habilitar
            comunaSelect.removeAttribute('disabled');
            comunaSelect.classList.remove('bg-light');

            // Poblar (Rendering)
            regionData.comunas.forEach(comuna => {
                const option = document.createElement('option');
                option.value = comuna.id;
                option.textContent = comuna.nombre;
                comunaSelect.appendChild(option);
            });

            // Efecto visual "System Flash"
            comunaSelect.style.borderColor = 'var(--primary)';
            setTimeout(() => comunaSelect.style.borderColor = '', 300);
        } else {
            // Si no hay comunas o error
            comunaSelect.setAttribute('disabled', 'disabled');
        }
    });

    // ==========================================
    // 3. LÓGICA DE FECHAS (UX Toggle)
    // ==========================================
    // if (checkActual && fechaFinInput) {
        
    //     const toggleFechaFin = () => {
    //         if (checkActual.checked) {
    //             // Estado: Trabajo Actual
    //             fechaFinInput.value = ''; // Limpiar dato
    //             fechaFinInput.setAttribute('disabled', 'disabled');
    //             fechaFinInput.classList.add('bg-light'); // Visualmente deshabilitado
    //             fechaFinInput.style.cursor = 'not-allowed';
    //         } else {
    //             // Estado: Trabajo Pasado
    //             fechaFinInput.removeAttribute('disabled');
    //             fechaFinInput.classList.remove('bg-light');
    //             fechaFinInput.style.cursor = 'text';
    //         }
    //     };

    //     // Ejecutar al inicio (por si Laravel devolvió old() inputs tras un error)
    //     toggleFechaFin();

    //     // Ejecutar al cambiar el checkbox
    //     checkActual.addEventListener('change', toggleFechaFin);
    // }
});