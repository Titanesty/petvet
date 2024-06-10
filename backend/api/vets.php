<?php
global $pdo;
require '../config/database.php';
require '../api/cors.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // $authorization = getallheaders()["Authorization"] ?? null;

//    if ($authorization) {
//        if (preg_match('/Bearer\s(\S+)/', $authorization, $matches)) {
//            try {
//                $jwt = $matches[1];
//                $decoded = JWT::decode($jwt, new Key($_ENV["JWT_SECRET"], 'HS256'));
//            } catch (Exception $e) {
//                http_response_code(401);
//                echo json_encode(array("message" => "Access denied. Invalid token decode."));
//                exit();
//            }
//        } else {
//            http_response_code(401);
//            echo json_encode(array("message" => "Access denied. Invalid token decode."));
//            exit();
//        }
//    } else {
//        http_response_code(401);
//        echo json_encode(array("message" => "Access denied. Invalid token decode."));
//        exit();
//    }

    // Проверяем, передан ли параметр id в запросе
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        // Если передан id, получаем данные для конкретного врача
        $id = $_GET['id'];

        // Параметризованный SQL-запрос для получения одного врача по id
        $vetSql = "SELECT * FROM `vets` WHERE `id` = :id";
        $vetStmt = $pdo->prepare($vetSql);
        $vetStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $vetStmt->execute();

        // Получаем результат запроса
        $vet = $vetStmt->fetch(PDO::FETCH_ASSOC);

        // Проверяем, найден ли врач с таким id
        if ($vet) {
            echo json_encode($vet);
        } else {
            echo json_encode(["error" => "Врач с таким ID не найден."]);
        }
    } else {
        // Если id не передан, получаем данные всех врачей
        $vetsSql = "SELECT * FROM `vets`";
        $vetsStmt = $pdo->prepare($vetsSql);
        $vetsStmt->execute();
        $vets = $vetsStmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array(
            "vets" => $vets
        ));
    }
} else {
    echo json_encode(["error" => "Некорректный метод запроса."]);
}

