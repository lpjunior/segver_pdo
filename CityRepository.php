<?php

    require_once './Connection.php';

    function create($cidade)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("INSERT INTO cidade(nome_cidade, sigla_uf) VALUES (:nome, :uf)");

            $stmt->bindParam(":uf", $cidade->uf);
            $stmt->bindParam(":nome", $cidade->nome);

            if ($stmt->execute())
                echo "Cidade cadastrada com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao cadastrar a cidade. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

    function get()
    {
        try {
            $con = getConnection();

            $rs = $con->query("SELECT nome_cidade, sigla_uf FROM cidade");

            while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
                echo $row->nome_cidade . "<br>";
                echo $row->sigla_uf . "<br>";
            }
        } catch (PDOException $error) {
            echo "Erro ao listar as cidades. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($rs);
        }
    }

    function find($nome)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("SELECT nome_cidade, sigla_uf FROM cidade WHERE nome_cidade LIKE :nome");
            # o bindParam recebe os parâmetros por referência, não é possível usar literais.
            # para literais usa-se bindValue
            $stmt->bindValue(":nome", "%{$nome}%");

            # https://www.php.net/manual/en/pdostatement.debugdumpparams
            // $stmt->debugDumpParams();

            if($stmt->execute()) {
                if($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                        echo $row->nome_cidade . "<br>";
                        echo $row->sigla_uf . "<br>";
                    }
                }
            }
        } catch (PDOException $error) {
            echo "Erro ao buscar a cidade '{$nome}'. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

    function update($cidade)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("UPDATE cidade SET nome_cidade = :nome, sigla_uf = :uf WHERE cod_cidade = :codigo");

            $stmt->bindParam(":codigo", $cidade->codigo);
            $stmt->bindParam(":nome", $cidade->nome);
            $stmt->bindParam(":uf", $cidade->uf);

            if ($stmt->execute())
                echo "Cidade atualizada com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao atualizar a cidade. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

    function delete($codigo)
    {
        try {
            $con = getConnection();

            $stmt = $con->prepare("DELETE FROM cidade WHERE cod_cidade = ?");
            $stmt->bindParam(1, $codigo);

            if ($stmt->execute())
                echo "Cidade deleta com sucesso";
        } catch (PDOException $error) {
            echo "Erro ao deletar a cidade. Erro: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

    ## Teste do create
    // $cidade = new stdClass(); # cria uma classe genérica
    // $cidade->nome = "Rio de Janeiro"; # definição do atributo nome no objeto
    // $cidade->uf = "RJ"; # definição do atributo uf no objeto
    // create($cidade);
    
    // echo "<br><br>---<br><br>";
    
    ## Teste do get
    get();

    echo "<br><br>---<br><br>";
    
    ## Teste do find
    // find("Ca");

    ## Teste do update
    // $cidade = new stdClass();
    // $cidade->nome = "Macaé";
    // $cidade->uf = "RJ";
    // $cidade->codigo = 2;
    // update($cidade);

    ## Teste do delete
    delete(2);

    echo "<br><br>---<br><br>";

    ## Teste do get
    get();