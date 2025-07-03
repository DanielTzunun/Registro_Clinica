<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeId = $_POST['employeeId'] ?? '';
    $email = $_POST['email'] ?? '';

    if ($employeeId && $email) {
        $_SESSION['employeeId'] = $employeeId;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = 'admin';
        header('Location: admin-dashboard.php');
        exit;
    } else {
        $error = "Complete los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Personal</title>
</head>
<body>
    <h1>Login Personal</h1>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="employeeId" placeholder="ID Empleado" required><br>
        <input type="email" name="email" placeholder="Correo" required><br>
        <button type="submit">Acceder</button>
    </form>
    <a href="index.php">Soy Estudiante</a>
</body>
</html>
