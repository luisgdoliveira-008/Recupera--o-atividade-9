<?php

require_once "../config/database.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("Produto inválido.");
}

try {

    $sql = "DELETE FROM produtos WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":id" => $id
    ]);

    header("Location: index.php");
    exit;

} catch (PDOException $e) {

    die("Não foi possível excluir o produto.");
}

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":id" => $id
]);