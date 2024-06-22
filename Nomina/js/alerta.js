document.addEventListener("DOMContentLoaded", function() {
  const miBoton = document.getElementById("registrar");

  miBoton.addEventListener("click", function(event) {
      
      
      Swal.fire({
          title: '¡Excelente!',
          text: 'Se agregó el usuario',
          icon: 'success',
          confirmButtonText: 'Ok',
      });
  });
});

  