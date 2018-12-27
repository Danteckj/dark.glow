<?php
include_once __DIR__ . '/simplePDOFunc.php';
try {
$pdo = pdoCreate();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = 'SELECT * FROM Playersheroes';
$response = $pdo->query($query);
$response->setFetchMode(PDO::FETCH_ASSOC);
var_dump($response);
    foreach ($response as $item){
        echo $item[name];
    }
}

catch (PDOException $e) {
$e->getMessage();

}