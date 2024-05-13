function validarNumeroEntero(idInput) {
    const input = document.getElementById(idInput);
    const valor = input.value;
    const esNumeroEntero = /^\d+$/.test(valor);

    const mensajeErrorId = "mensajeError_" + idInput.split("_")[1];
    const mensajeError = document.getElementById(mensajeErrorId);

    if (!esNumeroEntero) {
        mensajeError.innerText = "Por favor, introduce solo números enteros.";
        input.value = valor.slice(0, -1); 
    } else {
        mensajeError.innerText = "";
    }
}


