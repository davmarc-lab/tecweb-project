document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const errorParam = urlParams.get('error');

    if (errorParam === '1') {
        Swal.fire({
            icon: 'error',
            title: 'Credenziali non valide',
            text: 'Riprova o registrati.',
        });
    }
});