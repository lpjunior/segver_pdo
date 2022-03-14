<?php

    require_once('./CityRepository.php');

    if($_POST['txtCodigo'] == NULL || $_POST['txtCidade'] == NULL || $_POST['txtUf'] == NULL)
    {
        header('location: error.php?status=access-deny');
        exit;
    }

    $cidade = new stdClass();
    $cidade->codigo = $_POST['txtCodigo'];
    $cidade->nome = $_POST['txtCidade'];
    $cidade->uf = $_POST['txtUf'];

    if(update($cidade)){
        header("location: cidade.list.php?status=success");
        exit;
    } else {
        header("location: cidade.form.php?status=fail");
        exit;
    }