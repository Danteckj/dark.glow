<?php
require_once __DIR__ . '/assets/pdo.php';
require_once __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/header.php';
include_once __DIR__ . '/simplePDOFunc.php';


ini_set('display_errors', 'Off');
error_reporting('E_ALL');


function pageWarGenerator()
{
    $xml = simplexml_load_file(__DIR__ . "/warpage.xml");
    $players = [];
    foreach ($xml->Player as $player) {
        array_push($players, $player);
    }
    $warname = [
        'date' => $xml->warName
    ];
    $enemyPoints = 1340;

    $ourPointss = numsqlins("SELECT SUM(damage) FROM War WHERE  war_date = '" . $warname['date'] . "'") ? numsqlins("SELECT SUM(damage) FROM War WHERE  war_date = '" . $warname['date'] . "'") : 0;
    $avgDamage = numsqlins("SELECT AVG(damage) FROM War WHERE war_date = '" . $warname['date'] . "'") ? numsqlins("SELECT AVG(damage) FROM War WHERE war_date = '" . $warname['date'] . "'") : 0;
    $points = $enemyPoints - $ourPointss;
    $sneaks = (int)($points / $avgDamage);
    $haveSneaks = (int)(120 - numsqlins("SELECT COUNT(*) FROM War WHERE war_date ='" . $warname['date'] . "'"));

    include __DIR__ . '/pointstable.html';
    echo '<ul>';
    playersSotaGenerator($players, $warname, 'War', war_date);
    echo '<ul>';
}


function pageTitanGenerator()
{

    include __DIR__ . '/titantable.html';
    $xml = simplexml_load_file(__DIR__ . "/titanpage.xml");
    $players = [];
    foreach ($xml->Player as $player) {
        array_push($players, $player);
    }
    $titanname = [
        'date' => $xml->titanName
    ];
    echo '<ul>';
    playersSotaGenerator($players, $titanname, 'Titan', 'titan_date');
    echo '<ul>';
}


function playersSotaGenerator($players, $date, $table, $secondParametr)
{
    foreach ($players as $player) {
        echo "<p class=\"but\">" . $player . "</p>";
        $id=str_replace(" ", "", $player);
        $idAvgDamage= $id.'avgDamage';
        $idMaxDamage= $id.'maxDamage';
        $avgDamage = numsqlins("SELECT AVG(damage) FROM " . $table . " WHERE player_name = '" . $player . "' AND " . $secondParametr . " = '" . $date['date'] . "'");
        $maxDamage = numsqlins("SELECT SUM(damage) FROM " . $table . " WHERE player_name = '" . $player . "' AND " . $secondParametr . " = '" . $date['date'] . "'");
        include __DIR__ . '/liiin.html';

        try {
            $pdo = pdoCreate();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM " . $table . " WHERE player_name = '" . $player . "' AND " . $secondParametr . " = '" . $date['date'] . "' LIMIT 6";
            $response = $pdo->query($query);
            $response->setFetchMode(PDO::FETCH_ASSOC);
            $indexx = 0;
            $inputIdindex = 0;
            foreach ($response as $item) {

                $indexx++;
                $inputIdindex++;
                echo $inputIdindex;
                include __DIR__ . "/liin.html";
            }

            for ($index = 0; $index < 6 - $indexx; $index++) {

                $inputIdindex++;
                echo $inputIdindex;
                $item['damage'] = '';
                include __DIR__ . "/liin.html";
            }
            echo "<br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}