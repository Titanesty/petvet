<?php
global $pdo;
require '../config/database.php';
require '../api/cors.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $authorization = getallheaders()["Authorization"] ?? null;

    if (!$authorization) {
        http_response_code(401);
        echo json_encode(array("message" => "Access denied. No token provided."));
    }
    if (preg_match('/Bearer\s(\S+)/', $authorization, $matches)) {
        $jwt = $matches[1];

        try {
            $decoded = JWT::decode($jwt, new Key($_ENV["JWT_SECRET"], 'HS256'));
            $decoded_array = (array) $decoded;
            $userId = $decoded_array['data']->id;

            // Здесь можно выполнить запрос в базу данных, чтобы получить данные ЛК пользователя
            $query = "SELECT id, name, phone, login FROM clients WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":id", $userId);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                http_response_code(200);
                echo json_encode(array(
                    "message" => "Access granted.",
                    "user" => $user
                ));
            } else {
                http_response_code(404);
                echo json_encode(array("message" => "User not found."));
            }
        } catch (Exception $e) {
            // Если токен недействителен
            http_response_code(401);
            echo json_encode(array("message" => "Access denied. Invalid token decode."));
        }
    } else {
        // Если формат токена неверный
        http_response_code(401);
        echo json_encode(array("message" => "Access denied. Invalid token format."));
    }
} else {
    // Если токен не передан
    http_response_code(401);
    echo json_encode(array("message" => "Access denied. No token provided."));
}
