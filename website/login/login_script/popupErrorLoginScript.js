document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const errorParam = urlParams.get('error');

    if (errorParam === '1') {
        Swal.fire({
            icon: 'error',
            title: 'Invalid username, please try again',
            text: '',
        });
    }

    if (errorParam === '2') {
        Swal.fire({
            icon: 'error',
            title: 'Password and username don\'t match, please try again',
            text: '',
        });
    }
});