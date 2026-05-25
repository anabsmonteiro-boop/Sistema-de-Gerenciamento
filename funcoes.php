<?php
// funcoes.php — funções reutilizáveis

// 1. Importa o seu arquivo de conexão
require_once 'config.php'; 

/**
 * Retorna o array de contatos buscando do banco de dados 'agenda'.
 */
function obterContatos(): array {
    // Acessa a variável $pdo que foi criada dentro do config.php
    global $pdo; 

    try {
        // Consulta os dados na tabela 'contatos'
        $stmt = $pdo->query("SELECT id, nome, email, telefone FROM contatos");
        
        // Retorna os dados como um array associativo (chave => valor)
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        // Caso haja erro no banco (ex: tabela não existe), loga o erro e retorna vazio
        error_log("Erro ao buscar contatos: " . $e->getMessage());
        return [];
    }
}

/**
 * Renderiza a tabela HTML com a lista de contatos.
 */
function exibirTabelaContatos(array $contatos): void {
    if (empty($contatos)) {
        echo "<p>Nenhum contato encontrado.</p>";
        return;
    }

    echo "<table>\n";
    echo "  <thead>\n";
    // Adicionamos a coluna "Ações"
    echo "    <tr><th>#</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Ações</th></tr>\n";
    echo "  </thead>\n";
    echo "  <tbody>\n";

    foreach ($contatos as $indice => $contato) {
        $num   = $indice + 1;
        $id    = $contato['id']; // Certifique-se de que o SELECT no obterContatos inclua o 'id'
        $nome  = htmlspecialchars($contato['nome']);
        $email = htmlspecialchars($contato['email']);
        $fone  = htmlspecialchars($contato['telefone']);

        echo "    <tr>\n";
        echo "      <td>{$num}</td>\n";
        echo "      <td>{$nome}</td>\n";
        echo "      <td>{$email}</td>\n";
        echo "      <td>{$fone}</td>\n";
        echo "      <td>
                      <a href='editar_contato.php?id={$id}'>Editar</a> | 
                      <a href='excluir_contato.php?id={$id}' style='color:red;'>Excluir</a>
                    </td>\n";
        echo "    </tr>\n";
    }
    echo "  </tbody>\n";
    echo "</table>\n";
}