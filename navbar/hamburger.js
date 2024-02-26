window.onload = function () {
    const hamb = document.querySelector('.toggle-button');
    const nav = document.querySelector('.navbar');

    hamb.addEventListener('click', function () {
        nav.classList.toggle('is-active');
    });
}