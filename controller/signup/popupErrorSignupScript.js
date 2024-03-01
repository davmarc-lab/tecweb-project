$('document').ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const errorParam = urlParams.get('error');
    if (errorParam === '1') {
        Swal.fire({
            icon: 'error',
            title: 'Passwords do not match, please try again',
            text: '',
        });
    }
    if (errorParam === '2') {
        Swal.fire({
            icon: 'error',
            title: 'Password can\'t be empty',
            text: '',
        });
    }
    if (errorParam === '3') {
        Swal.fire({
            icon: 'error',
            title: 'Username can only contain letters, numers and underscore',
            text: '',
        });
    }
    if (errorParam === '4') {
        Swal.fire({
            icon: 'error',
            title: 'This username already exists',
            text: '',
        });
    }
    if (errorParam === '5') {
        Swal.fire({
            icon: 'error',
            title: 'This email already exists',
            text: '',
        });
    }
});