CREATE DATABASE IF NOT EXISTS mercado_estoque
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE mercado_estoque;

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT NOT NULL DEFAULT 0,
    validade DATE NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO produtos
(nome, categoria, descricao, preco, quantidade, validade)
VALUES
('Arroz 5kg', 'Alimentos',
 'Arroz branco tipo 1', 25.90, 50, '2027-05-20'),

('Feijão 1kg', 'Alimentos',
 'Feijão carioca', 8.50, 80, '2027-03-15'),

('Leite 1L', 'Bebidas',
 'Leite integral', 5.49, 30, '2026-10-10');