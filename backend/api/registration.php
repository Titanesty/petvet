<?php
global $pdo;
require '../config/database.php';
require '../api/cors.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if ($data) {
        $name = $data['name'] ?? null;
        $login = $data['login'] ?? null;
        $password = $data['password'] ?? null;
        $phone = $data['phone'] ?? null;

        if ($name && $login && $password && $phone) {

            // Проверка, существует ли пользователь с таким логином
            $checkUserSql = "SELECT id FROM clients WHERE login = :login";
            $checkUserStmt = $pdo->prepare($checkUserSql);
            $checkUserStmt->bindParam(':login', $login);
            $checkUserStmt->execute();

            if ($checkUserStmt->rowCount() > 0) {
                http_response_code(400);
                echo json_encode(["error" => "Пользователь с таким логином уже существует."]);
                exit;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO clients (name, login, password, phone) VALUES (:name, :login, :password, :phone)";
            $stmt = $pdo->prepare($sql);

            $params = [
                ':name' => $name,
                ':login' => $login,
                ':password' => $hashedPassword,
                ':phone' => $phone
            ];

            // Выполнение запроса
            if ($stmt->execute($params)) {
                echo json_encode(["message" => "Пользователь успешно зарегистрирован!"]);
            } else {
                http_response_code(400);
                echo json_encode(["error" => "Ошибка регистрации пользователя."]);
            }
        } else {
            echo json_encode(["error" => "Пожалуйста, заполните все поля."]);
        }
    } else {
        echo json_encode(["error" => "Некорректный формат данных."]);
    }
} else {
    echo json_encode(["error" => "Некорректный метод запроса."]);
}

