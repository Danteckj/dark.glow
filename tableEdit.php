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
    'war_date' => $_GET['warname'],

    'damage' => $_GET['damage'],
    'player_name' => $_GET['player'],
    'input_id' => $_GET['inputId']
];

$sneakCount = numsqlins("SELECT COUNT(*) FROM War WHERE player_name = '" . $pdomassive['player_name'] . "' AND war_date = '" . $pdomassive['war_date'] . "'");
if ($pdomassive['input_id'] <= $sneakCount) {
    sqlSimpleInsert("UPDATE War SET damage =" . $pdomassive['damage'] . " WHERE ID=
                                  (
                                    SELECT id FROM (
(SELECT id FROM War WHERE player_name = '" . $pdomassive['player_name'] . "' AND war_date = '" . $pdomassive['war_date'] . "'  ORDER BY id ASC  LIMIT " . $pdomassive['input_id'] . " )) AS t2  ORDER BY id DESC LIMIT 1
                                  )");


} else {

    $ins = [
        'id' => NULL,
        'war_date' => $pdomassive['war_date'],
        'damage' => $pdomassive['damage'],
        'player_name' => $pdomassive['player_name']
    ];
    sqlInsertInTable($query = "INSERT INTO `War`" . "VALUES(:id,:war_date,:damage,:player_name)", $ins);
    unset($ins);
}

$avgDamge = numsqlins("SELECT AVG(damage) FROM War WHERE war_date = '" . $pdomassive['war_date'] . "'");
$sneaks = 120 - numsqlins("SELECT COUNT(*) FROM War WHERE war_date = '" . $pdomassive['war_date'] . "'");
$id=str_replace(" ", "", $pdomassive['player_name']);
$idAvgDamage= $id.'avgDamage';
$idMaxDamage= $id.'maxDamage';
//$playerAvgDamage = numsqlins("SELECT AVG(damage) FROM War WHERE player_name = '" . $pdomassive['player_name'] . "' AND war_date = '" . $pdomassive['war_date']."'");
//$playerMaxDamage = numsqlins("SELECT SUM(damage) FROM War WHERE player_name = '" . $pdomassive['player_name'] . "' AND war_date = '" . $pdomassive['war_date']."'");
echo $sneaks . '.' . numsqlins("SELECT SUM(damage) FROM War WHERE  war_date = '" . $pdomassive['war_date'] . "'") . '.' . $avgDamge . '.' . $idAvgDamage .'.'.$idMaxDamage ;
unset($pdomassive);









