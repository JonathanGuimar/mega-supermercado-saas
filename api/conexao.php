<?php
// Credenciais do TiDB Cloud
$host = "gateway01.ap-southeast-1.prod.alicloud.tidbcloud.com"; 
$banco = "test"; 
$usuario = "4AD79M25udvWBbf.root"; 
$senha = "ox5Jhw6PRooMOMGC"; 
$porta = 4000; 

try {
    // Compatibilidade universal para o SSL na Vercel sem gerar avisos de Deprecated
    $opcoes = [
        "mysql_attr_ssl_ca" => true,
        "mysql_attr_ssl_verify_server_cert" => false
    ];

    $pdo = new PDO("mysql:host=$host;port=$porta;dbname=$banco;charset=utf8", $usuario, $senha, $opcoes);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
