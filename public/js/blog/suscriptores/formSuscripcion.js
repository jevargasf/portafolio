document.addEventListener('DOMContentLoaded', () => {
    const formSuscripcion = document.getElementById('formSuscripcion');

    if (!formSuscripcion) return;

    formSuscripcion.addEventListener('submit', function(event) {
        event.preventDefault();

        const btnSubmit = document.getElementById('btnSubmit');
        const btnText = document.getElementById('btnText');
        const btnSpinner = document.getElementById('btnSpinner');
        const alertContainer = document.getElementById('alert-container');
        const inputCorreo = document.getElementById('correo');
        const errorCorreo = document.getElementById('correo-error');

        inputCorreo.classList.remove('is-invalid');
        alertContainer.innerHTML = '';
        btnSubmit.disabled = true;
        btnText.classList.add('d-none');
        btnSpinner.classList.remove('d-none');

        const formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(async response => {
            const data = await response.json().catch(() => null);
            return { status: response.status, body: data };
        })
        .then(res => {
            if (res.status === 200 || res.status === 201) {
                // Éxito
                alertContainer.innerHTML = `<div class="alert alert-success border-0 small">${res.body.message}</div>`;
                this.reset();
            } else if (res.status === 422 && res.body.errors) {
                // Fallo de validación del framework
                inputCorreo.classList.add('is-invalid');
                errorCorreo.innerText = res.body.errors.correo[0];
            } else {
                // Excepciones no controladas
                alertContainer.innerHTML = `<div class="alert alert-danger border-0 small">Excepción en el servidor (Código: ${res.status}).</div>`;
            }
        })
        .catch(error => {
            // Fallo en la capa de transporte
            alertContainer.innerHTML = `<div class="alert alert-dark border-0 small">Fallo de resolución de red. Compruebe la conectividad.</div>`;
        })
        .finally(() => {
            // Restauración de estado interactivo
            btnSubmit.disabled = false;
            btnText.classList.remove('d-none');
            btnSpinner.classList.add('d-none');
        });
    });
});