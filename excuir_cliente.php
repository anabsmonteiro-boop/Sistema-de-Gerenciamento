<?php
require_once 'config.php';

// 1. O "Caçador": Pega o ID que veio pela URL (pelo link)
$id = $_GET['id'] ?? null;

// 2. Se não tem ID, volta para a lista
if (!$id) {
    header('Location: clientes.php');
    exit;
}

// 3. A Confirmação: Para não apagar sem querer, vamos mostrar uma telinha
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Se o usuário clicou no botão "Confirmar", agora sim apagamos
    $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: clientes.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Cliente</title>
</head>
<body>
    <h1>Excluir Cliente</h1>
    <p>Tem certeza que deseja excluir o cliente #<?php echo $id; ?>?</p>

    <form method="POST">
        <button type="submit" style="background-color: red; color: white;">Sim, desejo excluir</button>
        <a href="clientes.php">Cancelar</a>
    </form>
</body>
</html>