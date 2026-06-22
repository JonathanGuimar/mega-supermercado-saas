<?php
// Credenciais do TiDB Cloud
$host = "gateway01.ap-southeast-1.prod.alicloud.tidbcloud.com"; 
$banco = "test"; // Certifique-se de que o nome do banco criado no console do TiDB é "test"
$usuario = "4AD79M25udvWBbf.root"; 
$senha = "ox5Jhw6PRooMOMGC"; // Substitua pela senha real que você copiou do TiDB
$porta = 4000; 

try {
    // Sintaxe atualizada para evitar os avisos de "Deprecated"
    $opcoes = [
        PDO::Pdo\Mysql::ATTR_SSL_CA => true,
        PDO::Pdo\Mysql::ATTR_SSL_VERIFY_SERVER_CERT => false
    ];

    $pdo = new PDO("mysql:host=$host;port=$porta;dbname=$banco;charset=utf8", $usuario, $senha, $opcoes);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
