<?php
global $pdo;
require '../config/database.php';
require '../vendor/autoload.php';
require '../api/cors.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$authorization = getallheaders()["Authorization"];
$client_id = null;

if (!$authorization) {
    echo json_encode(array("message" => "Access denied. Invalid token decode."));
    exit();
}

if (preg_match('/Bearer\s(\S+)/', $authorization, $matches)) {
    $jwt = $matches[1];
    try {
        $decoded = JWT::decode($jwt, new Key($_ENV["JWT_SECRET"], 'HS256'));
        $decoded_array = (array)$decoded;
        $client_id = $decoded_array['data']->id;
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(array("message" => "Access denied. Invalid token decode."));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if ($data) {
        $animal = $data['animal'] ?? null;
        $time_from = $data['time_from'] ?? null;
        $time_to = $data['time_to'] ?? null;
        $veterinarian_id = $data['veterinarian_id'] ?? null;

        if ($animal && $time_from && $time_to && $client_id && $veterinarian_id) {
            $valid_time_from = date('Y-m-d H:i:s', strtotime($time_from));
            $valid_time_to = date('Y-m-d H:i:s', strtotime($time_to));

//            // Проверка, существует ли уже запись
//            $checkRecordSql = "SELECT * FROM records WHERE veterinarian_id = :veterinarian_id AND time_from = :time_from ";
//            $checkRecordStmt = $pdo->prepare($checkRecordSql);
//            $checkRecordStmt->bindParam(':veterinarian_id', $veterinarian_id, PDO::PARAM_INT);
//            $checkRecordStmt->bindParam(':time_from', $valid_time_from, PDO::PARAM_STR);
//            $checkRecordStmt->execute();

//            if ($checkRecordStmt->rowCount() > 0) {
//                http_response_code(400);
//                echo json_encode(["error" => "The appointment is already taken."]);
//                exit;
//            }

            // Проверка существования veterinarian_id в таблице vets
            $checkVetSql = "SELECT COUNT(*) FROM vets WHERE id = :veterinarian_id";
            $checkVetStmt = $pdo->prepare($checkVetSql);
            $checkVetStmt->bindParam(':veterinarian_id', $veterinarian_id, PDO::PARAM_INT);
            $checkVetStmt->execute();
            $vetExists = $checkVetStmt->fetchColumn();

            if ($vetExists == 0) {
                http_response_code(400);
                echo json_encode(["error" => "Veterinarian does not exist."]);
                exit();
            }

            echo json_encode(["ar"=>$vetExists, "arr"=>$veterinarian_id]);

            $sql = "INSERT INTO records (animal, time_from, time_to, client_id, veterinarian_id) VALUES (:animal, :time_from, :time_to, :client_id, :veterinarian_id)";
            $stmt = $pdo->prepare($sql);

            $params = [
                ':animal' => $animal,
                ':time_from' => $valid_time_from,
                ':time_to' => $valid_time_to,
                ':client_id' => $client_id,
                ':veterinarian_id' => $veterinarian_id
            ];

            if ($stmt->execute($params)) {
                echo json_encode(["message" => "Successfully recorded", "record" => $params]);
            } else {
                http_response_code(400);
                echo json_encode(["error" => "Recording error."]);
            }
        } else {
            echo json_encode(["error" => "Please fill in all fields."]);
        }
    } else {
        echo json_encode(["error" => "Incorrect data format."]);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (preg_match('/Bearer\s(\S+)/', $authorization, $matches)) {
        $jwt = $matches[1];
        try {
            $decoded = JWT::decode($jwt, new Key($_ENV["JWT_SECRET"], 'HS256'));
            $decoded_array = (array)$decoded;
            $client_id = $decoded_array['data']->id;

            $checkRecordSql = "SELECT * FROM records WHERE client_id = :client_id";
            $checkRecordStmt = $pdo->prepare($checkRecordSql);
            $checkRecordStmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
            $checkRecordStmt->execute();
            $appointments = $checkRecordStmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($appointments);
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(array("message" => "Access denied. Invalid token decode."));
        }
    } else {
        echo json_encode(array("message" => "Access denied. Invalid token decode."));
    }
} else {
    echo json_encode(["error" => "Invalid request method."]);
}

