# Sistema de Gestão de Estoque

## Objetivo

O Sistema de Gestão de Estoque foi desenvolvido para auxiliar um mercado no controle de seus produtos.

O sistema permite cadastrar, visualizar, editar e excluir produtos do estoque, armazenando informações como nome, categoria, descrição, preço, quantidade disponível e data de validade.

## Tecnologias utilizadas

* PHP 8+
* MySQL
* HTML5
* CSS3
* PDO
* Prepared Statements
* Git e GitHub

## Requisitos

Para executar o projeto é necessário ter:

* PHP 8 ou superior
* MySQL
* Apache ou outro servidor compatível com PHP
* XAMPP, WAMP ou ambiente equivalente

## Instalação

### 1. Clonar o projeto

```bash
git clone URL_DO_REPOSITORIO
```

### 2. Colocar o projeto no servidor

No XAMPP, coloque a pasta do projeto dentro de:

```text
htdocs/
```

### 3. Criar o banco de dados

Acesse o phpMyAdmin e execute o arquivo:

```text
database/banco.sql
```

O arquivo criará o banco:

```text
mercado_estoque
```

e a tabela:

```text
produtos
```

### 4. Configurar a conexão

Abra:

```text
config/database.php
```

e configure:

```php
$host = "localhost";
$dbname = "mercado_estoque";
$user = "root";
$password = "";
```

Altere os dados caso o seu ambiente utilize outro usuário ou senha.

## Funcionalidades

### Cadastrar produto

Permite inserir um novo produto informando:

* Nome
* Categoria
* Descrição
* Preço
* Quantidade
* Data de validade

### Listar produtos

Exibe todos os produtos cadastrados no banco de dados.

### Visualizar produto

Permite consultar detalhadamente as informações de um produto.

### Editar produto

Permite alterar os dados de um produto já cadastrado.

### Excluir produto

Permite remover um produto do estoque após confirmação.

## Segurança

As operações no banco de dados utilizam PDO e Prepared Statements.

Exemplo:

```php
$stmt = $pdo->prepare(
    "SELECT * FROM produtos WHERE id = :id"
);

$stmt->execute([
    ":id" => $id
]);
```

Os dados apresentados na página também utilizam `htmlspecialchars()` para reduzir riscos de XSS.

O sistema realiza validações dos dados recebidos antes de realizar operações no banco.

## Estrutura do projeto

```text
sistema-estoque/
│
├── config/
│   └── database.php
│
├── public/
│   ├── index.php
│   ├── cadastrar.php
│   ├── editar.php
│   ├── excluir.php
│   ├── visualizar.php
│   └── css/
│       └── style.css
│
├── includes/
│   ├── header.php
│   ├── footer.php
│   └── mensagens.php
│
├── database/
│   └── banco.sql
│
├── docs/
│   ├── caso-de-uso.md
│   └── diagrama-caso-de-uso.png
│
└── README.md
```

## Banco de dados

### Tabela produtos

| Campo      | Tipo          | Descrição             |
| ---------- | ------------- | --------------------- |
| id         | INT           | Identificador único   |
| nome       | VARCHAR(150)  | Nome do produto       |
| categoria  | VARCHAR(100)  | Categoria             |
| descricao  | TEXT          | Descrição             |
| preco      | DECIMAL(10,2) | Preço do produto      |
| quantidade | INT           | Quantidade em estoque |
| validade   | DATE          | Data de validade      |
| criado_em  | TIMESTAMP     | Data de cadastro      |

## Documentação

A documentação dos casos de uso está disponível em:

```text
docs/caso-de-uso.md
```

O diagrama de casos de uso está disponível em:

```text
docs/diagrama-caso-de-uso.png
```

## Autor

Projeto desenvolvido como atividade de recuperação da disciplina de desenvolvimento de sistemas em PHP.
