<?php require_once('./CityRepository.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Listagem de clientes</title>
</head>

<body>
    <?php include "./navbar.php" ?>
    <div class="container">
        <table class="table table-stripped">
            <thead>
                <th>#</th>
                <th>Cidade</th>
                <th>UF</th>
            </thead>
            <tbody>
                <?php foreach (get() as $cidade) : ?>
                    <tr>
                        <td><?= $cidade->cod_cidade ?></td>
                        <td><?= $cidade->nome_cidade ?></td>
                        <td><?= $cidade->sigla_uf ?></td>
                        <td>
                            <a href="cidade.form.edit.php?codigo=<?= $cidade->cod_cidade ?>"><span style="color: green;"><i class="fa-solid fa-pen-to-square"></i></span></a>
                            <a href="cidade.delete.php?codigo=<?= $cidade->cod_cidade ?>" onclick="return confirm('Deseja realmente remover a cidade <?= $cidade->nome_cidade ?> ?')"><span style="color: red;"><i class="fa-solid fa-eraser"></i></span></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>