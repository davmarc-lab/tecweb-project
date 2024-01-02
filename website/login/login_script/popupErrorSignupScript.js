document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const errorParam = urlParams.get('error');

    if (errorParam === '2') {
        console.log("Errore 2");
        Swal.fire({
            icon: 'error',
            title: 'La password non può essere vuota',
            text: '',
        });
    }
    if (errorParam === '1') {
        console.log("Errore 1");
        Swal.fire({
            icon: 'error',
            title: 'Le 2 password non corrisponodono',
            text: '',
        });
    } 
});