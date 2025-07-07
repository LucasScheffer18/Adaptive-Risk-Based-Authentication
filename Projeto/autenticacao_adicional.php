<?php
session_start();
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_autenticacao = uniqid();
    $id_tentativa = $_POST['id_tentativa'];
    $tipo = trim($_POST['tipo']);
    $validado = isset($_POST['validado']) ? 1 : 0;

    // Validação básica
    if (!ctype_digit($id_tentativa) || strlen($tipo) > 50) {
        echo "<script>alert('Dados inválidos.'); window.history.back();</script>";
        exit;
    }

    // Verifica se a tentativa existe
    $check = $pdo->prepare("SELECT 1 FROM Tentativa_Login WHERE id_tentativa = ?");
    $check->execute([$id_tentativa]);

    if (!$check->fetch()) {
        echo "<script>alert('Tentativa não encontrada.'); window.history.back();</script>";
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO Autenticacao_Adicional (id_autenticacao, id_tentativa, tipo, validado)
        VALUES (?, ?, ?, ?)");
    $stmt->execute([$id_autenticacao, $id_tentativa, $tipo, $validado]);

    echo "<script>
        alert('Autenticação adicional cadastrada com sucesso!');
        window.location.href = 'autenticacao_adicional.php';
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Autenticação Adicional</title>
</head>
<body>
    <h2>Cadastro de Autenticação Adicional</h2>
    <form method="post">
        <label>ID da Tentativa: <input type="number" name="id_tentativa" required></label><br><br>
        <label>Tipo: <input type="text" name="tipo" required></label><br><br>
        <label>Validado: <input type="checkbox" name="validado"></label><br><br>
        <button type="submit">Cadastrar</button>
    </form>

    <hr>

    <h3>Registros</h3>
    <?php
    $stmt = $pdo->query("SELECT * FROM Autenticacao_Adicional ORDER BY id_autenticacao DESC");
    foreach ($stmt as $row) {
        echo "ID: " . htmlspecialchars($row['id_autenticacao']) . 
             " | Tentativa: " . htmlspecialchars($row['id_tentativa']) . 
             " | Tipo: " . htmlspecialchars($row['tipo']) . 
             " | Validado: " . ($row['validado'] ? 'Sim' : 'Não') . "<br>";
    }
    ?>
</body>
</html>
