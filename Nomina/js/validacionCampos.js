function validarNumeroEntero(idInput) {
    const input = document.getElementById(idInput);
    const valor = input.value;
    const esNumeroEntero = /^\d+$/.test(valor);

    const mensajeErrorId = "mensajeError_" + idInput.split("_")[1];
    const mensajeError = document.getElementById(mensajeErrorId);

    if (!esNumeroEntero) {
        mensajeError.innerText = "Por favor, introduce solo números enteros.";
        mensajeError.style =' red'
        input.value = valor.slice(0, -1); 
        mensajeError.style.color = "red";
    } else {
        mensajeError.innerText = "";
    }
}

// Validación personalizada de Bootstrap
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Seleccionar todos los formularios que queremos aplicar estilos de validación
        var forms = document.getElementsByClassName('needs-validation');
        // Iterar sobre ellos y prevenir el envío
        Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();


