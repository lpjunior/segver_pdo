<?php

require_once './Connection.php';

function create($login)
{
    try {
        $con = getConnection();

        $stmt = $con->prepare("INSERT INTO login(user, pass) VALUES (:user, :pass)");

        $stmt->bindParam(":user", $login->user);
        $stmt->bindValue(":pass", md5($login->pass));

        if ($stmt->execute())
            return true;
    } catch (PDOException $error) {
        return false;
    } finally {
        unset($con);
        unset($stmt);
    }
}

function getLogin($login)
{
    try {
        $con = getConnection();

        $stmt = $con->prepare("SELECT user FROM login WHERE user = :user pass = :pass");

        $stmt->bindParam(":user", $login->user);
        $stmt->bindValue(":pass", md5($login->pass));

        return $stmt->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $error) {
        echo "Erro ao efetuar o login. Erro: {$error->getMessage()}";
    } finally {
        unset($con);
        unset($stmt);
    }
}
