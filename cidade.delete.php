<?php

require_once('./CityRepository.php');

if ($_GET['codigo'] == NULL) {
    header('location: error.php?status=access-deny');
    exit;
}

$result = delete($_GET['codigo']);

if ($result) {
    header("location: cidade.list.php?status=success");
    die();
}

header("location: cidade.list.php?status=fail");
die();
