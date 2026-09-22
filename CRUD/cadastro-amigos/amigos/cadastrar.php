<?php
// amigos/cadastrar.php
require_once '../includes/auth.php';
verificarLogin();
require_once '../config/conexao.php';

$erros = [];
$sucesso = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitização e validação
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
    if ($nascimento !== '' && !DateTime::createFromFormat('Y-m-d', $nascimento)) {
        $erros[] = 'Data de nascimento inválida.';
    }

    if (empty($erros)) {
        $sql = 'INSERT INTO amigos (nome, sobrenome, email, telefone, data_nascimento, cidade, observacoes)
                VALUES (:nome, :sobrenome, :email, :telefone, :nascimento, :cidade, :obs)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome'       => $nome,
            ':sobrenome'  => $sobrenome,
            ':email'      => $email,
            ':telefone'   => $telefone,
            ':nascimento' => $nascimento ?: null,
            ':cidade'     => $cidade,
            ':obs'        => $obs,
        ]);
        $sucesso = true;
        $_POST = []; // limpa formulário
    }
}

require_once '../includes/header.php';
?>

<h2 class="titulo-pagina">➕ Cadastrar Novo Amigo</h2>

<?php if ($sucesso): ?>
    <div class="alerta alerta-sucesso">Amigo cadastrado com sucesso! <a href="listar.php">Ver lista</a></div>
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

<form method="POST" action="cadastrar.php" class="formulario" id="form-amigo" novalidate>
    <div class="grid-2">
        <div>
            <label for="nome">Nome *</label>
            <input type="text" name="nome" id="nome" required value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
        </div>
        <div>
            <label for="sobrenome">Sobrenome *</label>
            <input type="text" name="sobrenome" id="sobrenome" required value="<?= htmlspecialchars($_POST['sobrenome'] ?? '') ?>">
        </div>
        <div>
            <label for="email">E-mail *</label>
            <input type="email" name="email" id="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
        <div>
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone" placeholder="(11) 99999-9999" value="<?= htmlspecialchars($_POST['telefone'] ?? '') ?>">
        </div>
        <div>
            <label for="data_nascimento">Data de Nascimento</label>
            <input type="date" name="data_nascimento" id="data_nascimento" value="<?= htmlspecialchars($_POST['data_nascimento'] ?? '') ?>">
        </div>
        <div>
            <label for="cidade">Cidade</label>
            <input type="text" name="cidade" id="cidade" value="<?= htmlspecialchars($_POST['cidade'] ?? '') ?>">
        </div>
    </div>
    <label for="observacoes">Observações</label>
    <textarea name="observacoes" id="observacoes" rows="3"><?= htmlspecialchars($_POST['observacoes'] ?? '') ?></textarea>

    <div class="acoes">
        <button type="submit" class="btn btn-primario">Salvar</button>
        <a href="listar.php" class="btn btn-secundario">Cancelar</a>
    </div>
</form>

<?php require_once '../includes/footer.php'; ?>