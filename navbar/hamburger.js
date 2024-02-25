window.onload = function () {
    const hamb = document.querySelector('.hamburger');
    const nav = document.querySelector('.mobile-nav');

    hamb.addEventListener('click', function () {
        nav.classList.toggle('is-active');
    });
}