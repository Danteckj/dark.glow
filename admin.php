<?php include __DIR__ . "/header.php"; ?>

<form action="/getTable.php" method="post" >
    <h4>Введи название войны</h4>
    <input type="text" name="warseename" placeholder="Введи название войны">
    <input type="submit">

</form>
<form action="/index.php" method="GET">

    <p>Какие браузеры, на ваш взгляд, хорошо справляются с поддержкой CSS2?</p>

    <p><input type="checkbox" name="browser" value="IE" /> Microsoft Internet Explorer&nbsp;6.0</p>

    <p><input type="checkbox" name="browser" value="Opera" /> Opera&nbsp;8.0</p>

    <p><input type="checkbox" name="browser" value="FF" /> Mozilla Firefox&nbsp;1.0</p>

    <p><input type="submit" value="Поделиться мнением" /></p>

</form>
<?php include __DIR__ . "/footer.php"; ?>



