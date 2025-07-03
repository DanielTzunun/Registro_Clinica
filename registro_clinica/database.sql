CREATE TABLE IF NOT EXISTS estudiantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    carnet VARCHAR(50) UNIQUE,
    firstName VARCHAR(100),
    lastName VARCHAR(100),
    email VARCHAR(100) UNIQUE,           -- ✔️ Agregado para inicio de sesión
    password VARCHAR(255) NOT NULL,      -- ✔️ Contraseña cifrada
    birthDate DATE,
    gender VARCHAR(20),
    phone VARCHAR(20),
    emergencyContact VARCHAR(20),
    address TEXT,
    bloodType VARCHAR(5),
    weight VARCHAR(10),
    height VARCHAR(10),
    insurance VARCHAR(100),
    allergies TEXT,
    medications TEXT,
    medicalHistory TEXT,
    registrationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
