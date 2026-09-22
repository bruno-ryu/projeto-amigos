<?php
// amigos/listar.php
require_once '../includes/auth.php';
verificarLogin();
require_once '../config/conexao.php';

$busca = trim($_GET['busca'] ?? '');

if ($busca !== '') {
    $stmt = $pdo->prepare('SELECT * FROM amigos WHERE nome LIKE :b OR sobrenome LIKE :b OR email LIKE :b ORDER BY nome');
    $stmt->execute([':b' => "%$busca%"]);
} else {
    $stmt = $pdo->query('SELECT * FROM amigos ORDER BY nome');
}
$amigos = $stmt->fetchAll();

require_once '../includes/header.php';
?>

<h2 class="titulo-pagina">📋 Lista de Amigos</h2>

<div class="barra-acoes">
    <form method="GET" action="listar.php" class="form-busca">
        <input type="text" name="busca" placeholder="Buscar por nome, sobrenome ou e-mail..."
               value="<?= htmlspecialchars($busca) ?>">
        <button type="submit" class="btn btn-secundario">Buscar</button>
        <?php if ($busca !== ''): ?>
            <a href="listar.php" class="btn btn-limpar">Limpar</a>
        <?php endif; ?>
    </form>
    <a href="cadastrar.php" class="btn btn-primario">➕ Novo Amigo</a>
</div>

<?php if (empty($amigos)): ?>
    <p class="vazio">Nenhum amigo encontrado.</p>
<?php else: ?>
    <div class="tabela-wrapper">
        <table class="tabela">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Cidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($amigos as $a): ?>
                    <tr>
                        <td><?= (int) $a['id'] ?></td>
                        <td><?= htmlspecialchars($a['nome'] . ' ' . $a['sobrenome']) ?></td>
                        <td><?= htmlspecialchars($a['email']) ?></td>
                        <td><?= htmlspecialchars($a['telefone'] ?? '—') ?></td>
                        <td><?= htmlspecialchars($a['cidade'] ?? '—') ?></td>
                        <td class="acoes-tabela">
                            <a href="editar.php?id=<?= (int) $a['id'] ?>" class="btn-acao btn-editar">✏️ Editar</a>
                            <a href="excluir.php?id=<?= (int) $a['id'] ?>"
                               class="btn-acao btn-excluir"
                               onclick="return confirmarExclusao('<?= htmlspecialchars($a['nome'], ENT_QUOTES) ?>')">
                               🗑️ Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php require_once '../includes/footer.php'; ?>