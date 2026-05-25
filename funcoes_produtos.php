<?php
function obterProdutos(PDO $pdo): array {
    $stmt = $pdo->query("SELECT * FROM produtos");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function exibirTabelaProdutos(array $produtos): void {
    echo "<table border='1'>
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                </tr>
            </thead>
            <tbody>";
    foreach ($produtos as $p) {
        // Formata o preço: 2 casas decimais, vírgula nos decimais e ponto nos milhares
        $precoFormatado = "R$ " . number_format($p['preco'], 2, ',', '.');
        $caminhoImagem = !empty($p['imagem']) ? 'uploads/' . $p['imagem'] : 'placeholder.png';

        echo "<tr>
                <td><img src='{$caminhoImagem}' width='50'></td>
                <td>" . htmlspecialchars($p['nome']) . "</td>
                <td>{$precoFormatado}</td>
                <td>{$p['estoque']} un.</td>
              </tr>";
    }
    echo "</tbody></table>";
}