const btn_hamb = document.querySelector('.hamburger');
const nav = document.querySelector('.navbar-body');

btn_hamb.addEventListener('click', function () {
    nav.classList.toggle('is-active');
});