<?php
// includes/auth.php
// Inicia a sessão e protege páginas internas

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Função para verificar se o usuário está logado
function verificarLogin(): void
{
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: ../login.php');
        exit;
    }
}

// Função para verificar se o usuário está logado (para páginas na raiz)
function verificarLoginRaiz(): void
{
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit;
    }
}