// add event listener settings button
$('document').ready(function () {
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(elem => {
        elem.addEventListener('click', function () {
            this.classList.toggle('click');
        });
    });
});