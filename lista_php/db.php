<?php
$host = 'localhost';
$dbname = 'tarefas_php';
$username = 'root';
$password = 'senha do banco mysql';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Conexao falhou: ' . $e->getMessage();
}
?>