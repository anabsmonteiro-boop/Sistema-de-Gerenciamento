<?php
require_once 'config.php';

$id = $_GET['id'] ?? null;
if (!$id) { header('Location: index.php'); exit; }

// Busca dados para mostrar na confirmação
$stmt = $pdo->prepare("SELECT nome FROM contatos WHERE id = ?");
$stmt->execute([$id]);
$contato = $stmt->fetch(PDO::FETCH_ASSOC);

// Se o formulário de confirmação foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("DELETE FROM contatos WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: index.php');
    exit;
}
?>

<h1>Excluir Contato</h1>
<p>Tem certeza que deseja excluir o contato <strong><?= htmlspecialchars($contato['nome']) ?></strong>?</p>

<form method="POST">
    <button type="submit" style="background:red; color:white;">Sim, Excluir</button>
    <a href="index.php">Cancelar</a>
</form>