document.addEventListener("DOMContentLoaded", function() {
  let togglePasswordIcons = document.querySelectorAll('.toggle-password');
  let passwordFields = document.querySelectorAll('.password-field');

  togglePasswordIcons.forEach((icon, index) => {
      icon.addEventListener('click', function() {
          if (passwordFields[index].type === 'password') {
              passwordFields[index].type = 'text';
              icon.innerHTML = '<i class="bi bi-eye-slash"></i>';
          } else {
              passwordFields[index].type = 'password';
              icon.innerHTML = '<i class="bi bi-eye"></i>';
          }
      });
  });
});
