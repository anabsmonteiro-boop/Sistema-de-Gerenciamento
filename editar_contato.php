<?php
require_once 'config.php';

$id = $_GET['id'] ?? null;
if (!$id) { header('Location: index.php'); exit; }

// Busca os dados atuais do contato
$stmt = $pdo->prepare("SELECT * FROM contatos WHERE id = ?");
$stmt->execute([$id]);
$contato = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$contato) { die("Contato não encontrado."); }

// Processa a atualização (UPDATE)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');

    if ($nome && $email) {
        $sql = "UPDATE contatos SET nome = ?, email = ?, telefone = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $email, $telefone, $id]);
        header('Location: index.php');
        exit;
    }
}
?>

<h1>Editar Contato</h1>
<form method="POST">
    <input type="text" name="nome" value="<?= htmlspecialchars($contato['nome']) ?>" required><br>
    <input type="email" name="email" value="<?= htmlspecialchars($contato['email']) ?>" required><br>
    <input type="text" name="telefone" value="<?= htmlspecialchars($contato['telefone']) ?>"><br>
    <button type="submit">Salvar Alterações</button>
    <a href="index.php">Cancelar</a>
</form>