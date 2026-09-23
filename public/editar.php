<?php

require_once "../config/database.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("Produto inválido.");
}

$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
$stmt->execute([":id" => $id]);

$produto = $stmt->fetch();

if (!$produto) {
    die("Produto não encontrado.");
}

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

        $erro = "Preço inválido.";

    } elseif (!filter_var($quantidade, FILTER_VALIDATE_INT) || $quantidade < 0) {

        $erro = "Quantidade inválida.";

    } else {

        try {

            $sql = "UPDATE produtos SET
                    nome = :nome,
                    categoria = :categoria,
                    descricao = :descricao,
                    preco = :preco,
                    quantidade = :quantidade,
                    validade = :validade
                    WHERE id = :id";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ":nome" => $nome,
                ":categoria" => $categoria,
                ":descricao" => $descricao,
                ":preco" => $preco,
                ":quantidade" => $quantidade,
                ":validade" => $validade,
                ":id" => $id
            ]);

            header("Location: index.php");
            exit;

        } catch (PDOException $e) {

            $erro = "Erro ao atualizar o produto.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <title>Editar Produto</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

    <h1>Editar Produto</h1>

    <?php if ($erro): ?>

        <div class="erro">
            <?= htmlspecialchars($erro) ?>
        </div>

    <?php endif; ?>

    <form method="POST">

        <label>Nome:</label>

        <input
            type="text"
            name="nome"
            value="<?= htmlspecialchars($produto["nome"]) ?>"
            required
        >

        <label>Categoria:</label>

        <input
            type="text"
            name="categoria"
            value="<?= htmlspecialchars($produto["categoria"]) ?>"
            required
        >

        <label>Descrição:</label>

        <textarea name="descricao"><?= htmlspecialchars($produto["descricao"]) ?></textarea>

        <label>Preço:</label>

        <input
            type="number"
            name="preco"
            step="0.01"
            min="0"
            value="<?= htmlspecialchars($produto["preco"]) ?>"
            required
        >

        <label>Quantidade:</label>

        <input
            type="number"
            name="quantidade"
            min="0"
            value="<?= htmlspecialchars($produto["quantidade"]) ?>"
            required
        >

        <label>Validade:</label>

        <input
            type="date"
            name="validade"
            value="<?= htmlspecialchars($produto["validade"]) ?>"
            required
        >

        <button type="submit">
            Salvar alterações
        </button>

    </form>

    <a href="index.php">Voltar</a>

</div>

</body>

</html>