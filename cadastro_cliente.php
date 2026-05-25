<?php
require_once 'config.php';

$erro = ""; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   // CORREÇÃO 1: Adicionado o _ no $_POST
   $nome      = trim($_POST['nome'] ?? '');
   $cpf       = trim($_POST['cpf'] ?? ''); 
   $email     = trim($_POST['email'] ?? '');
   $telefone  = trim($_POST['telefone'] ?? '');
   
   // CORREÇÃO 2: Trocado - por = e removido o cedilha da variável $endereco
   $endereco  = trim($_POST['endereco'] ?? '');

   if (strlen($cpf) !== 14) {
      $erro = "CPF inválido! Use o formato 000.000.000-00";
   } elseif ($nome && $email && $cpf) {
      $sql = "INSERT INTO clientes (nome, cpf, email, telefone, endereco) VALUES (?, ?, ?, ?, ?)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$nome, $cpf, $email, $telefone, $endereco]);

      // CORREÇÃO 3: Trocado Locations por Location
      header('Location: clientes.php');
      exit;
   } else {
      $erro = "Preencha Nome, CPF e E-mail";
   }
} // <--- O IF FECHA AQUI! O HTML fica livre depois disso.
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Cliente</title>
</head>
<body>
    <h1>Cadastrar Novo Cliente</h1>

    <?php if ($erro): ?>
        <p style="color: red;"><?php echo $erro; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" placeholder="Nome Completo" required><br><br>

        <label>CPF:</label><br>
        <input type="text" name="cpf" placeholder="000.000.000-00" maxlength="14" required><br><br>

        <label>E-mail:</label><br>
        <input type="email" name="email" placeholder="email@exemplo.com" required><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone" placeholder="(00) 00000-0000"><br><br>

        <label>Endereço:</label><br>
        <textarea name="endereco" placeholder="Rua, Número, Bairro..."></textarea><br><br>

        <button type="submit">Salvar Cliente</button>
        <a href="clientes.php">Cancelar</a>
    </form>
</body>
</html>