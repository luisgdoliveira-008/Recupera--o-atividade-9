<?php

require_once "../config/database.php";

try {

    $sql = "SELECT * FROM produtos ORDER BY id DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $produtos = $stmt->fetchAll();

} catch (PDOException $e) {

    die("Erro ao carregar os produtos.");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>Gestão de Estoque</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

    <h1>Gestão de Estoque</h1>

    <a class="botao" href="cadastrar.php">
        + Cadastrar Produto
    </a>

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
                    <?= htmlspecialchars($produto["id"]) ?>
                </td>

                <td>
                    <?= htmlspecialchars($produto["nome"]) ?>
                </td>

                <td>
                    <?= htmlspecialchars($produto["categoria"]) ?>
                </td>

                <td>
                    R$ <?= number_format($produto["preco"], 2, ",", ".") ?>
                </td>

                <td>
                    <?= htmlspecialchars($produto["quantidade"]) ?>
                </td>

                <td>
                    <?= date("d/m/Y", strtotime($produto["validade"])) ?>
                </td>

                <td>

                    <a href="visualizar.php?id=<?= $produto["id"] ?>">
                        Visualizar
                    </a>

                    <a href="editar.php?id=<?= $produto["id"] ?>">
                        Editar
                    </a>

                    <a href="excluir.php?id=<?= $produto["id"] ?>"
                       onclick="return confirm('Deseja realmente excluir este produto?');">
                        Excluir
                    </a>

                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>

</body>
</html>