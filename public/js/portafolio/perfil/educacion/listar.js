
$(document).ready(function() {
    $('#tablaTitulos').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            search: "", 
            searchPlaceholder: "Buscar título académico por nombre, institución o fecha..."
        },
        data: window.titulos,
        responsive: true,
        paging: true,
        lengthChange: false,
        searching: true,
        ordering: true,
        info: false,
        autoWidth: false,
        dom: '<"mb-2"f><"table-responsive"t><"mt-1"p>',
        columns: [
            { data: 'id', title: '#', width: '5%' },
            { data: 'nombre_titulo', title: 'Nombre Título', width: '20%' },
            { data: 'institucion', title: 'Institución', width: '25%' },
            { 
                data: 'fecha_inicio', 
                title: 'Fecha inicio', 
                width: '20%' ,
                render: function(data, type, row){
                    if (!data) return '';
                    if (type === 'display' || type === 'filter') {
                        var date = new Date(data);
                        return date.toLocaleDateString('es-CL', {
                            day: '2-digit', 
                            month: '2-digit', 
                            year: 'numeric'
                        });
                    }
                    return data;
                }
            
            },
            { 
                data: 'fecha_obtencion', 
                title: 'Fecha Obtención', 
                width: '20%' ,
                render: function(data, type, row){
                    if (!data) return '';
                    if (type === 'display' || type === 'filter') {
                        var date = new Date(data);
                        return date.toLocaleDateString('es-CL', {
                            day: '2-digit', 
                            month: '2-digit', 
                            year: 'numeric'
                        });
                    }
                    return data;
                }
            
            },
            { 
                data: null, 
                title: 'Acciones',
                orderable: false,
                width: '10%',
                render: function(data, type, row) {
                    let urlEditar = `${rutaEditarBase}?id=${row.id}`;
                    return `
                        <div class="text-center">
                            <a href="${urlEditar}" class="btn btn-sm btn-primary-custom" title="Editar">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px;">
                                    <path d="M15.7279 9.57627L14.3137 8.16206L5 17.4758V18.89H6.41421L15.7279 9.57627ZM17.1421 8.16206L18.5563 6.74785L17.1421 5.33363L15.7279 6.74785L17.1421 8.16206ZM7.24264 20.89H3V16.6473L16.435 3.21231C16.8256 2.82179 17.4587 2.82179 17.8492 3.21231L20.6777 6.04074C21.0682 6.43126 21.0682 7.06443 20.6777 7.45495L7.24264 20.89Z"></path>
                                </svg>
                            </a>
                            <button class="btn btn-sm btn-danger-custom" onclick="eliminarTitulo(${row.id})" title="Eliminar">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 16px; height: 16px;">
                                    <path d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 11H11V17H9V11ZM13 11H15V17H13V11ZM9 4V6H15V4H9Z"></path>
                                </svg>
                            </button>
                        </div>
                    `;
                }
            }
        ],
    });

});

function eliminarTitulo(id) {
    if(!confirm('¿Estás seguro de eliminar este título académico?')) return;

    let form = document.createElement('form');
    form.method = 'POST';
    form.action = rutaEliminarBase; // Usamos la variable que definimos arriba

    let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    let inputCsrf = document.createElement('input');
    inputCsrf.type = 'hidden';
    inputCsrf.name = '_token';
    inputCsrf.value = csrfToken;
    form.appendChild(inputCsrf);

    let inputId = document.createElement('input');
    inputId.type = 'hidden';
    inputId.name = 'id';
    inputId.value = id;
    form.appendChild(inputId);

    document.body.appendChild(form);
    form.submit();
}