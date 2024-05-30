<?php
global $pdo;
require '../config/database.php';
require '../api/cors.php';


use Firebase\JWT\JWT;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents("php://input"), true);

    if (
        !empty($data['login']) &&
        !empty($data['password'])
    ) {
        $query = "SELECT id, login, password, name FROM clients WHERE login = :login";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":login", $data['login']);
        $stmt->execute();

        $num = $stmt->rowCount();
        if ($num > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($data['password'], $row['password'])) {
                // Генерируем JWT
                $payload = [
                    "iss" => "your_domain.com",
                    "aud" => "your_domain.com",
                    "iat" => time(),
                    "nbf" => time(),
                    "exp" => time() + (7 * 24 * 60 * 60),
                    "data" => [
                        "id" => $row['id'],
                        "name" => $row['name']
                    ]
                ];

                $jwt = JWT::encode($payload, $_ENV["JWT_SECRET"], 'HS256');

                // Возвращаем JWT клиенту
                http_response_code(200);
                echo json_encode(array(
                    "message" => "Login successful.",
                    "token" => $jwt
                ));
            } else {
                http_response_code(401);
                echo json_encode(array("message" => "Login failed. Incorrect password."));
            }
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Login failed. User not found."));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Login failed. Data is incomplete."));
    }
}
