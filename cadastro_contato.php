<?php
// 17. Inclui a configuração do banco e o cabeçalho
require_once 'config.php';
// require_once 'cabecalho.php'; // Descomente se você já tiver esse arquivo criado

$erro = ""; // Variável para armazenar mensagens de validação

// 19. Processamento do formulário (Lógica de Inserção)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados e limpa espaços em branco
    $nome     = trim($_POST['nome']     ?? '');
    $email    = trim($_POST['email']    ?? '');
    $telefone = trim($_POST['telefone'] ?? '');

    // 20. Validação básica: Nome e E-mail são obrigatórios
    if ($nome && $email) {
        try {
            // Prepared Statement: Os "?" são espaços reservados (placeholders)
            $stmt = $pdo->prepare(
                'INSERT INTO contatos (nome, email, telefone) VALUES (?, ?, ?)'
            );
            
            // Os dados são enviados separadamente do comando SQL
            $stmt->execute([$nome, $email, $telefone]);

            // Redireciona para a listagem após o sucesso
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            $erro = "Erro ao salvar no banco: " . $e->getMessage();
        }
    } else {
        $erro = "Por favor, preencha os campos obrigatórios (Nome e E-mail).";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Contato</title>
    <style>
        .erro { color: red; font-weight: bold; }
        form { margin-top: 20px; }
        div { margin-bottom: 10px; }
        label { display: inline-block; width: 80px; }
    </style>
</head>
<body>

    <h1>Novo Contato</h1>

    <?php if ($erro): ?>
        <p class="erro"><?php echo $erro; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>
        </div>
        <div>
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone">
        </div>
        
        <button type="submit">Salvar Contato</button>
        <a href="index.php">Cancelar</a>
    </form>

</body>
</html>