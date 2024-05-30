<?php
global $pdo;
require '../config/database.php';
require '../api/cors.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if ($data) {
        $phone = $data['phone'];

        if (!empty($phone)) {

            $checkAppointmentSql = "SELECT id FROM appointment WHERE phone = :phone";
            $checkAppointmentStmt = $pdo->prepare($checkAppointmentSql);
            $checkAppointmentStmt->bindParam(':phone', $phone);
            $checkAppointmentStmt->execute();

            if ($checkAppointmentStmt->rowCount() > 0) {
                http_response_code(400);
                echo json_encode(["error" => "Пользователь с таким логином уже существует."]);
                exit;
            }

            $sql = "INSERT INTO appointment (email) VALUES (:email)";
            $stmt = $pdo->prepare($sql);

            $params = [
                ":phone" => $phone
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

