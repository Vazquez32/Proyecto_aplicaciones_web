<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "root123";
$dbname = "hambre_cero";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Conexión fallida: " . $conn->connect_error]));
}

// Procesar datos del formulario
$region = $_POST['region'] ?? '';
$lavar_alimentos = $_POST['lavar_alimentos'] ?? '';
$origen_alimentos = $_POST['origen_alimentos'] ?? '';
$consumo_fuera = $_POST['consumo_fuera'] ?? '';
$acceso_canasta = $_POST['acceso_canasta'] ?? '';
$donar_alimentos = $_POST['donar_alimentos'] ?? '';
$facil_acceso = $_POST['facil_acceso'] ?? '';
$alimentacion_balanceada = $_POST['alimentacion_balanceada'] ?? '';
$orientacion_alimentaria = $_POST['orientacion_alimentaria'] ?? '';

// Procesar checkbox de tipos de alimentos
$tipo_alimentos = isset($_POST['tipo_alimentos']) ? implode(', ', $_POST['tipo_alimentos']) : '';

// Preparar consulta SQL
$sql = "INSERT INTO encuestas (
    region, lavar_alimentos, origen_alimentos, consumo_fuera, 
    acceso_canasta, donar_alimentos, facil_acceso, 
    alimentacion_balanceada, tipo_alimentos, orientacion_alimentaria
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssssssss", 
    $region, $lavar_alimentos, $origen_alimentos, $consumo_fuera,
    $acceso_canasta, $donar_alimentos, $facil_acceso,
    $alimentacion_balanceada, $tipo_alimentos, $orientacion_alimentaria
);

// Ejecutar consulta
if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>