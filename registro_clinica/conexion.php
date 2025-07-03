<?php
$host = "localhost";
$user = "root";
$password = "";  // Cambia si tienes contraseña en XAMPP
$db = "registro_clinica";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
