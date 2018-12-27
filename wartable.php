<?php
include_once __DIR__ . '/header.php';
include_once __DIR__ . '/pagemanualgenerator.php';
include_once __DIR__ . '/simplePDOFunc.php'

?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    function sendData(input) {



        function funcBefore() {
                   }

        function funcSuccess(data) {
            var txt = data.split(".")[0];
            var points = data.split(".")[1];
            var avgDamage = data.split(".")[2];
            var minus = '<?php echo  $enemyPoints=1916; ?>'-points;
            var need = minus/avgDamage;

            $("#ourpoints").text(points);
            $("#result").text(txt);
            $("#minusPoints").text(minus);
            $("#avgdamage").text(avgDamage);
            $("#needSneak").text(need);
        }

        function funcError() {
            alert(input.id + " " + input.value);
        }

        $.ajax({
            url: "tableEdit.php",
            type: "GET",
            data: ({damage: input.value, player: input.className, warname: "Война 26.12", inputId: input.id}),
            dataType: "html",
            beforeSend: funcBefore,
            error: funcError,
            success: funcSuccess
        });


    }
</script>


<?php




pageWarGenerator();










?>

