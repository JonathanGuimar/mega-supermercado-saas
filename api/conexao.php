<?php
// Oculta avisos de 'Deprecated' para não quebrar a renderização da página na Vercel
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 0);

// Credenciais dinâmicas (Tenta ler a Vercel; se não achar, usa o plano B)
$host = getenv('DB_HOST') ?: "gateway01.ap-southeast-1.prod.alicloud.tidbcloud.com";
$banco = getenv('DB_NAME') ?: "test";
$usuario = getenv('DB_USER') ?: "4AD79M25udvWBbf.root";
$senha = getenv('DB_PASSWORD') ?: "3rqS49iVjBUIzJdk";
$porta = getenv('DB_PORT') ?: 4000;

try {
    // Configuração de SSL compatível com o ambiente Vercel (PHP 8.5+)
    $opcoes = [
        defined('Pdo\Mysql::ATTR_SSL_CA') ? \Pdo\Mysql::ATTR_SSL_CA : PDO::MYSQL_ATTR_SSL_CA => true,
        defined('Pdo\Mysql::ATTR_SSL_VERIFY_SERVER_CERT') ? \Pdo\Mysql::ATTR_SSL_VERIFY_SERVER_CERT : PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
    ];

    $pdo = new PDO("mysql:host=$host;port=$porta;dbname=$banco;charset=utf8", $usuario, $senha, $opcoes);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Se ainda houver erro de conexão, exibe de forma limpa
    header("Content-Type: text/html; charset=UTF-8");
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
