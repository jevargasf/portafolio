const wrapper = document.querySelector('.projects__wrapper');
const proximamenteAlert = document.getElementById('proximamenteAlert');

wrapper.addEventListener('click', (e) => {
    const card = e.target.closest('.card');
    if (card) {
        proximamenteAlert.showModal();
    }
});

nav.addEventListener('click', (e) => {
    const link = e.target.closest('.nav__link--disabled');
    if (link) {
        e.preventDefault();
        proximamenteAlert.showModal();
    }
});