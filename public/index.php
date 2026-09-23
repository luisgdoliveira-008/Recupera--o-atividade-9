<?php

require_once "../config/database.php";

try {
    $stmt = $pdo->prepare("SELECT * FROM produtos ORDER BY id DESC");
    $stmt->execute();

    $produtos = $stmt->fetchAll();

} catch (PDOException $e) {
    die("Erro ao carregar os produtos.");
}

$mensagem = "";

switch ($_GET["sucesso"] ?? "") {

    case "cadastrado":
        $mensagem = "Produto cadastrado com sucesso.";
        break;

    case "editado":
        $mensagem = "Produto atualizado com sucesso.";
        break;

    case "excluido":
        $mensagem = "Produto excluído com sucesso.";
        break;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestão de Estoque</title>

    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="container">

    <h1>Gestão de Estoque</h1>

    <?php if ($mensagem !== ""): ?>

        <div class="sucesso">
            <?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') ?>
        </div>

    <?php endif; ?>

    <a class="botao" href="cadastrar.php">
        + Cadastrar Produto
    </a>

    <?php if (count($produtos) === 0): ?>

        <p>Nenhum produto cadastrado.</p>

    <?php else: ?>

        <div class="tabela-responsiva">

            <table>

                <thead>

                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Validade</th>
                    <th>Ações</th>
                </tr>

                </thead>

                <tbody>

                <?php foreach ($produtos as $produto): ?>

                    <tr>

                        <td>
                            <?= (int)$produto["id"] ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $produto["nome"],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $produto["categoria"],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </td>

                        <td>
                            R$ <?= number_format(
                                (float)$produto["preco"],
                                2,
                                ",",
                                "."
                            ) ?>
                        </td>

                        <td>
                            <?= (int)$produto["quantidade"] ?>
                        </td>

                        <td>
                            <?= date(
                                "d/m/Y",
                                strtotime($produto["validade"])
                            ) ?>
                        </td>

                        <td class="acoes">

                            <a href="visualizar.php?id=<?= (int)$produto["id"] ?>">
                                Visualizar
                            </a>

                            <a href="editar.php?id=<?= (int)$produto["id"] ?>">
                                Editar
                            </a>

                            <form
                                method="POST"
                                action="excluir.php"
                                class="form-excluir"
                                onsubmit="return confirm('Deseja realmente excluir este produto?');"
                            >

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= (int)$produto["id"] ?>"
                                >

                                <button
                                    type="submit"
                                    class="link-excluir"
                                >
                                    Excluir
                                </button>

                            </form>

                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php endif; ?>

</div>

</body>
</html>