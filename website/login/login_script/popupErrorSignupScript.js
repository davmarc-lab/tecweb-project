document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const errorParam = urlParams.get('error');

    if (errorParam === '1') {
        Swal.fire({
            icon: 'error',
            title: 'Le 2 password non corrisponodono',
            text: '',
        });
    }
});