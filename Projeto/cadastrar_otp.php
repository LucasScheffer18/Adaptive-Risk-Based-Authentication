<?php
require_once 'conexao.php';
session_start();

// Proteção de acesso
$id_usuario = $_SESSION['id_usuario'] ?? null;
if (!$id_usuario) {
    header('Location: tela_login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $otp = trim($_POST['otp']);

    if (strlen($otp) >= 4 && strlen($otp) <= 10) {
        $stmt = $pdo->prepare("UPDATE usuario SET otp = ? WHERE id_usuario = ?");
        $stmt->execute([$otp, $id_usuario]);

        echo "<script>
                alert('Código OTP cadastrado com sucesso!');
                window.location.href = 'painel.php';
              </script>";
        exit;
    } else {
        echo "<script>alert('O código OTP deve ter entre 4 e 10 caracteres.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Cadastrar Código OTP</h2>
        <form method="POST" class="mt-3">
            <div class="mb-3">
                <label for="otp" class="form-label">Digite seu código OTP (4 a 10 caracteres):</label>
                <input type="text" name="otp" id="otp" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
        </form>

        <div class="mt-3">
            <a href="painel.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</body>
</html>
