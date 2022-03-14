<?php
    require_once('./CityRepository.php');
    $cidade = findById($_GET["codigo"]);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Loja Senac - Formulário de Cadastro de Cidades</title>
</head>

<body>
    <?php include "./navbar.php" ?>
    <div class="container col-6">
        <fieldset>
            <legend>Cadastro de Cidade</legend>
            <form action="./cidade.edit.php" method="post">
                <div class="form-group mb-3">
                    <label for="cidade_id" class="form-label">Nome da cidade</label>
                    <input class="form-control" value="<?= $cidade->nome_cidade ?>" type="text" name="txtCidade" id="cidade_id" placeholder="Informe o nome da cidade" required>
                </div>
                <div class="form-group mb-3">
                    <label for="uf_id" class="form-label">UF da cidade</label>
                    <input class="form-control" value="<?= $cidade->sigla_uf ?>" type="text" name="txtUf" id="uf_id" placeholder="Informe o UF da cidade" required>
                </div>
                <button class="btn btn-dark" value="<?= $cidade->cod_cidade ?>" name="txtCodigo" type="submit">Editar</button>
            </form>
        </fieldset>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>