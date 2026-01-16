<?php

require __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();


$host = "127.0.0.1";
$user = "root";
$password = $_ENV['DB_PASS'];
$database = "projeto_escola";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("conexao falhou " . $conn->error);
}
