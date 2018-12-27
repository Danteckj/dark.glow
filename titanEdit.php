<?php
/**
 * Created by PhpStorm.
 * User: Dante
 * Date: 14.12.2018
 * Time: 12:30
 */
include __DIR__ . '/simplePDOFunc.php';


$pdomassive = [
    'id' => NULL,
    'titan_date' => $_GET['titanname'],

    'damage' => $_GET['damage'],
    'player_name' => $_GET['player'],
    'input_id' => $_GET['inputId']
];

$sneakCount = numsqlins("SELECT COUNT(*) FROM Titan WHERE player_name = '" . $pdomassive['player_name'] . "' AND titan_date = '" . $pdomassive['titan_date'] . "'");
if ($pdomassive['input_id'] <= $sneakCount) {
    sqlSimpleInsert("UPDATE Titan SET damage =" . $pdomassive['damage'] . " WHERE ID=
                                  (
                                    SELECT id FROM (
(SELECT id FROM Titan WHERE player_name = '" . $pdomassive['player_name'] . "' AND titan_date = '" . $pdomassive['titan_date'] . "'  ORDER BY id ASC  LIMIT " . $pdomassive['input_id'] . " )) AS t2  ORDER BY id DESC LIMIT 1
                                  )");


} else {

    $ins = [
        'id' => NULL,
        'titan_date' => $pdomassive['titan_date'],
        'damage' => $pdomassive['damage'],
        'player_name' => $pdomassive['player_name']
    ];
    sqlInsertInTable($query = "INSERT INTO `Titan`" . "VALUES(:id,:titan_date,:damage,:player_name)", $ins);
    unset($ins);
}

$avgDamge = numsqlins("SELECT AVG(damage) FROM Titan WHERE titan_date = '" . $pdomassive['titan_date'] . "'");
echo numsqlins("SELECT SUM(damage) FROM Titan WHERE  titan_date = '" . $pdomassive['titan_date'] . "'") . '.' . $avgDamge;
unset($pdomassive);









