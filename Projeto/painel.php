<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: tela_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Painel do Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</p>
        
        <ul>
            <li><a href="perfil.php">Ver Perfil</a></li>
            <li><a href="cadastrar_otp.php">Cadastro de OTP</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </div>
</body>
</html>
