<?php
// index.php — página principal

require_once "config.php";    // erro fatal se não encontrar
include      "cabecalho.php"; // warning se não encontrar
include_once "funcoes.php";   // inclui apenas uma vez

$contatos = obterContatos();
exibirTabelaContatos($contatos);
?>

<a href="cadastro_contato.php" style="display: inline-block; margin-bottom: 20px; padding: 10px; background: #28a745; color: white; text-decoration: none; border-radius: 5px;">
    + Adicionar Novo Contato
</a>

</body>
</html>
