function getHomePath() {
    const absolutePath = window.location.pathname;
    const parts = absolutePath.split('/');

    // to be reviewed!!! it search among the URL the string 'dev'
    const index = parts.indexOf('dev');
    if (index !== -1) {
        return parts.slice(0, index + 1).join('/') + '/';
    } else {
        // 'website' not found in the path
        return null;
    }
}

document.addEventListener('DOMContentLoaded', function () {
    console.log(getHomePath());
})