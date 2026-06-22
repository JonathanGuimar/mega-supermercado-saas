<?php
// Credenciais do TiDB Cloud
$host = "gateway01.ap-southeast-1.prod.alicloud.tidbcloud.com"; 
$banco = "test"; // Mudamos para 'test' que já vem criado por padrão no TiDB
$usuario = "4AD79M25udvWBbf.root"; 
$senha = "ox5Jhw6PRooMOMGC"; 
$porta = 4000; 

try {
    // Usando os números diretos (1007 e 1008) sumimos com os avisos de "Deprecated"
    $opcoes = [
        1007 => true,  // PDO::MYSQL_ATTR_SSL_CA
        1008 => false  // PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT
    ];

    $pdo = new PDO("mysql:host=$host;port=$porta;dbname=$banco;charset=utf8", $usuario, $senha, $opcoes);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
