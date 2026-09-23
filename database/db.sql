CREATE DATABASE IF NOT EXISTS mercado_estoque
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE mercado_estoque;

CREATE TABLE IF NOT EXISTS produtos (
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

SELECT
'Arroz 5kg',
'Alimentos',
'Arroz branco tipo 1',
25.90,
50,
'2027-05-20'

WHERE NOT EXISTS (
    SELECT 1
    FROM produtos
    WHERE nome = 'Arroz 5kg'
);


INSERT INTO produtos
(nome, categoria, descricao, preco, quantidade, validade)

SELECT
'Feijão 1kg',
'Alimentos',
'Feijão carioca',
8.50,
80,
'2027-03-15'

WHERE NOT EXISTS (
    SELECT 1
    FROM produtos
    WHERE nome = 'Feijão 1kg'
);


INSERT INTO produtos
(nome, categoria, descricao, preco, quantidade, validade)

SELECT
'Leite 1L',
'Bebidas',
'Leite integral',
5.49,
30,
'2026-10-10'

WHERE NOT EXISTS (
    SELECT 1
    FROM produtos
    WHERE nome = 'Leite 1L'
);