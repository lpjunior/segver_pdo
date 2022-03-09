<?php

define("HOST", "");
define("USER" , "");
define("PASS" , "");
define("DATABASE" , "");

function getConnection(){
    try{
        $key = 'strval';
        $con = new PDO("pgsql:host={$key(HOST)};dbname={$key(DATABASE)}", USER, PASS);

        echo "conectado";
    } catch (PDOException $error){
        echo "Erro ao conectar ao banco de dados. Erro: {$error->getMessage()}";
        exit;
    }
}

getConnection();