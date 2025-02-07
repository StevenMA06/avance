<?php
// Conectar a la base de datos
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "certificados";
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$certificadoID = $_POST['certificadoID'];

if (empty($certificadoID)) {
    echo json_encode(['success' => false, 'message' => 'ID vacío']);
    exit;
}

$sql = "SELECT * FROM certificados WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $certificadoID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode([
        'success' => true,
        'solicitante' => $row['solicitante'],
        'referencia' => $row['referencia'],
        'denominacion' => $row['denominacion'],
        'codigo' => $row['codigo'],
        'fecha' => $row['fecha'],
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Certificado no encontrado']);
}

$stmt->close();
$conn->close();
?>
