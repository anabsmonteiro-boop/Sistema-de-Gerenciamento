<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome    = trim($_POST['nome']);
    $preco   = (float)$_POST['preco']; // Converte para número decimal
    $estoque = (int)$_POST['estoque']; // Converte para número inteiro
    $nomeArquivo = null; // Padrão se não houver imagem

    // Validações (Tarefa 38)
    if ($preco <= 0) {
        $erro = "O preço deve ser positivo!";
    } elseif ($estoque < 0) {
        $erro = "O estoque não pode ser negativo!";
    } else {
        // Processamento da Imagem (Tarefa 36)
        if (!empty($_FILES['imagem']['name'])) {
            $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
            $permitidos = ['jpg', 'jpeg', 'png', 'webp'];

            if (in_array($extensao, $permitidos)) {
                $nomeArquivo = uniqid('prod_') . '.' . $extensao;
                
                // Cria a pasta se não existir (Tarefa 37)
                if (!is_dir('uploads')) { mkdir('uploads', 0777, true); }
                
                move_uploaded_file($_FILES['imagem']['tmp_name'], 'uploads/' . $nomeArquivo);
            }
        }

        // Salva no banco
        $sql = "INSERT INTO produtos (nome, preco, estoque, imagem) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $preco, $estoque, $nomeArquivo]);
        header('Location: produtos.php');
        exit;
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="nome" placeholder="Nome do Produto" required><br>
    <input type="number" name="preco" step="0.01" placeholder="Preço (ex: 10.50)" required><br>
    <input type="number" name="estoque" placeholder="Qtd em estoque" required><br>
    <input type="file" name="imagem" accept="image/*"><br>
    <button type="submit">Cadastrar Produto</button>
</form>