<?php
session_start();

// Verificar si el estudiante está logueado
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

$carnet = $_SESSION['carnet'];

// Consultar datos previos para precargar el formulario (si existen)
$sql = "SELECT * FROM estudiantes WHERE carnet = '$carnet'";
$result = $conn->query($sql);
$data = $result->fetch_assoc() ?? [];

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Formulario de Registro - Estudiante</title>
<style>
    /* Aquí puedes incluir tu CSS que ya tienes */
    /* Ejemplo básico para que se vea bien */
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 20px;
        min-height: 100vh;
    }
    .container {
        background: white;
        max-width: 800px;
        margin: 0 auto;
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    h1 {
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }
    label {
        display: block;
        margin-top: 15px;
        font-weight: 600;
        color: #555;
    }
    input, select, textarea {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border-radius: 8px;
        border: 2px solid #e1e1e1;
        font-size: 16px;
        transition: border-color 0.3s;
    }
    input:focus, select:focus, textarea:focus {
        outline: none;
        border-color: #667eea;
    }
    button {
        margin-top: 30px;
        padding: 15px;
        width: 100%;
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        font-size: 18px;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: transform 0.2s;
    }
    button:hover {
        transform: translateY(-2px);
    }
</style>
</head>
<body>

<div class="container">
    <h1>Formulario de Registro Clínico</h1>
    <p><strong>Carnet: <?php echo htmlspecialchars($carnet); ?></strong></p>

    <form action="guardar_estudiante.php" method="POST">
        <label for="firstName">Nombres:</label>
        <input type="text" id="firstName" name="firstName" required value="<?php echo htmlspecialchars($data['firstName'] ?? ''); ?>">

        <label for="lastName">Apellidos:</label>
        <input type="text" id="lastName" name="lastName" required value="<?php echo htmlspecialchars($data['lastName'] ?? ''); ?>">

        <label for="birthDate">Fecha de Nacimiento:</label>
        <input type="date" id="birthDate" name="birthDate" required value="<?php echo htmlspecialchars($data['birthDate'] ?? ''); ?>">

        <label for="gender">Género:</label>
        <select id="gender" name="gender" required>
            <option value="">Seleccione...</option>
            <option value="masculino" <?php if (($data['gender'] ?? '') === 'masculino') echo 'selected'; ?>>Masculino</option>
            <option value="femenino" <?php if (($data['gender'] ?? '') === 'femenino') echo 'selected'; ?>>Femenino</option>
            <option value="otro" <?php if (($data['gender'] ?? '') === 'otro') echo 'selected'; ?>>Otro</option>
        </select>

        <label for="phone">Teléfono:</label>
        <input type="tel" id="phone" name="phone" required value="<?php echo htmlspecialchars($data['phone'] ?? ''); ?>">

        <label for="emergencyContact">Contacto de Emergencia:</label>
        <input type="tel" id="emergencyContact" name="emergencyContact" required value="<?php echo htmlspecialchars($data['emergencyContact'] ?? ''); ?>">

        <label for="address">Dirección Completa:</label>
        <textarea id="address" name="address" required><?php echo htmlspecialchars($data['address'] ?? ''); ?></textarea>

        <label for="bloodType">Tipo de Sangre:</label>
        <select id="bloodType" name="bloodType" required>
            <option value="">Seleccione...</option>
            <?php
            $bloodTypes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
            foreach ($bloodTypes as $type) {
                $selected = (($data['bloodType'] ?? '') === $type) ? 'selected' : '';
                echo "<option value=\"$type\" $selected>$type</option>";
            }
            ?>
        </select>

        <label for="weight">Peso (kg):</label>
        <input type="text" id="weight" name="weight" required value="<?php echo htmlspecialchars($data['weight'] ?? ''); ?>" placeholder="Ej: 70">

        <label for="height">Altura (cm):</label>
        <input type="text" id="height" name="height" required value="<?php echo htmlspecialchars($data['height'] ?? ''); ?>" placeholder="Ej: 175">

        <label for="insurance">Seguro Médico:</label>
        <input type="text" id="insurance" name="insurance" value="<?php echo htmlspecialchars($data['insurance'] ?? ''); ?>" placeholder="Nombre del seguro (opcional)">

        <label for="allergies">Alergias:</label>
        <textarea id="allergies" name="allergies" placeholder="Liste sus alergias conocidas (medicamentos, alimentos, etc.)"><?php echo htmlspecialchars($data['allergies'] ?? ''); ?></textarea>

        <label for="medications">Medicamentos Actuales:</label>
        <textarea id="medications" name="medications" placeholder="Liste los medicamentos que toma actualmente"><?php echo htmlspecialchars($data['medications'] ?? ''); ?></textarea>

        <label for="medicalHistory">Historial Médico:</label>
        <textarea id="medicalHistory" name="medicalHistory" placeholder="Enfermedades previas, cirugías, condiciones crónicas, etc."><?php echo htmlspecialchars($data['medicalHistory'] ?? ''); ?></textarea>

        <button type="submit">Guardar Información</button>
    </form>
</div>

</body>
</html>
