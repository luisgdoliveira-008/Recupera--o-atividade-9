<?php

require_once "../config/database.php";

$erro = "";

$nome = "";
$categoria = "";
$descricao = "";
$preco = "";
$quantidade = "";
$validade = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim($_POST["nome"] ?? "");
    $categoria = trim($_POST["categoria"] ?? "");
    $descricao = trim($_POST["descricao"] ?? "");
    $preco = trim($_POST["preco"] ?? "");
    $quantidade = trim($_POST["quantidade"] ?? "");
    $validade = trim($_POST["validade"] ?? "");

    if (
        $nome === "" ||
        $categoria === "" ||
        $preco === "" ||
        $quantidade === "" ||
        $validade === ""
    ) {

        $erro = "Preencha todos os campos obrigatórios.";

    } elseif (mb_strlen($nome) > 150) {

        $erro = "O nome deve ter no máximo 150 caracteres.";

    } elseif (mb_strlen($categoria) > 100) {

        $erro = "A categoria deve ter no máximo 100 caracteres.";

    } elseif (!is_numeric($preco) || (float)$preco < 0) {

        $erro = "Informe um preço válido maior ou igual a zero.";

    } elseif (
        filter_var($quantidade, FILTER_VALIDATE_INT) === false ||
        (int)$quantidade < 0
    ) {

        $erro = "Informe uma quantidade inteira maior ou igual a zero.";

    } else {

        $dataValida = DateTime::createFromFormat(
            'Y-m-d',
            $validade
        );

        if (
            !$dataValida ||
            $dataValida->format('Y-m-d') !== $validade
        ) {

            $erro = "Informe uma data de validade válida.";

        } else {

            try {

                $sql = "INSERT INTO produtos
                        (
                            nome,
                            categoria,
                            descricao,
                            preco,
                            quantidade,
                            validade
                        )
                        VALUES
                        (
                            :nome,
                            :categoria,
                            :descricao,
                            :preco,
                            :quantidade,
                            :validade
                        )";

                $stmt = $pdo->prepare($sql);

                $stmt->execute([
                    ":nome" => $nome,
                    ":categoria" => $categoria,
                    ":descricao" => $descricao,
                    ":preco" => (float)$preco,
                    ":quantidade" => (int)$quantidade,
                    ":validade" => $validade
                ]);

                header("Location: index.php?sucesso=cadastrado");
                exit;

            } catch (PDOException $e) {

                $erro = "Não foi possível cadastrar o produto.";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastrar Produto</title>

    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="container">

    <h1>Cadastrar Produto</h1>

    <?php if ($erro !== ""): ?>

        <div class="erro">
            <?= htmlspecialchars(
                $erro,
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </div>

    <?php endif; ?>

    <form method="POST">

        <label for="nome">
            Nome:
        </label>

        <input
            type="text"
            id="nome"
            name="nome"
            maxlength="150"
            value="<?= htmlspecialchars(
                $nome,
                ENT_QUOTES,
                'UTF-8'
            ) ?>"
            required
        >

        <label for="categoria">
            Categoria:
        </label>

        <input
            type="text"
            id="categoria"
            name="categoria"
            maxlength="100"
            value="<?= htmlspecialchars(
                $categoria,
                ENT_QUOTES,
                'UTF-8'
            ) ?>"
            required
        >

        <label for="descricao">
            Descrição:
        </label>

        <textarea
            id="descricao"
            name="descricao"
        ><?= htmlspecialchars(
            $descricao,
            ENT_QUOTES,
            'UTF-8'
        ) ?></textarea>

        <label for="preco">
            Preço:
        </label>

        <input
            type="number"
            id="preco"
            name="preco"
            step="0.01"
            min="0"
            value="<?= htmlspecialchars(
                $preco,
                ENT_QUOTES,
                'UTF-8'
            ) ?>"
            required
        >

        <label for="quantidade">
            Quantidade:
        </label>

        <input
            type="number"
            id="quantidade"
            name="quantidade"
            min="0"
            value="<?= htmlspecialchars(
                $quantidade,
                ENT_QUOTES,
                'UTF-8'
            ) ?>"
            required
        >

        <label for="validade">
            Data de validade:
        </label>

        <input
            type="date"
            id="validade"
            name="validade"
            value="<?= htmlspecialchars(
                $validade,
                ENT_QUOTES,
                'UTF-8'
            ) ?>"
            required
        >

        <button type="submit">
            Cadastrar
        </button>

    </form>

    <a href="index.php">
        Voltar
    </a>

</div>

</body>
</html>