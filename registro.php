<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexion
if ($conn->connect_error) {
    die("Falló la conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$contraseña = $_POST['contraseña'];

// Verificar si el correo electronico ya esta registrado
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "El correo electronico ya esta registrado. Por favor, utiliza otro correo.";
} else {
    // Insertar nuevo usuario en la base de datos
    $sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $email, $contraseña);
    $stmt->execute();
    header("Location: index.html");

}

$conn->close();
?>
