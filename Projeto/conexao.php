<?php
// Configuração do banco de dados
$host = getenv('DB_HOST') ?: 'localhost';
$db   = getenv('DB_NAME') ?: 'projeto';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

// Opções do PDO para melhor segurança e performance
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // Testa a conexão
    $pdo->query("SELECT 1");
    
} catch (PDOException $e) {
    // Log do erro (em produção, não mostre detalhes)
    error_log("Erro na conexão com banco: " . $e->getMessage());
    
    // Em desenvolvimento, mostra o erro
    if (getenv('APP_ENV') === 'development') {
        die("Erro na conexão: " . $e->getMessage());
    } else {
        die("Erro interno do servidor. Tente novamente mais tarde.");
    }
}

// Função para testar conexão
function testConnection() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT 1");
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>