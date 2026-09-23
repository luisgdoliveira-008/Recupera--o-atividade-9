<?php

require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: index.php");
    exit;
}

$id = filter_input(
    INPUT_POST,
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
        "DELETE FROM produtos WHERE id = :id"
    );

    $stmt->execute([
        ":id" => $id
    ]);

    header(
        "Location: index.php?sucesso=excluido"
    );

    exit;

} catch (PDOException $e) {

    die("Não foi possível excluir o produto.");
}