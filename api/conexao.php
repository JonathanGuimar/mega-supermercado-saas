<?php
// Oculta avisos de 'Deprecated' para não quebrar a renderização da página na Vercel
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 0);

// Credenciais do TiDB Cloud atualizadas
$host = "gateway01.ap-southeast-1.prod.alicloud.tidbcloud.com"; 
$banco = "test"; // Base padrão criada automaticamente pelo TiDB
$usuario = "4AD79M25udvWBbf.root"; 
$senha = "4owCBz1ZVlUYOB9P"; // Sua nova senha resetada
$porta = 4000; 

try {
    // Configuração de SSL compatível com o ambiente Vercel
    $opcoes = [
        PDO::MYSQL_ATTR_SSL_CA => true,
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
    ];

    $pdo = new PDO("mysql:host=$host;port=$porta;dbname=$banco;charset=utf8", $usuario, $senha, $opcoes);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Se ainda houver erro de conexão, exibe de forma limpa
    header("Content-Type: text/html; charset=UTF-8");
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
