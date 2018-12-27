<?php
include_once __DIR__ . '/simplePDOFunc.php';
echo $_GET['player'] . '<br>' . $_GET['500force'] . '<br>' . $_GET['600force'] . '<br>'. $_GET['400force'] . '<br>';




    sqlSimpleInsert("UPDATE Playersheroes SET 
      `600force` = ".$_GET['600force'].",
     `500force` = ".$_GET['500force'].", 
     `400force` = ".$_GET['400force']." 
     WHERE name = '".$_GET['player']."'
");


