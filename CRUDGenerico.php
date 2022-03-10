<?php

require_once './Connection.php';

$con = getConnection();

# nome da tabela
$table = "aluno";

# valor de busca
$search = "R";

# chave de busca
$key = "nome";

$filter = (!empty($key) ? "WHERE {$key} LIKE :param" : "");

# query
$query = "SELECT * FROM {$table} {$filter}";
echo $query;

$result = $con->prepare($query);

if(!empty($key)) {
    $result->bindValue(":param", "%{$search}%", PDO::PARAM_STR);
}

$result->execute();

foreach($result as $row)
{
    echo '<p>';
    echo $row[0] . " - " . $row[1] . " - " . $row[2];
    echo '</p>';
}

echo "<br><hr>Quantidade de cidades encontradas: {$result->rowCount()}";

$con = null;