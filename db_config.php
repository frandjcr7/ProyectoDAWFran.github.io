<?php
// Configuración de la conexión a la base de datos
$servername = "localhost"; // O la IP de tu servidor, si es remoto
$username = "root";        // Usuario por defecto en XAMPP es "root"
$password = "";            // En XAMPP, la contraseña por defecto es vacía
$dbname = "informatica";   // Asegúrate de haber creado esta base de datos

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit(); // Detén la ejecución si hay error de conexión
}
?>

