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
$denominacion = $_POST['denominacion'];
$codigo = $_POST['codigo'];
$fecha = $_POST['fecha'];

// Validación de datos (opcional)
if (empty($solicitante) || empty($referencia) || empty($denominacion) || empty($codigo) || empty($fecha)) {
    die("Todos los campos son obligatorios.");
}

// Usar prepared statement para evitar SQL Injection
$stmt = $conn->prepare("INSERT INTO certificados (solicitante, referencia, denominacion, codigo, fecha, fecha_registro) VALUES (?, ?, ?, ?, ?, NOW())");

// Vincular los parámetros con los datos del formulario
$stmt->bind_param("sssss", $solicitante, $referencia, $denominacion, $codigo, $fecha);

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
