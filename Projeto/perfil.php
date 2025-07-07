<?php
require_once 'conexao.php';
session_start();

// Proteção de acesso
$id_usuario = $_SESSION['id_usuario'] ?? null;
if (!$id_usuario) {
    header('Location: tela_login.php');
    exit;
}

// Buscar informações do usuário
$stmt = $pdo->prepare("SELECT nome, email, otp FROM usuario WHERE id_usuario = ?");
$stmt->execute([$id_usuario]);
$usuario = $stmt->fetch();

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <h2>Perfil do Usuário</h2>

        <div class="info"><strong>Nome:</strong> <?= htmlspecialchars($usuario['nome']) ?></div>
        <div class="info"><strong>Email:</strong> <?= htmlspecialchars($usuario['email']) ?></div>
        <div class="info"><strong>Código OTP:</strong> <?= htmlspecialchars($usuario['otp']) ?></div>

        <div class="text-center mt-4">
            <a href="painel.php" class="btn btn-primary">Voltar ao Painel</a>
        </div>
    </div>
</body>
</html>
