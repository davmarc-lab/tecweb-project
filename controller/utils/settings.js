// add event listener settings button
$('document').ready(function () {
    const dropdowns = document.querySelectorAll('.dropdown-toggle');
    dropdowns.forEach(elem => {
        elem.addEventListener('click', function () {
            this.parentElement.classList.toggle('click');
        });
    });

    const settings = document.querySelector('.dropdown');
    settings.addEventListener('click', function () {
        this.classList.toggle('click');
    })
});