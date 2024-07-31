<?php
$servername = "localhost";
$username = "root";
$password = ""; // Contraseña por defecto en XAMPP es vacía
$dbname = "votaciones";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "Conexión exitosa";
}

$conn->close();
?>
