<?php

require_once "../config/database.php";

$id = filter_input(
    INPUT_GET,
    "id",
    FILTER_VALIDATE_INT
);

if (
    $id === false ||
    $id === null ||
    $id <= 0
) {

    die("Produto inválido.");
}

try {

    $stmt = $pdo->prepare(
        "SELECT * FROM produtos WHERE id = :id"
    );

    $stmt->execute([
        ":id" => $id
    ]);

    $produto = $stmt->fetch();

} catch (PDOException $e) {

    die("Erro ao consultar o produto.");
}

if (!$produto) {

    die("Produto não encontrado.");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Visualizar Produto</title>

    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="container">

    <h1>
        <?= htmlspecialchars(
            $produto["nome"],
            ENT_QUOTES,
            'UTF-8'
        ) ?>
    </h1>

    <p>
        <strong>Categoria:</strong>

        <?= htmlspecialchars(
            $produto["categoria"],
            ENT_QUOTES,
            'UTF-8'
        ) ?>
    </p>

    <p>
        <strong>Descrição:</strong>

        <?= htmlspecialchars(
            $produto["descricao"] ?? "",
            ENT_QUOTES,
            'UTF-8'
        ) ?>
    </p>

    <p>
        <strong>Preço:</strong>

        R$ <?= number_format(
            (float)$produto["preco"],
            2,
            ",",
            "."
        ) ?>
    </p>

    <p>
        <strong>Quantidade:</strong>

        <?= (int)$produto["quantidade"] ?>
    </p>

    <p>
        <strong>Validade:</strong>

        <?= date(
            "d/m/Y",
            strtotime($produto["validade"])
        ) ?>
    </p>

    <a
        class="botao"
        href="editar.php?id=<?= (int)$produto["id"] ?>"
    >
        Editar
    </a>

    <a href="index.php">
        Voltar
    </a>

</div>

</body>
</html>