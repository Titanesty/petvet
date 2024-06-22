<?php
global $pdo;
require '../config/database.php';
require '../vendor/autoload.php';
require '../api/cors.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authorization = getallheaders()["Authorization"];

    if (!$authorization || preg_match('/Bearer\s(\S+)/', $authorization, $matches)) {
        $jwt = $matches[1];
        try {
            $decoded = JWT::decode($jwt, new Key($_ENV["JWT_SECRET"], 'HS256'));
            $decoded_array = (array)$decoded;
            $client_id = $decoded_array['data']->id;
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(array("message" => "Access denied. Invalid token decode."));
        }
    } else {
        echo json_encode(array("message" => "Access denied. Invalid token decode."));
        exit();
    }

    $data = json_decode(file_get_contents('php://input'), true);

    if($data) {
        $text = $data['text'] ?? null;

        if (empty($text)) {
            echo json_encode(array("message" => "Text is empty."));
            exit();
        }

        $veterinarian_id = $data['veterinarian_id'] ?? null;
        $date = date("Y-m-d H:i:s");

        $sql = "INSERT INTO reviews (text, client_id, veterinarian_id, date) VALUES (:text, :client_id, :veterinarian_id, :date)";

        $stmt = $pdo->prepare($sql);



        $params = [
            'text' => $text,
            'client_id' => $client_id,
            'veterinarian_id' => $veterinarian_id,
            'date' => $date,
        ];

        if ($stmt->execute($params)) {
            echo json_encode(["message" => "Successfully recorded", "reviews" => $params]);
        }
    }

} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $checkReviewsSql = "SELECT * FROM reviews WHERE veterinarian_id  = :veterinarian_id ";
        $checkReviewsStmt = $pdo->prepare($checkReviewsSql);
        $checkReviewsStmt->bindParam(':veterinarian_id', $id, PDO::PARAM_INT);
        $checkReviewsStmt->execute();
        $appointments = $checkReviewsStmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($appointments);
    }
}
