<?php
$productsArray = array();



$index = 0;


foreach ($productsArray as $product){
    dbAction($product);
}



/**
 * @param $massive
 */
function dbAction($massive)
{
    $mas = $massive;
    $login = "root";
    $password = "";
    try {

        $pdo = new PDO("mysql:host=localhost;dbname=dark_glow", $login, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = 'INSERT INTO players VALUES(:name)';
        $msg = $pdo->prepare($query);
        $msg->execute($mas);
    } catch (PDOexeception $e) {
        $e->getMessage();
    }

}





