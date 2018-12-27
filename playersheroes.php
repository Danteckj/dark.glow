<?php
include_once __DIR__ . '/header.php';
include_once __DIR__ . '/pagemanualgenerator.php';
include_once __DIR__ . '/simplePDOFunc.php';

function fuck()
{
    $responce = sqlRequest("SELECT * FROM Playersheroes");


    foreach ($responce as $item) {

        echo "<li <h4>" . $item['name'] . "</h4><h3>600 500 400</h3><h3>" . $item['600force'] . " " . $item['500force'] . " " . $item['400force'] . "</h3>";

    }
}

?>


<form action="/addplayerheroes.php" method="GET">
    <label>Выберите ваше имя</label><br>
    <select name="player" size="3"
    <?php
    try {
        $pdo = pdoCreate();
        $query = "SELECT name FROM Players";
        $response = $pdo->query($query);
        $response->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($response as $item) {
            echo "<option  value=\"" . $item['name'] . "\">" . $item['name'] . "</option>";

        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
    ?>
    </select>
    <br><br>
    <label>Команды больше 600</label>
    <br><input name="600force" type="text"><br><br>

    <label>Команды больше 500</label><br>
    <input name="500force" type="text"> <br><br>

    <label>Команды больше 400</label><br>
    <input name="400force" type="text"><br><br>
    <input type="submit">
</form>

<div class="warNamesDiv">
    <ul>
        <?= fuck(); ?>
    </ul>
</div>



