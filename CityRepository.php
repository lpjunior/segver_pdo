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
            return true;
    } catch (PDOException $error) {
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

        $stmt = $con->prepare("SELECT cod_cidade, nome_cidade, sigla_uf FROM cidade WHERE nome_cidade LIKE :nome");
        $stmt->bindValue(":nome", "%{$nome}%");

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
            return true;
    } catch (PDOException $error) {
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
            return true;
    } catch (PDOException $error) {
        return false;
    } finally {
        unset($con);
        unset($stmt);
    }
}
