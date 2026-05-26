const wrapper = document.querySelector('.projects__wrapper');
const proximamenteAlert = document.getElementById('proximamenteAlert');

wrapper.addEventListener('click', (e) => {
    const card = e.target.closest('.card');
    if (card) {
        proximamenteAlert.showModal();
    }
});
