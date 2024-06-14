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
    } else {
        mensajeError.innerText = "";
    }
}


(function() {
    'use strict';
    window.addEventListener('load', function() {
        
        var forms = document.getElementsByClassName('needs-validation');
        
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

document.getElementById('fileInput').addEventListener('change', function(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('preview');
        output.innerHTML = '<img src="' + reader.result + '" alt="Vista previa de la imagen" style="max-width: 300px; max-height: 300px;"/>';
    };
    reader.readAsDataURL(event.target.files[0]);
});
