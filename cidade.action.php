<?php
    require_once('./CityRepository.php');

    session_start();

    if(isset($_GET['codigo']) && !empty($_GET['codigo']) && $_GET['codigo'] != NULL) {
        $_SESSION['cidade'] = findById($_GET['codigo']);    
    } elseif(isset($_GET['txtCidade']) && !empty($_GET['txtCidade']) && $_GET['txtCidade'] != NULL) {
        $_SESSION['cidades'] = find($_GET['txtCidade']);
    } else {
        $_SESSION['cidades'] = get();
    }