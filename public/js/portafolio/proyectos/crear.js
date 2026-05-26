let arrayTecnologias = [];
const containerCheckboxes = document.getElementById('containerCheckboxes');
const containerChecked = document.getElementById('containerChecked');
let dragElement = null;
const formEditar = document.getElementById('formCrear');
const tecnologiasOrdenadas = document.getElementById('tecnologiasOrdenadas');

document.addEventListener('DOMContentLoaded', () => {
    if (window.oldTecnologias !== null) {
        window.oldTecnologias.forEach(tec => {
            arrayTecnologias.push({
                id: tec.id,
                nombre: tec.nombre,
                prioridad: tec.prioridad
            });
        });
    }
    renderBadges();
});

containerCheckboxes.addEventListener('click', (e) => {
    if (e.target.closest('.form__check--input')) {
        switch (e.target.checked) {
            case true:
                if (!arrayTecnologias.some(tec => Number(e.target.value) === Number(tec.id))) {
                    const idTec = Number(e.target.value);
                    const nomTec = tecnologias.find(t => t.id === idTec).nombre;
                    arrayTecnologias.push({
                        id: idTec,
                        nombre: nomTec,
                        prioridad: arrayTecnologias.length + 1
                    });
                };
                break;
            case false:
                arrayTecnologias = arrayTecnologias.filter(tec => Number(e.target.value) !== Number(tec.id));
        }
    };
    renderBadges();
});

// FUNCIÓN PARA PINTAR EL DOM SEGÚN PRIORIDAD
function renderBadges() {
    containerChecked.innerHTML = ''
    arrayTecnologias.sort((a, b) => a.prioridad - b.prioridad);
    if (arrayTecnologias.length > 0) {
        const ul = document.createElement('ul');
        ul.className = 'list__technologies';
        arrayTecnologias.forEach(tec => {
            const li = document.createElement('li');
            li.textContent = tec.nombre;
            li.dataset.id = tec.id;
            li.draggable = true;
            ul.appendChild(li);
        });
        containerChecked.appendChild(ul);
    } else {
        const span = document.createElement('span');
        span.textContent = 'No hay tecnologías seleccionadas';
        containerChecked.appendChild(span);
    }
}

// DRAG AND DROP
containerChecked.addEventListener('dragstart', (e) => {
    e.target.classList.add('dragging');
    dragElement = e.target;
});

containerChecked.addEventListener('dragover', (e) => {
    e.preventDefault();
    const ul = document.querySelector('#containerChecked ul');
    const targetLi = e.target.closest('li');
    if (targetLi && targetLi !== dragElement) {
        const elOverCenter = targetLi.offsetHeight / 2 + targetLi.getBoundingClientRect().top;
        if (e.clientY <= elOverCenter) {
            ul.insertBefore(dragElement, targetLi);
        } else {
            targetLi.after(dragElement);
        }
    }

});

containerChecked.addEventListener('dragend', (e) => {
    e.target.classList.remove('dragging');
    dragElement = null;
    actualizarArray();
});

function actualizarArray() {
    arrayTecnologias = [];
    const listEl = document.querySelectorAll('#containerChecked li');
    listEl.forEach((li, index) => {
        arrayTecnologias.push({
            id: Number(li.dataset.id),
            nombre: li.textContent,
            prioridad: index + 1
        });
    });

}

// ACTUALIZACIÓN DEL DATAFORM
formEditar.addEventListener('submit', (e) => {
    e.preventDefault();
    tecnologiasParsed = JSON.stringify(arrayTecnologias);
    tecnologiasOrdenadas.value = tecnologiasParsed;
    formEditar.submit();
});