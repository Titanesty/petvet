<?php
global $pdo;
require '../config/database.php';
require '../vendor/autoload.php';
require '../api/cors.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $checkClientSql = "SELECT * FROM clients WHERE id  = :id ";
        $checkClientStmt = $pdo->prepare($checkClientSql);
        $checkClientStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $checkClientStmt->execute();
        $clientName = $checkClientStmt->fetchColumn(PDO::FETCH_ASSOC);
        if ($clientName) echo json_encode($clientName); else {
            echo "Пользователя не существует";
        }

    }
}
