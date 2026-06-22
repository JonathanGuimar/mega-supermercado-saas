<?php
// Credenciais reais do seu TiDB Cloud
$host = "gateway01.ap-southeast-1.prod.alicloud.tidbcloud.com"; 
$banco = "mega_supermercado"; 
$usuario = "4AD79M25udvWBbf.root"; 
$senha = "ox5Jhw6PRooMOMGC"; 
$porta = 4000; 

try {
    // Configuração obrigatória para o TiDB aceitar a conexão segura na Vercel
    $opcoes = [
        PDO::MYSQL_ATTR_SSL_CA => true,
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
    ];

    $pdo = new PDO("mysql:host=$host;port=$porta;dbname=$banco;charset=utf8", $usuario, $senha, $opcoes);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
