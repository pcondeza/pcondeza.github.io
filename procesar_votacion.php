<?php
function validarRUT($rut) {
    // Eliminar puntos y guiones
    $rut = str_replace(array('.', '-'), '', $rut);
    
    // Validar que el RUT tenga entre 8 y 9 caracteres (incluyendo dígito verificador)
    return preg_match('/^\d{7,8}[0-9K]$/', $rut);
}

function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $alias = $_POST["alias"];
    $rut = $_POST["rut"];
    $email = $_POST["email"];
    $region = $_POST["region"];
    $comuna = $_POST["comuna"];
    $candidato = $_POST["candidato"];
    
    // Verifica si 'medio' es un array antes de usar implode
    if (isset($_POST["medio"])) {
        if (is_array($_POST["medio"])) {
            $medio = implode(", ", $_POST["medio"]);
        } else {
            $medio = $_POST["medio"];
        }
    } else {
        $medio = '';
    }

    if (!validarRUT($rut)) {
        echo "RUT inválido";
        exit;
    }

    if (!validarEmail($email)) {
        echo "Correo electrónico inválido";
        exit;
    }

    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "votaciones";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO votaciones (nombre, alias, rut, email, region, comuna, candidato, info) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error al preparar la declaración: " . $conn->error);
    }
    
    $bind = $stmt->bind_param("ssssssss", $nombre, $alias, $rut, $email, $region, $comuna, $candidato, $medio);
    if ($bind === false) {
        die("Error al enlazar los parámetros: " . $stmt->error);
    }

    if ($stmt->execute()) {
        echo "Votación registrada exitosamente";
    } else {
        echo "Error al ejecutar la declaración: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Método de solicitud no permitido";
}
?>
