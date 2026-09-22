<?php
// dashboard.php
require_once 'includes/auth.php';
verificarLoginRaiz();
require_once 'config/conexao.php';

// Conta total de amigos
$total = $pdo->query('SELECT COUNT(*) AS total FROM amigos')->fetch()['total'];

require_once 'includes/header.php';
?>

<h2 class="titulo-pagina">Bem-vindo(a), <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</h2>

<div class="cards">
    <div class="card">
        <h3>Total de Amigos</h3>
        <p class="numero"><?= (int) $total ?></p>
    </div>
    <div class="card">
        <h3>Ações Rápidas</h3>
        <a href="amigos/cadastrar.php" class="btn btn-primario">➕ Cadastrar Amigo</a>
        <a href="amigos/listar.php" class="btn btn-secundario">📋 Ver Lista</a>
    </div>
</div>

<div class="sobre-projeto">
    <h3>Sobre o projeto</h3>
    <p>Este sistema demonstra o CRUD completo (Create, Read, Update, Delete) com autenticação de usuários, desenvolvido em PHP, MySQL, HTML, CSS e JavaScript.</p>
</div>

<?php require_once 'includes/footer.php'; ?>