
<?php
require_once __DIR__ . '/assets/pdo.php';
require_once __DIR__ . '/vendor/autoload.php';
/**
 * Created by PhpStorm.
 * User: Dante
 * Date: 12.12.2018
 * Time: 2:56
 */








function sqlRequest ($query){

$response=null;
try {
    $pdo = pdoCreate();

$response = $pdo->query($query);
$response->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $e->getMessage();

}
return $response;
}



function sqlInsertInTable($query, $valuesArray){

    try {
        //соединение с БД
        $pdo = pdoCreate();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //добавление в таблицу на создание таблицы
        //'INSERT INTO products VALUES(:name, :img, :sitelink, :shop, :price, :category_id, :hit)';
        $insertInTable = $pdo->prepare($query);
        //Вставляем ассоциативный массив  $productsArray[$index] =
//        [
//            'name' => $pq->find('.h3')->text(),
//            'img' => $img,
//            'price' => $pq->find('.price')->text(),
//            'sitelink' => $link,
//            'shop' => 'AirsoftRus',
//            'category_id' =>'0',
//            'hit'=>'1'
//        ];
        $insertInTable->execute($valuesArray);

    } catch(PDOException $e) {
        echo 'Ошибка: ' . $e->getMessage();
    }
}


function sqlSimpleInsert($query){
    try {
        //соединение с БД
        $pdo = pdoCreate();

        //запрос на создание таблицы

            $pdo->exec($query);
    } catch(PDOException $e) {
        $e->getMessage();
    }
}

function pdoCreate (){
    $xml=simplexml_load_file(__DIR__ . "/config.xml");
    $host = $xml->host;
    $login = $xml->login;
    $password = $xml->password;
    $base = $xml->base;
    $pdo=null;
    try {
        //соединение с БД
        $pdo = new PDO("mysql:host=" . $host . ";dbname=" . $base, $login, $password);
      //  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    }  catch(PDOException $e) {
     $e->getMessage();
}
    return $pdo;
}




function numsqlins($query)
{
    $alldamage = null;
    $pdo = pdoCreate();
    $response = $pdo->query($query);
    $response->setFetchMode(PDO::FETCH_NUM);
    foreach ($response as $res) {
        $alldamage = $res[0];

    }
    return $alldamage;
}
