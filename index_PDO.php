<?php
    define("HOST", "localhost");
    define("USER" , "root");
    define("PASS" , "");
    define("DATABASE" , "segver");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $key = 'strval';
        $con = new PDO("mysql:host={$key(HOST)};dbname={$key(DATABASE)}", USER, PASS) or die("Erro ao tentar conectar no banco de dados");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $usuario = filter_input(INPUT_POST, 'txtUsuario');
        $senha =filter_input(INPUT_POST, 'txtSenha');

        $stmt = $con->prepare("select usuario, senha from usuario where usuario= :usuario and senha= :senha");
        $stmt->bindParam(":usuario", $usuario);
        $stmt->bindParam(":senha", $senha);

        $stmt->execute();

        if ($stmt->rowCount()) {
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