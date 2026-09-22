<?php
// config/conexao.php
// Conexão com o banco de dados usando PDO

$host = 'localhost';
$dbname = 'cadastro_amigos';
$usuario = 'root';
$senha = ''; // No XAMPP padrão, a senha do root é vazia

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $usuario,
        $senha,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    die('Erro ao conectar ao banco de dados: ' . $e->getMessage());
}