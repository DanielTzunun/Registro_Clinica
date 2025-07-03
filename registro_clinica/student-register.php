<?php
session_start();
$mensaje = "";

$host = "localhost";
$user = "root";
$password = "";
$db = "registro_estudiantil";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carnet = $conn->real_escape_string($_POST['carnet']);
    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastName']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Cifrado seguro

    $sqlCheck = "SELECT * FROM estudiantes WHERE carnet='$carnet' OR email='$email'";
    $resCheck = $conn->query($sqlCheck);

    if ($resCheck->num_rows > 0) {
        $mensaje = "El carnet o correo ya están registrados.";
    } else {
        $sqlInsert = "INSERT INTO estudiantes (carnet, firstName, lastName, email, password) 
                      VALUES ('$carnet', '$firstName', '$lastName', '$email', '$password')";
        if ($conn->query($sqlInsert) === TRUE) {
            header("Location: student-login.php?registered=1");
            exit;
        } else {
            $mensaje = "Error al registrar: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registro de Estudiante</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
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
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            font-size: 16px;
            margin-bottom: 15px;
            transition: border-color 0.3s;
        }
        input:focus {
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
        .login-link {
            display: block;
            margin-top: 15px;
            color: #667eea;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
        }
        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registro de Estudiantes</h2>

        <?php if ($mensaje != "") echo "<div class='error'>$mensaje</div>"; ?>

        <form method="POST" action="">
            <input type="text" name="carnet" placeholder="Número de Carnet" required value="<?php echo isset($_POST['carnet']) ? htmlspecialchars($_POST['carnet']) : ''; ?>">
            <input type="text" name="firstName" placeholder="Nombre" required value="<?php echo isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : ''; ?>">
            <input type="text" name="lastName" placeholder="Apellido" required value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : ''; ?>">
            <input type="email" name="email" placeholder="Correo Institucional" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>

        <a href="student-login.php" class="login-link">¿Ya tienes cuenta? Inicia sesión aquí</a>
    </div>
</body>
</html>
