function getHomePath() {
    const absolutePath = window.location.pathname;
    const parts = absolutePath.split('/');

    // to be reviewed!!! it search among the URL the string 'dev'
    const index = parts.indexOf('dev');
    console.log(parts);
}

document.addEventListener('DOMContentLoaded', function () {
    getHomePath();
})