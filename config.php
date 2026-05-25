<?php
// 1. Configurações de acesso
//O PDO::ERRMODE_SILENT esconde os erros por padrão, enquanto o 
//PDO::ERRMODE_EXCEPTION interrompe o código imediatamente disparando uma exceção

$host = 'localhost';      
$db   = 'agenda';    
$user = 'root';           
$pass = '';               

// 2. Data Source Name (DSN) - O "endereço" da conexão
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    // 3. Criando a instância do PDO
    $pdo = new PDO($dsn, $user, $pass);

    // 4. Configurando o modo de erro para EXCEPTION
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // 5. Tratamento em caso de falha
    echo "Erro na conexão: " . $e->getMessage();
}
?>