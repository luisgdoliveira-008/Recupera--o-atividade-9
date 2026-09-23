<?php

require_once "../config/database.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("Produto inválido.");
}

$stmt = $pdo->prepare(
    "SELECT * FROM produtos WHERE id = :id"
);

$stmt->execute([
    ":id" => $id
]);

$produto = $stmt->fetch();

if (!$produto) {
    die("Produto não encontrado.");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>Visualizar Produto</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

    <h1><?= htmlspecialchars($produto["nome"]) ?></h1>

    <p>
        <strong>Categoria:</strong>
        <?= htmlspecialchars($produto["categoria"]) ?>
    </p>

    <p>
        <strong>Descrição:</strong>
        <?= htmlspecialchars($produto["descricao"]) ?>
    </p>

    <p>
        <strong>Preço:</strong>
        R$ <?= number_format($produto["preco"], 2, ",", ".") ?>
    </p>

    <p>
        <strong>Quantidade:</strong>
        <?= htmlspecialchars($produto["quantidade"]) ?>
    </p>

    <p>
        <strong>Validade:</strong>
        <?= date("d/m/Y", strtotime($produto["validade"])) ?>
    </p>

    <a href="editar.php?id=<?= $produto["id"] ?>">
        Editar
    </a>

    <a href="index.php">
        Voltar
    </a>

</div>

</body>

</html>