<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio - Sistema de Registro Estudiantil</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
            color: #333;
        }
        h1 {
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 30px;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.3s, transform 0.2s;
        }
        .btn:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sistema de Registro Estudiantil</h1>
        <p>Bienvenido. Selecciona tu tipo de acceso:</p>

        <a href="student-login.php" class="btn">Ingreso Estudiante</a>
        <a href="admin-login.php" class="btn">Ingreso Administrador</a>
    </div>
</body>
</html>
