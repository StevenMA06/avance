<?php 
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "certificados"; 

// Establecer conexión con la base de datos
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


// Obtiene los datos del formula
$solicitante = $_POST['solicitante'];
$referencia = $_POST['referencia'];
$contenido = $_POST['contenido'];
$nota = $_POST['nota'];
$fecha = $_POST['fecha'];

// Validación de datos (opcional)
if (empty($solicitante) || empty($referencia) || empty($contenido) || empty($nota) || empty($fecha)) {
    die("Todos los campos son obligatorios.");
}

// Usar prepared statement para evitar SQL Injection
$stmt = $conn->prepare("INSERT INTO certificados2 (solicitante, referencia, Contenido, nota, fecha, fecha_registrada) VALUES (?, ?, ?, ?, ?, NOW())");

// Vincular los parámetros con los datos del formulario
$stmt->bind_param("sssss", $solicitante, $referencia, $contenido, $nota, $fecha);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Certificado guardado correctamente.";
} else {
    echo "Error al guardar los datos: " . $stmt->error;
}

// Cierra la conexión
$stmt->close();
$conn->close();
?>
