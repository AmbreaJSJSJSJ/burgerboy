<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Falló la conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario
$email = $_POST['email'];
$contraseña = $_POST['contraseña'];

// Consultar la base de datos para verificar las credenciales
$sql = "SELECT * FROM usuarios WHERE email = '$email' AND contraseña = '$contraseña'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    header("Location: hamburguesa.html");
    exit(); 
} else {
    // Credenciales incorrectas
    echo "Inicio de sesión fallido. Verifica tu correo electrónico y contraseña.";
}

$conn->close();
?>
