<?php
// amigos/excluir.php
require_once '../includes/auth.php';
verificarLogin();
require_once '../config/conexao.php';

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    header('Location: listar.php');
    exit;
}

// Busca o amigo
$stmt = $pdo->prepare('SELECT * FROM amigos WHERE id = :id LIMIT 1');
$stmt->execute([':id' => $id]);
$amigo = $stmt->fetch();

if (!$amigo) {
    header('Location: listar.php');
    exit;
}

// Se confirmado, exclui
if (isset($_GET['confirmar']) && $_GET['confirmar'] === '1') {
    $stmt = $pdo->prepare('DELETE FROM amigos WHERE id = :id');
    $stmt->execute([':id' => $id]);
    header('Location: listar.php?excluido=1');
    exit;
}

require_once '../includes/header.php';
?>

<h2 class="titulo-pagina">🗑️ Excluir Amigo</h2>

<div class="caixa-confirmacao">
    <p>Tem certeza de que deseja excluir o amigo abaixo?</p>
    <ul class="dados-amigo">
        <li><strong>Nome:</strong> <?= htmlspecialchars($amigo['nome'] . ' ' . $amigo['sobrenome']) ?></li>
        <li><strong>E-mail:</strong> <?= htmlspecialchars($amigo['email']) ?></li>
        <li><strong>Telefone:</strong> <?= htmlspecialchars($amigo['telefone'] ?? '—') ?></li>
        <li><strong>Cidade:</strong> <?= htmlspecialchars($amigo['cidade'] ?? '—') ?></li>
    </ul>

    <div class="acoes">
        <a href="excluir.php?id=<?= $id ?>&confirmar=1" class="btn btn-perigo">Sim, excluir</a>
        <a href="listar.php" class="btn btn-secundario">Cancelar</a>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>