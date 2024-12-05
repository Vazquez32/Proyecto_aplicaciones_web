<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

error_reporting(0);

$servername = "localhost";
$username = "root";
$password = "root123";
$dbname = "hambre_cero";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        http_response_code(500);
        echo json_encode([
            "success" => false, 
            "message" => "Conexión fallida: " . $conn->connect_error
        ]);
        exit();
    }

    $sql = "SELECT * FROM encuestas";
    $result = $conn->query($sql);

    if (!$result) {
        http_response_code(500);
        echo json_encode([
            "success" => false, 
            "message" => "Error en la consulta: " . $conn->error
        ]);
        $conn->close();
        exit();
    }

    if ($result->num_rows > 0) {
        $totalRecords = $result->num_rows;

        $data = [
            "regiones" => [],
            "accesoCanasta" => [],
            "consumoFuera" => [0, 0, 0, 0],
            "tiposAlimentos" => [],
            "consumoAlimentos" => [],
            "recomendaciones" => [],
            "personalizedRecommendations" => []
        ];

        $regionCounts = [];
        $consumoFueraLabels = ["Diariamente", "2 a 3 veces por semana", "Ocasionalmente", "Nunca"];
        $consumoFueraIndex = array_flip($consumoFueraLabels);

        $recommendationMap = [
            "lavar_alimentos" => [
                "Siempre" => "¡Excelente! Lavar los alimentos ayuda a eliminar bacterias, pesticidas y otros contaminantes.",
                "A veces" => "Es importante lavar todos los alimentos frescos, especialmente frutas y verduras, antes de consumirlos.",
                "Nunca" => "Debes lavar siempre tus alimentos para reducir riesgos de contaminación."
            ],
            "consumo_fuera" => [
                "Diariamente" => "Consumir alimentos fuera de casa con frecuencia puede aumentar el riesgo de ingerir comidas altas en grasas.",
                "2 a 3 veces por semana" => "Busca lugares con opciones nutritivas y balanceadas al comer fuera.",
                "Ocasionalmente" => "Aprovecha tus comidas fuera para disfrutar opciones equilibradas.",
                "Nunca" => "Asegúrate de que tus comidas caseras sean variadas y nutritivas."
            ],
            "reducir_hambre" => [
                "Bancos de alimentos" => "Los bancos de alimentos son esenciales para redistribuir recursos alimenticios.",
                "Comedor comunitario" => "Los comedores comunitarios son una excelente forma de apoyar a personas vulnerables.",
                "Apoyos económicos" => "Los apoyos económicos permiten a familias comprar alimentos según sus necesidades.",
                "Promover agricultura local" => "Fomentar la agricultura local fortalece la economía regional y mejora la autosuficiencia alimentaria."
            ],
            "alimentacion_balanceada" => [
                "Muy balanceada" => "¡Felicidades! Mantener una alimentación balanceada es fundamental para la salud.",
                "Poco balanceada" => "Considera incluir más frutas, verduras y cereales integrales en tus comidas.",
                "Nada balanceada" => "Es crucial modificar tus hábitos alimenticios para mejorar tu nutrición."
            ]
        ];

        while($row = $result->fetch_assoc()) {
            $region = $row["region"];
            $regionCounts[$region] = ($regionCounts[$region] ?? 0) + 1;
            
            $data["consumoFuera"][$consumoFueraIndex[$row["consumo_fuera"]]]++;

            $personalRecommendations = [];
            
            // Generar recomendaciones personalizadas para cada categoría
            foreach ($recommendationMap as $category => $recommendations) {
                $userResponse = $row[$category] ?? null;
                if ($userResponse && isset($recommendations[$userResponse])) {
                    $personalRecommendations[] = $recommendations[$userResponse];
                }
            }

            $data["personalizedRecommendations"][] = $personalRecommendations;

            $tiposAlimentos = explode(',', $row['tipo_alimentos']);
            foreach ($tiposAlimentos as $alimento) {
                $alimento = trim($alimento);
                $data['tiposAlimentos'][] = $alimento;
            }
        }

        // Resto del código de procesamiento de datos (igual que antes)
        $data["accesoCanasta"] = array_map(function($region, $count) use ($totalRecords) {
            return round(($count / $totalRecords) * 100, 2);
        }, array_keys($regionCounts), $regionCounts);

        $data["regiones"] = array_keys($regionCounts);
        $data["consumoFuera"] = array_map(function($count) use ($totalRecords) {
            return round(($count / $totalRecords) * 100, 2);
        }, $data["consumoFuera"]);

        $tiposAlimentosCounts = array_count_values($data['tiposAlimentos']);
        $data['tiposAlimentos'] = array_keys($tiposAlimentosCounts);
        $data['consumoAlimentos'] = array_map(function($count) use ($totalRecords) {
            return round(($count / $totalRecords) * 100, 2);
        }, $tiposAlimentosCounts);

        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    } else {
        http_response_code(404);
        echo json_encode([
            "success" => false, 
            "message" => "No se encontraron resultados."
        ]);
    }

    $conn->close();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false, 
        "message" => "Error inesperado: " . $e->getMessage()
    ]);
}
?>