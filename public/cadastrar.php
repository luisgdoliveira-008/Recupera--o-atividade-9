<?php

require_once "../config/database.php";

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim($_POST["nome"] ?? "");
    $categoria = trim($_POST["categoria"] ?? "");
    $descricao = trim($_POST["descricao"] ?? "");
    $preco = $_POST["preco"] ?? "";
    $quantidade = $_POST["quantidade"] ?? "";
    $validade = $_POST["validade"] ?? "";

    if (
        empty($nome) ||
        empty($categoria) ||
        $preco === "" ||
        $quantidade === "" ||
        empty($validade)
    ) {
        $erro = "Preencha todos os campos obrigatórios.";
    } elseif (!is_numeric($preco) || $preco < 0) {
        $erro = "Informe um preço válido.";
    } elseif (!filter_var($quantidade, FILTER_VALIDATE_INT) || $quantidade < 0) {
        $erro = "Informe uma quantidade válida.";
    } else {

        try {

            $sql = "INSERT INTO produtos
                    (nome, categoria, descricao, preco, quantidade, validade)
                    VALUES
                    (:nome, :categoria, :descricao, :preco, :quantidade, :validade)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ":nome" => $nome,
                ":categoria" => $categoria,
                ":descricao" => $descricao,
                ":preco" => $preco,
                ":quantidade" => $quantidade,
                ":validade" => $validade
            ]);

            header("Location: index.php");
            exit;

        } catch (PDOException $e) {
            $erro = "Não foi possível cadastrar o produto.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container">

    <h1>Cadastrar Produto</h1>

    <?php if ($erro): ?>
        <div class="erro">
            <?= htmlspecialchars($erro) ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <label>Nome:</label>
        <input type="text" name="nome" maxlength="150" required>

        <label>Categoria:</label>
        <input type="text" name="categoria" maxlength="100" required>

        <label>Descrição:</label>
        <textarea name="descricao"></textarea>

        <label>Preço:</label>
        <input type="number" name="preco" step="0.01" min="0" required>

        <label>Quantidade:</label>
        <input type="number" name="quantidade" min="0" required>

        <label>Data de validade:</label>
        <input type="date" name="validade" required>

        <button type="submit">Cadastrar</button>

    </form>

    <a href="index.php">Voltar</a>

</div>

</body>
</html>