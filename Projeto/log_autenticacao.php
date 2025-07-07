<?php
session_start();
require_once 'conexao.php';

$id_tentativa = $_SESSION['id_tentativa'] ?? null;
$status = 'sucesso'; // Sempre sucesso se chegou aqui

if (!$id_tentativa || !ctype_digit($id_tentativa)) {
    echo "<script>alert('ID inválido.'); window.location.href = 'tela_login.php';</script>";
    exit;
}

$stmt = $pdo->prepare("SELECT id_usuario FROM Tentativa_Login WHERE id_tentativa = :id");
$stmt->execute(['id' => $id_tentativa]);
$dados = $stmt->fetch();

if ($dados) {
    $stmt = $pdo->prepare("INSERT INTO Log_Autenticacao (id_usuario, id_tentativa, status)
        VALUES (:id_usuario, :id_tentativa, :status)");
    $stmt->execute([
        'id_usuario' => $dados['id_usuario'],
        'id_tentativa' => $id_tentativa,
        'status' => $status
    ]);

    // Limpa os dados de sessão relacionados à tentativa
    unset($_SESSION['id_tentativa']);
    unset($_SESSION['otp_tentativas']);

    echo "<script>
        alert('Autenticação: sucesso');
        window.location.href = 'painel.php';
    </script>";
} else {
    echo "<script>
        alert('Tentativa não encontrada.');
        window.location.href = 'tela_login.php';
    </script>";
}
