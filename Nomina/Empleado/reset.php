<?php
require '../vendor/autoload.php';
include "../Conexion/cone.php";

if (!isset($_GET['token'])) {
    die('No se proporcionó un token de restablecimiento.');
}

$token = $_GET['token'];

// Verificar si el token es válido y no ha expirado
$query = "SELECT * FROM registrar WHERE reset_token = ? AND reset_expiry > NOW()";
$stmt = $conexion->prepare($query);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('El token no es válido o ha expirado.');
}

// Si se envió el formulario con la nueva contraseña
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Actualizar la contraseña y limpiar el token
    $updateQuery = "UPDATE registrar SET password = ?, reset_token = NULL, reset_expiry = NULL WHERE reset_token = ?";
    $stmt = $conexion->prepare($updateQuery);
    $stmt->bind_param("ss", $password, $token);
    
    if ($stmt->execute()) {
        echo "Tu contraseña ha sido actualizada correctamente. <a href='login.php'>Iniciar sesión</a>";
        exit;
    } else {
        echo "Error al actualizar la contraseña.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Restablecer Contraseña</h2>
    <form method="POST" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="password">Nueva Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirmar Contraseña:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <div id="error" class="error"></div>
        <button type="submit">Cambiar Contraseña</button>
    </form>

    <script>
    function validateForm() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const errorDiv = document.getElementById('error');
        
        if (password !== confirmPassword) {
            errorDiv.textContent = 'Las contraseñas no coinciden';
            return false;
        }
        
        if (password.length < 8) {
            errorDiv.textContent = 'La contraseña debe tener al menos 8 caracteres';
            return false;
        }
        
        return true;
    }
    </script>
</body>
</html>