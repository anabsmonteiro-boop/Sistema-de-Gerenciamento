<?php
// funcoes_clientes.php

function obterClientes(PDO $pdo): array {
    try {
        $sql = "SELECT id, nome, cpf, email, telefone, endereco FROM clientes";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao buscar clientes: " . $e->getMessage());
        return [];
    } 
} // <--- A função de busca FECHA aqui.

function exibirTabelaClientes(array $clientes): void {
    if (empty($clientes)) {
        echo "<p>Nenhum cliente cadastrado.</p>";
        return; // <--- Faltou o ponto e vírgula aqui
    }

    echo "<table border='1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>"; 

    foreach ($clientes as $cliente) {
        $id   = $cliente['id'];
        $nome = htmlspecialchars($cliente['nome']);
        $cpf  = htmlspecialchars($cliente['cpf']);
        
        echo "<tr>
                <td>{$id}</td>
                <td>{$nome}</td>
                <td>{$cpf}</td>
                <td>
                    <a href='editar_cliente.php?id={$id}'>Editar</a> |
                    <a href='excluir_cliente.php?id={$id}'>Excluir</a>
                </td>
              </tr>";
    }
    
    echo "    </tbody>
          </table>";
} 