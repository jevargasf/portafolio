const nav = document.getElementById('nav');
const btnToggler = document.getElementById('btnToggler');

btnToggler.addEventListener('click', (e) => {
    nav.classList.toggle('nav__collapse--open');

});