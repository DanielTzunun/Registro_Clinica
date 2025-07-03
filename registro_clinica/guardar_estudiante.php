<?php
session_start();

if (!isset($_SESSION['carnet'])) {
    header("Location: student-login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "registro_clinica";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibir y limpiar datos del formulario
$carnet = $_SESSION['carnet'];
$firstName = trim($_POST['firstName'] ?? '');
$lastName = trim($_POST['lastName'] ?? '');
$birthDate = $_POST['birthDate'] ?? '';
$gender = $_POST['gender'] ?? '';
$phone = trim($_POST['phone'] ?? '');
$emergencyContact = trim($_POST['emergencyContact'] ?? '');
$address = trim($_POST['address'] ?? '');
$bloodType = $_POST['bloodType'] ?? '';
$weight = trim($_POST['weight'] ?? '');
$height = trim($_POST['height'] ?? '');
$insurance = trim($_POST['insurance'] ?? '');
$allergies = trim($_POST['allergies'] ?? '');
$medications = trim($_POST['medications'] ?? '');
$medicalHistory = trim($_POST['medicalHistory'] ?? '');

// Validar campos obligatorios (puedes ampliar las validaciones si quieres)
if (empty($firstName) || empty($lastName) || empty($birthDate) || empty($gender) || empty($phone) || empty($emergencyContact) || empty($address) || empty($bloodType) || empty($weight) || empty($height)) {
    die("Por favor complete todos los campos obligatorios.");
}

// Preparar sentencia para actualizar
$stmt = $conn->prepare("UPDATE estudiantes SET firstName=?, lastName=?, birthDate=?, gender=?, phone=?, emergencyContact=?, address=?, bloodType=?, weight=?, height=?, insurance=?, allergies=?, medications=?, medicalHistory=? WHERE carnet=?");
$stmt->bind_param(
    "sssssssssssssss",
    $firstName,
    $lastName,
    $birthDate,
    $gender,
    $phone,
    $emergencyContact,
    $address,
    $bloodType,
    $weight,
    $height,
    $insurance,
    $allergies,
    $medications,
    $medicalHistory,
    $carnet
);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    // Redirigir al dashboard o a donde quieras
    header("Location: student-dashboard.php?update=success");
    exit();
} else {
    $error = $stmt->error;
    $stmt->close();
    $conn->close();
    die("Error al guardar los datos: " . $error);
}
