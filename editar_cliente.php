<?php
require_once 'config.php';

// 1. Pega o ID do cliente que queremos editar
$id = $_GET['id'] ?? null;
if (!$id) { header('Location: clientes.php'); exit; }

// 2. Busca os dados atuais dele para preencher o formulário
$stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = ?");
$stmt->execute([$id]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cliente) { die("Cliente não encontrado!"); }

$erro = "";

// 3. O "Atualizador": Quando o botão é clicado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome'] ?? '');
    $cpf      = trim($_POST['cpf'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');

    if (strlen($cpf) !== 14) {
        $erro = "CPF deve ter 14 caracteres.";
    } elseif ($nome && $email) {
        // Comando UPDATE: "Atualize clientes, mude o nome para X... onde o ID for Y"
        $sql = "UPDATE clientes SET nome = ?, cpf = ?, email = ?, telefone = ?, endereco = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $cpf, $email, $telefone, $endereco, $id]);

        header('Location: clientes.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
</head>
<body>
    <h1>Editar Cliente</h1>

    <?php if ($erro): ?>
        <p style="color: red;"><?php echo $erro; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($cliente['nome']); ?>" required><br><br>

        <label>CPF:</label><br>
        <input type="text" name="cpf" value="<?php echo htmlspecialchars($cliente['cpf']); ?>" required><br><br>

        <label>E-mail:</label><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($cliente['email']); ?>" required><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone" value="<?php echo htmlspecialchars($cliente['telefone']); ?>"><br><br>

        <label>Endereço:</label><br>
        <textarea name="endereco"><?php echo htmlspecialchars($cliente['endereco']); ?></textarea><br><br>

        <button type="submit">Atualizar Dados</button>
        <a href="clientes.php">Cancelar</a>
    </form>
</body>
</html>