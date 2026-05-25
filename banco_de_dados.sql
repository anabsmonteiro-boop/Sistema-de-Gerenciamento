CREATE DATABASE IF NOT EXISTS agenda
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE agenda;

-- Tabela de Contatos
CREATE TABLE contatos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telefone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de Clientes (com CPF único)
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) UNIQUE NOT NULL,
    email VARCHAR(100),
    telefone VARCHAR(20),
    endereco TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de Produtos
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL,
    estoque INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserindo em Contatos
INSERT INTO contatos (nome, email, telefone) VALUES 
('João Silva', 'joao@email.com', '(11) 99999-1111'),
('Maria Souza', 'maria@email.com', '(11) 98888-2222'),
('Carlos Lima', 'carlos@email.com', '(11) 97777-3333');

-- Inserindo em Clientes
INSERT INTO clientes (nome, cpf, email, telefone, endereco) VALUES 
('Empresa A', '123.456.789-00', 'contato@empresa-a.com', '3301-1010', 'Rua das Flores, 123'),
('Ana Paula', '987.654.321-11', 'ana.paula@email.com', '3302-2020', 'Av. Central, 456'),
('Pedro Rocha', '111.222.333-44', 'pedro@email.com', '3303-3030', 'Rua do Porto, 789');

-- Inserindo em Produtos
INSERT INTO produtos (nome, descricao, preco, estoque) VALUES 
('Notebook', 'Intel i7, 16GB RAM, SSD 512GB', 4500.00, 10),
('Mouse Sem Fio', 'Mouse óptico ergonômico', 89.90, 50),
('Monitor 24"', 'Full HD, 75Hz', 850.00, 15);

SELECT * FROM contatos;
SELECT * FROM clientes;
SELECT * FROM produtos;

ALTER TABLE produtos ADD COLUMN imagem VARCHAR(255) NULL;