<?php
// Credenciais que salvaste do TiDB Cloud
$host = "gateway01.ap-southeast-1.prod.alicloud.tidbcloud.com"; 
$banco = "test"; // O banco padrão onde criamos as tabelas
$usuario = "4AD79M25udvWBBf.root"; 
$senha = "ox5Jhw6PRooMOMGC"; // Substitua pela senha que copiaste do TiDB
$porta = 4000; 

try {
    $pdo = new PDO("mysql:host=$host;port=$porta;dbname=$banco;charset=utf8", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
