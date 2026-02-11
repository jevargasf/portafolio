// A. INICIALIZAR EDITOR
tinymce.init({
    selector: '#editor_contenido',
    height: 600,
    menubar: false,
    plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
    toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image code',
    content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; font-size: 16px }'
});

// B. GENERADOR AUTOMÁTICO DE SLUG
const tituloInput = document.getElementById('titulo');
const slugInput = document.getElementById('slug');

tituloInput.addEventListener('keyup', function() {
    let text = tituloInput.value;
    let slug = text.toLowerCase()
        .replace(/ /g, '-')
        .replace(/[^\w-]+/g, '');
    slugInput.value = slug;
});

// C. PREVIEW DE IMAGEN PORTADA
const imgInput = document.getElementById('imagen_portada');
const previewContainer = document.getElementById('preview-container');
const previewImg = document.getElementById('preview-img');

imgInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewContainer.classList.remove('d-none');
            document.querySelector('.image-upload-wrapper').classList.add('d-none');
        }
        reader.readAsDataURL(file);
    }
});

window.resetImage = function() {
    imgInput.value = "";
    previewContainer.classList.add('d-none');
    document.querySelector('.image-upload-wrapper').classList.remove('d-none');
}