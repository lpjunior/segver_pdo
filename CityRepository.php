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
            // echo "Cidade cadastrada com sucesso";
            return true;
    } catch (PDOException $error) {
        // echo "Erro ao cadastrar a cidade. Erro: {$error->getMessage()}";
        return false;
    } finally {
        unset($con);
        unset($stmt);
    }
}

function get()
{
    try {
        $con = getConnection();

        $rs = $con->query("SELECT * FROM cidade");

        $cidades = array();

        while ($cidade = $rs->fetch(PDO::FETCH_OBJ)) {
            array_push($cidades, $cidade);
        }

        return $cidades;
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

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                
                $cidades = array();
                while ($cidade = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($cidades, $cidade);
                }

                return $cidades;
            }
        }
    } catch (PDOException $error) {
        echo "Erro ao buscar a cidade '{$nome}'. Erro: {$error->getMessage()}";
    } finally {
        unset($con);
        unset($stmt);
    }
}

function findById($codigo)
{
    try {
        $con = getConnection();

        $stmt = $con->prepare("SELECT * FROM cidade WHERE cod_cidade = :codigo");

        $stmt->bindParam(":codigo", $codigo);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
        }
    } catch (PDOException $error) {
        echo "Erro ao buscar a cidade pelo código: '{$codigo}'. Erro: {$error->getMessage()}";
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
            // echo "Cidade atualizada com sucesso";
            return true;
    } catch (PDOException $error) {
        // echo "Erro ao atualizar a cidade. Erro: {$error->getMessage()}";
        return false;
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
            // echo "Cidade deleta com sucesso";
            return true;
    } catch (PDOException $error) {
        // echo "Erro ao deletar a cidade. Erro: {$error->getMessage()}";
        return false;
    } finally {
        unset($con);
        unset($stmt);
    }
}
