<?php

    require_once('./CityRepository.php');

    if($_POST['txtCidade'] == NULL || $_POST['txtUf'] == NULL)
    {
        header('location: error.php?status=access-deny');
        die();
    }

    $cidade = new stdClass();
    $cidade->nome = $_POST['txtCidade'];
    $cidade->uf = $_POST['txtUf'];

    if(create($cidade)){
        header("location: cidade.list.php?status=success");
        exit;
    } else {
        header("location: cidade.form.php?status=fail");
        exit;
    }