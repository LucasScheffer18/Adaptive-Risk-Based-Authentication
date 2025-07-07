<?php
require_once "conexao.php"; // Inclui o arquivo de conexão PDO

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
    $id = uniqid();

    try {
        // Preparando a consulta para inserir o usuário
        $sql = "INSERT INTO Usuario (id_usuario, nome, email, senha) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);  // Usando a variável $pdo aqui para a conexão
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $nome);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $senha);

        // Executando a consulta
        if ($stmt->execute()) {
            echo "
                <script>
                    // Redireciona imediatamente após clicar no OK
                    alert('Cadastro realizado com sucesso!');
                    window.location.href = 'tela_login.php';
                </script>
            ";
        } else {
            echo "Erro ao cadastrar: " . $stmt->errorInfo();
        }

    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }

    // Fechando a conexão
    $pdo = null;
}
?>