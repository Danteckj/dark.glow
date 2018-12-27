<?php
require_once __DIR__ . '/assets/pdo.php';
require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/simplePDOFunc.php';
require_once __DIR__ . '/header.php';
//Сумvарный урон всех по всем войнам отсортировано по убыванию
$sql1 = 'Select name as NAME, sum(damage) as SUMDAMAGE from Players left join War on Players.name = War.player_name GROUP by name order by SUMDAMAGE desc';
//Средний урон по всем войнам в которых участвовал отсортировано по убыванию
$sql2 = 'select name as NAME, avg(war_sum_damage) as AVGDAMAGE FROM (Select name, war_date, sum(damage) as war_sum_damage from Players left join War on Players.name = War.player_name GROUP by name, war_date) as hui group by name order by AVGDAMAGE DESC ';
//Средний нижний и средний верхний тапок
$sql3 = 'select name as NAME, avg(war_min_damage) as MINDAMAGE, avg(war_max_damage) AS MAXDAMAGE FROM (Select name, war_date, min(damage) as war_min_damage, max(damage) as war_max_damage from Players left join War on Players.name = War.player_name GROUP by name, war_date) as hui group by name order by name ';
//Средний тапок отсортировано по убыванию
$sql4 = 'Select name as NAME, avg(damage) as AVGDAMAGE from Players left join War on Players.name = War.player_name GROUP by name ORDER by AVGDAMAGE desc';
//Кто сколько тапков потратил и сколько осталось на войне х, отсортировано по убыванию
$sql5 = 'Select name as NAME, count(damage) TAPKIPOTR, (6 - count(damage)) as TAPKIOST from Players inner join War on Players.name = War.player_name WHERE war_date=\"12.12\" GROUP by name ORDER by TAPKIPOTR desc';
//Сильнейший по всем войнам
$sql6 = 'Select NAME, AVGDAMAGE from (Select name as NAME, avg(war_sum_damage) as AVGDAMAGE FROM (Select name, war_date, sum(damage) as war_sum_damage from Players left join War on Players.name = War.player_name GROUP by name, war_date) as hui group by name order by AVGDAMAGE DESC ) as hui2 limit 1';
//Сильнейший отряд по всем войнам
$sql7 = 'Select SQUADNAME, SQUADAVGDAMAGE from (
    Select SQUADNAME, avg(war_squad_sum_damage) as SQUADAVGDAMAGE FROM (
        Select Players.squad_name as SQUADNAME, sum(damage) as war_squad_sum_damage, war_date from Squads inner join Players on Squads.squad_name = Players.squad_name inner join War on Players.name = War.player_name group by Players.squad_name, war_date 
        ) as hui group by SQUADNAME order by SQUADAVGDAMAGE DESC
   ) as hui2 limit 1';


$res = sqlRequest($sql3);
foreach ($res as $value){


    echo $value['NAME'] .' минимальный дамаг: '.$value['MINDAMAGE'].' максимальный дамаг: '.$value['MAXDAMAGE']. '<br>';
}

echo numsqlins($sql6);






