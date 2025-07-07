<?php
require_once 'conexao.php';

$id_tentativa = $_GET['id_tentativa'] ?? '';

$sql = "SELECT risco FROM Tentativa_Login WHERE id_tentativa = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id_tentativa]);
$dados = $stmt->fetch();

if (!$dados) {
    echo "
        <script>
            alert('Tentativa não encontrada.');
            window.location.href = 'tela_login.php';
        </script>
    ";
    exit;
}

$risco = (float) $dados['risco'];

if ($risco > 0.7) {
    // Insere autenticação adicional tipo OTP automaticamente
    $stmt = $pdo->prepare("INSERT INTO Autenticacao_Adicional (id_tentativa, tipo, validado)
        VALUES (:id_tentativa, 'OTP', 0)");
    $stmt->execute(['id_tentativa' => $id_tentativa]);

    // Redireciona para a tela de verificação
    header("Location: otp_verificacao.php?id_tentativa={$id_tentativa}");
    exit;
} else {
    // Risco aceitável, prossegue com login
    header("Location: log_autenticacao.php?id_tentativa={$id_tentativa}&status=sucesso");
    exit;
}