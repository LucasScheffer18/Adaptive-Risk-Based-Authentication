<?php
session_start();
require_once 'conexao.php';
require_once 'helpers/risco.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

// 1) Consulta de usuário
$sql  = "SELECT * FROM usuario WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
$usuario = $stmt->fetch();

if ($usuario && password_verify($senha, $usuario['senha'])) {

    /* ---------- Sessão ---------- */
    $_SESSION['nome']       = $usuario['nome'];
    $_SESSION['id_usuario'] = $usuario['id_usuario'];

    /* ---------- Tentativa ---------- */
    $ip          = $_SERVER['REMOTE_ADDR'];
    $dispositivo = $_SERVER['HTTP_USER_AGENT'] ?? 'Desconhecido';
    $localizacao = 'Desconhecida';
    $risco       = calcularRisco($ip, $dispositivo, $localizacao);

    $stmt = $pdo->prepare(
        "INSERT INTO Tentativa_Login (id_usuario, ip, dispositivo, localizacao, risco)
         VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->execute([$usuario['id_usuario'], $ip, $dispositivo, $localizacao, $risco]);
    $id_tentativa = $pdo->lastInsertId();

    // Guarda id_tentativa só na sessão
    $_SESSION['id_tentativa'] = $id_tentativa;

    /* ---------- 2FA (OTP) ---------- */
    if (!empty($usuario['otp'])) {

        // Se ainda não existe registro de autenticação adicional para esta tentativa
        $stmt = $pdo->prepare("SELECT 1 FROM Autenticacao_Adicional WHERE id_tentativa = ?");
        $stmt->execute([$id_tentativa]);
        if (!$stmt->fetchColumn()) {
            $stmt = $pdo->prepare(
                "INSERT INTO Autenticacao_Adicional (id_autenticacao, id_tentativa, tipo, validado)
                 VALUES (?, ?, 'otp', 0)"
            );
            $stmt->execute([uniqid(), $id_tentativa]);
        }

        // Redireciona sem exibir o id_tentativa na URL
        header("Location: otp.php");
        exit;
    }

    /* ---------- Login sem OTP ---------- */
    echo "<script>
            alert('Login realizado com sucesso!');
            window.location.href = 'painel.php';
          </script>";
} else {
    echo "<script>
            alert('Credenciais inválidas.');
            window.location.href = 'tela_login.php';
          </script>";
}