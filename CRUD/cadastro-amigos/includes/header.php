<?php
// includes/header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Amigos da Gabi</title>
    <link rel="stylesheet" href="/cadastro-amigos/css/style.css">
</head>
<body>
<header class="topo">
    <div class="container topo-conteudo">
        <h1 class="logo">👥 Amigos da Gabi</h1>
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <nav class="menu">
                <a href="/cadastro-amigos/dashboard.php">Dashboard</a>
                <a href="/cadastro-amigos/amigos/listar.php">Amigos</a>
                <a href="/cadastro-amigos/amigos/cadastrar.php">Novo Amigo</a>
                <a href="/cadastro-amigos/logout.php" class="btn-logout">Sair</a>
            </nav>
        <?php endif; ?>
    </div>
</header>
<main class="container">