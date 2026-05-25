<?php
// 1. O "Importador": Trazemos as chaves e as ferramentas
require_once 'config.php';
require_once 'funcoes_clientes.php';

// 2. A "Chamada": Usamos a função para buscar a lista do banco
// Note que passamos o $pdo (a conexão) para dentro dela
$listaDeClientes = obterClientes($pdo);

// 3. O "Visual": HTML básico para a página não ficar feia
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Clientes</title>
</head>
<body>
    <h1>Painel de Clientes</h1>
    
    <a href="cadastro_cliente.php" style="margin-bottom: 20px; display: inline-block;">
        + Adicionar Novo Cliente
    </a>

    <?php 
    // 4. O "Show": Chamamos a função que desenha a tabela
    // Passamos a $listaDeClientes que acabamos de buscar
    exibirTabelaClientes($listaDeClientes); 
    ?>

</body>
</html>