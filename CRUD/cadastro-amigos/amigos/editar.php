<?php
// amigos/editar.php
require_once '../includes/auth.php';
verificarLogin();
require_once '../config/conexao.php';

$id = (int) ($_GET['id'] ?? 0);
$erros = [];
$sucesso = false;

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome      = trim($_POST['nome'] ?? '');
    $sobrenome = trim($_POST['sobrenome'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $telefone  = trim($_POST['telefone'] ?? '');
    $nascimento = trim($_POST['data_nascimento'] ?? '');
    $cidade    = trim($_POST['cidade'] ?? '');
    $obs       = trim($_POST['observacoes'] ?? '');

    if ($nome === '')      $erros[] = 'O nome é obrigatório.';
    if ($sobrenome === '') $erros[] = 'O sobrenome é obrigatório.';
    if ($email === '')     $erros[] = 'O e-mail é obrigatório.';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = 'E-mail inválido.';

    if (empty($erros)) {
        $sql = 'UPDATE amigos SET nome = :nome, sobrenome = :sobrenome, email = :email,
                telefone = :telefone, data_nascimento = :nascimento, cidade = :cidade,
                observacoes = :obs WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome'       => $nome,
            ':sobrenome'  => $sobrenome,
            ':email'      => $email,
            ':telefone'   => $telefone,
            ':nascimento' => $nascimento ?: null,
            ':cidade'     => $cidade,
            ':obs'        => $obs,
            ':id'         => $id,
        ]);
        $sucesso = true;
        // Atualiza os dados exibidos
        $amigo = array_merge($amigo, compact('nome','sobrenome','email','telefone','cidade','obs') + ['data_nascimento' => $nascimento]);
    }
}

require_once '../includes/header.php';
?>

<h2 class="titulo-pagina">✏️ Editar Amigo</h2>

<?php if ($sucesso): ?>
    <div class="alerta alerta-sucesso">Amigo atualizado com sucesso! <a href="listar.php">Voltar à lista</a></div>
<?php endif; ?>

<?php if (!empty($erros)): ?>
    <div class="alerta alerta-erro">
        <ul>
            <?php foreach ($erros as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="editar.php?id=<?= $id ?>" class="formulario" id="form-amigo" novalidate>
    <div class="grid-2">
        <div>
            <label for="nome">Nome *</label>
            <input type="text" name="nome" id="nome" required value="<?= htmlspecialchars($_POST['nome'] ?? $amigo['nome']) ?>">
        </div>
        <div>
            <label for="sobrenome">Sobrenome *</label>
            <input type="text" name="sobrenome" id="sobrenome" required value="<?= htmlspecialchars($_POST['sobrenome'] ?? $amigo['sobrenome']) ?>">
        </div>
        <div>
            <label for="email">E-mail *</label>
            <input type="email" name="email" id="email" required value="<?= htmlspecialchars($_POST['email'] ?? $amigo['email']) ?>">
        </div>
        <div>
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone" value="<?= htmlspecialchars($_POST['telefone'] ?? $amigo['telefone']) ?>">
        </div>
        <div>
            <label for="data_nascimento">Data de Nascimento</label>
            <input type="date" name="data_nascimento" id="data_nascimento" value="<?= htmlspecialchars($_POST['data_nascimento'] ?? $amigo['data_nascimento']) ?>">
        </div>
        <div>
            <label for="cidade">Cidade</label>
            <input type="text" name="cidade" id="cidade" value="<?= htmlspecialchars($_POST['cidade'] ?? $amigo['cidade']) ?>">
        </div>
    </div>
    <label for="observacoes">Observações</label>
    <textarea name="observacoes" id="observacoes" rows="3"><?= htmlspecialchars($_POST['observacoes'] ?? $amigo['observacoes']) ?></textarea>

    <div class="acoes">
        <button type="submit" class="btn btn-primario">Salvar Alterações</button>
        <a href="listar.php" class="btn btn-secundario">Cancelar</a>
    </div>
</form>

<?php require_once '../includes/footer.php'; ?>