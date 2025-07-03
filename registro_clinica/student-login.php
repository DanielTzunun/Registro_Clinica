<?php
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "registro_estudiantil";

    $conn = new mysqli($host, $user, $password, $db);
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $carnet = $conn->real_escape_string($_POST['carnet']);
    $email = $conn->real_escape_string($_POST['email']);

    $sql = "SELECT * FROM estudiantes WHERE carnet = '$carnet' AND email = '$email' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $_SESSION['carnet'] = $carnet;
        header("Location: student-dashboard.php");
        exit;
    } else {
        $error = "Carnet o correo electrónico incorrecto.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inicio de Sesión Estudiante</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            font-size: 16px;
            margin-bottom: 15px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus, input[type="email"]:focus {
            outline: none;
            border-color: #667eea;
        }
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }
        button:hover {
            transform: translateY(-2px);
        }
        .error {
            color: #e74c3c;
            margin-bottom: 15px;
        }
        .message {
            color: #27ae60;
            margin-bottom: 15px;
        }
        .register-link {
            display: block;
            margin-top: 15px;
            color: #667eea;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
        }
        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Inicio de Sesión</h2>

        <?php
        if (isset($_GET['registered']) && $_GET['registered'] == 1) {
            echo "<div class='message'>Registro exitoso, ahora puedes iniciar sesión.</div>";
        }
        if ($error != "") {
            echo "<div class='error'>$error</div>";
        }
        ?>

        <form method="POST" action="">
            <input type="text" name="carnet" placeholder="Número de Carnet" required value="<?php echo isset($_POST['carnet']) ? htmlspecialchars($_POST['carnet']) : ''; ?>">
            <input type="email" name="email" placeholder="Correo Institucional" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            <button type="submit">Ingresar</button>
        </form>

        <a href="student-register.php" class="register-link">¿No tienes cuenta? Regístrate aquí</a>
    </div>
</body>
</html>
