<?php

require_once __DIR__ . '/./vendor/autoload.php';

use Dotenv\Dotenv;

if ($_SERVER['HTTP_HOST'] == 'localhost:8000') {
    // Локальная разработка, загружаем переменные из файла .env
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}
