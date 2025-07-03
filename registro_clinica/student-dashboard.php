<?php
session_start();

if (!isset($_SESSION['carnet'])) {
    header("Location: student-login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "registro_estudiantil";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$carnet = $conn->real_escape_string($_SESSION['carnet']);

$sql = "SELECT firstName FROM estudiantes WHERE carnet = '$carnet' LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if (empty($row['firstName'])) {
        // Si no hay nombre, redirige a formulario para completar datos
        header("Location: student-form.php");
        exit();
    }
} else {
    echo "Estudiante no encontrado.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Panel Estudiante</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .dashboard {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 10px;
        }
        p {
            margin-bottom: 30px;
        }
        a {
            display: inline-block;
            padding: 12px 20px;
            background: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }
        a:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h2>Bienvenido, estudiante</h2>
        <p>Tu número de carnet es: <strong><?php echo htmlspecialchars($carnet); ?></strong></p>
        <a href="logout.php">Cerrar sesión</a>
    </div>
</body>
</html>
