<?php
// login.php
require_once 'config/conexao.php';
session_start();

// Se já estiver logado, redireciona
if (isset($_SESSION['usuario_id'])) {
    header('Location: dashboard.php');
    exit;
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    // Validação no servidor
    if ($email === '' || $senha === '') {
        $erro = 'Preencha todos os campos.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'E-mail inválido.';
    } else {
        // Consulta preparada (evita SQL Injection)
        $stmt = $pdo->prepare('SELECT id, nome, senha FROM usuarios WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Login bem-sucedido
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            header('Location: dashboard.php');
            exit;
        } else {
            $erro = 'E-mail ou senha incorretos.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Amigos da Gabi</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="pagina-login">
    <div class="caixa-login">
        <h1>👥 Amigos da Gabi</h1>
        <h2>Entrar no sistema</h2>

        <?php if ($erro): ?>
            <div class="alerta alerta-erro"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php" id="form-login" novalidate>
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder="admin@gabi.com" required
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" placeholder="••••••" required>

            <button type="submit" class="btn btn-primario">Entrar</button>
        </form>

        <p class="info-teste">
            <strong>Credenciais de teste:</strong><br>
            E-mail: <code>admin@gabi.com</code><br>
            Senha: <code>123456</code>
        </p>
    </div>
    <script src="js/script.js"></script>
</body>
</html>