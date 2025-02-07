<?php
// Conectar a la base de datos
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "certificados";
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Error de conexión: ' . $conn->connect_error]));
}

// Verificar si se recibió el ID correctamente
if (!isset($_POST['certificadoID2']) || empty($_POST['certificadoID2'])) {
    echo json_encode(['success' => false, 'message' => 'ID vacío o no enviado']);
    exit;
}

$certificadoID2 = $_POST['certificadoID2'];

// Preparar la consulta para evitar SQL Injection
$sql = "SELECT solicitante, referencia, Contenido, nota, fecha FROM certificados2 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $certificadoID2);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode([
        'success' => true,
        'solicitante' => $row['solicitante'],
        'referencia' => $row['referencia'],
        'contenido' => $row['Contenido'],  // Asegúrate de que el nombre es correcto en la BD
        'nota' => $row['nota'],
        'fecha' => $row['fecha'],
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Certificado no encontrado']);
}

$stmt->close();
$conn->close();
?>
