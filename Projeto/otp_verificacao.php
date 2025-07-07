<?php
session_start();
require_once 'conexao.php';

$id_tentativa = $_SESSION['id_tentativa'] ?? null;
$codigo       = trim($_POST['codigo'] ?? '');

if (!$id_tentativa || $codigo === '') {
    echo "<script>alert('Dados inválidos.'); window.location.href='tela_login.php';</script>";
    exit;
}

/* --- Busca OTP do usuário --- */
$stmt = $pdo->prepare("
    SELECT u.otp, u.id_usuario
    FROM Tentativa_Login t
    JOIN usuario u ON u.id_usuario = t.id_usuario
    WHERE t.id_tentativa = ?
");
$stmt->execute([$id_tentativa]);
$usuario = $stmt->fetch();

$otpCorreto = $usuario ? $usuario['otp'] : null;
$validado   = ($otpCorreto && $codigo === $otpCorreto) ? 1 : 0;

/* --- Registra autenticação adicional (sempre) --- */
$id_autenticacao = uniqid();
$tipo            = 'otp';

$stmt = $pdo->prepare("
    INSERT INTO Autenticacao_Adicional (id_autenticacao, id_tentativa, tipo, validado)
    VALUES (?, ?, ?, ?)");
$stmt->execute([$id_autenticacao, $id_tentativa, $tipo, $validado]);

/* --- Controle de tentativas --- */
if ($validado) {
    unset($_SESSION['otp_tentativas']); // limpa as tentativas
    header("Location: log_autenticacao.php");
    exit;
}

# Falha: incrementa tentativas na sessão
$_SESSION['otp_tentativas'] = ($_SESSION['otp_tentativas'] ?? 0) + 1;

if ($_SESSION['otp_tentativas'] >= 3) {
    unset($_SESSION['otp_tentativas'], $_SESSION['id_tentativa']);
    echo "<script>
            alert('Número máximo de tentativas excedido. Faça login novamente.');
            window.location.href='tela_login.php';
          </script>";
    exit;
}

/* Ainda pode tentar de novo */
echo "<script>
        alert('OTP incorreto. Tente novamente.');
        window.location.href='otp.php';
      </script>";
exit;
