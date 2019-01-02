<?php
include_once __DIR__ . '/header.php';
include_once __DIR__ . '/pagemanualgenerator.php';
include_once __DIR__ . '/simplePDOFunc.php';
?>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    function sendData(input) {



        function funcBefore() {
        }

        function funcSuccess(data) {
            var txt = data.split(".")[0];
            var points = data.split(".")[1];
            var titanHp = 2574000-txt;


            $("#enemypoints").text(titanHp);
            $("#ourpoints").text(points);

        }

        function funcError() {
            alert(input.id + " " + input.value);
        }

        $.ajax({
            url: "titanEdit.php",
            type: "GET",
            data: ({damage: input.value, player: input.className, titanname: "Титан 29.12", inputId: input.id}),
            dataType: "html",
            beforeSend: funcBefore,
            error: funcError,
            success: funcSuccess
        });


    }
</script>
<?php
pageTitanGenerator();