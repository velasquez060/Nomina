function toggleMenu() {
    const menuLateral = document.querySelector('.menu-lateral');

    menuLateral.style.left = (menuLateral.style.left === '0px') ? '-250px' : '0px';
}

        function validarFormulario() {
            var campos = ['nombre', 'apellido', 'cedula', 'fechaNacimiento', 'celular', 'direccion', 'correo', 'estadoCivil', 'fechaIngreso', 'contactoEmergencia', 'numeroContactoEmergencia'];
            var errores = [];

            for (var i = 0; i < campos.length; i++) {
                var campo = document.getElementById(campos[i]);
                if (campo.value.trim() === "") {
                    campo.classList.add('error');
                    campo.focus();
                    mostrarMensajeError("El campo " + campos[i] + " no puede estar vacío.");
                    return false;
                } else {
                    campo.classList.remove('error');
                }
            }

            // Validar correo electrónico
            var email = document.getElementById('correo').value.trim();
            if (email !== "" && !/^\S+@\S+\.\S+$/.test(email)) {
                document.getElementById('correo').classList.add('error');
                document.getElementById('correo').focus();
                mostrarMensajeError("El correo electrónico no es válido.");
                return false;
            }

            return true;
        }

        function mostrarMensajeError(mensaje) {
            var alerta = document.getElementById('alerta');
            alerta.textContent = mensaje;
        }
    
