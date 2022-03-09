<?php
# https://www.php.net/manual/pt_BR/security.database.sql-injection.php
# https://www.php.net/manual/pt_BR/language.variables.superglobals.php
# https://www.php.net/manual/en/function.filter-input.php
# https://www.php.net/manual/pt_BR/filter.filters.sanitize.php
# https://www.codetable.net/decimal/39
# https://www.techonthenet.com/unicode/chart.php
# https://owasp.org/

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $link = mysqli_connect('localhost', 'root', '', 'segver', 3306);
        mysqli_set_charset($link, "utf8");

        $usuario = filter_input(INPUT_POST, 'txtUsuario', FILTER_SANITIZE_SPECIAL_CHARS);
        $senha = filter_input(INPUT_POST, 'txtSenha', FILTER_SANITIZE_SPECIAL_CHARS);

        $query = "select usuario, senha from usuario where usuario='{$usuario}' and senha='{$senha}'";

        $result = mysqli_query($link, $query);
        $rows = mysqli_fetch_assoc($result);

        if ($rows) {
            echo "Logado com sucesso";
        } else {
            echo "Não logou. Tente novamente.";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>SEGVER - Exemplo de SQL Injection</title>
</head>

<body>
    <div class="container col-6">
        <fieldset>
            <legend>SQL Injection - Login de Usuário</legend>
            <form action="" method="post">
                <div class="form-group mb-3">
                    <label for="usuario_id" class="form-label">Usuário</label>
                    <input class="form-control" type="text" name="txtUsuario" id="usuario_id" placeholder="Informe o usuário" required>
                </div>
                <div class="form-group mb-3">
                    <label for="senha_id" class="form-label">Senha</label>
                    <input class="form-control" type="text" name="txtSenha" id="senha_id" placeholder="Informe a senha" required>
                </div>
                <button class="btn btn-dark" type="submit">Login</button>
            </form>
        </fieldset>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>