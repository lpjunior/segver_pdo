<?php

require_once './Connection.php';

function create($cliente)
{
    try {
        $con = getConnection();

        # https://www.php.net/manual/en/pdo.setattribute.php
        $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);

        $query = "insert into cliente(nome_cli) values (:nome);";
        $query .= "insert into endereco(nm_lgr, nr_lgr, nm_bairro, nr_cep, cod_cli, cod_cidade) ";
        $query .= "values (:logradouro, :numero, :bairro, :cep, :clienteID, :codCidade);";

        $stmt = $con->prepare($query);

        $stmt->bindParam(":nome", $cliente->nome);

        # https://www.php.net/manual/pt_BR/pdo.lastinsertid.php
        $stmt->bindParam(":clienteID", $con->lastInsertId());

        $stmt->bindParam(":logradouro", $cliente->logradouro);
        $stmt->bindParam(":numero", $cliente->numero);
        $stmt->bindParam(":bairro", $cliente->bairro);
        $stmt->bindParam(":cep", $cliente->cep);
        $stmt->bindParam(":codCidade", $cliente->codCidade);

        if ($stmt->execute())
            return true;
    } catch (PDOException $error) {
        return false;
    } finally {
        unset($con);
        unset($stmt);
    }
}

function create2($cliente)
{
    try {
        $con = getConnection();

        $query = "insert into cliente(nome_cli) values (:nome);";
        $stmt = $con->prepare($query);
        $stmt->bindParam(":nome", $cliente->nome);
        # https://www.php.net/manual/pt_BR/pdo.lastinsertid.php

        if ($stmt->execute()) {
            $query = "insert into endereco(nm_lgr, nr_lgr, nm_bairro, nr_cep, cod_cli, cod_cidade) ";
            $query .= "values (:logradouro, :numero, :bairro, :cep, :clienteID, :codCidade);";

            $stmt->bindParam(":logradouro", $cliente->logradouro);
            $stmt->bindParam(":clienteID", $con->lastInsertId());
            $stmt->bindParam(":numero", $cliente->numero);
            $stmt->bindParam(":bairro", $cliente->bairro);
            $stmt->bindParam(":cep", $cliente->cep);
            $stmt->bindParam(":codCidade", $cliente->codCidade);

            $stmt = $con->prepare($query);
        }

        if ($stmt->execute())
            return true;
    } catch (PDOException $error) {
        return false;
    } finally {
        unset($con);
        unset($stmt);
    }
}