<?php include __DIR__ . "/header.php"; ?>
<script src="http://megatimer.ru/s/34925779ceb8911067578e2f7ee580a8.js"></script>
<?php
require_once __DIR__ . '/assets/pdo.php';
require_once __DIR__ . '/vendor/autoload.php';


ini_set('display_errors', 'Off');
error_reporting('E_ALL');

$googleAccountKeyFilePath = __DIR__ . '/assets/DarkGlowPhp -36092a905905.json';
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $googleAccountKeyFilePath);

// Документация https://developers.google.com/sheets/api/
$client = new Google_Client();
$client->useApplicationDefaultCredentials();

// Области, к которым будет доступ
// https://developers.google.com/identity/protocols/googlescopes
$client->addScope('https://www.googleapis.com/auth/spreadsheets');

$service = new Google_Service_Sheets($client);

$spreadsheetId = '16gVrsnBionOheKxMdFG_Gbpq5KYTPj2tBGoijsYYsIY';
$response = $service->spreadsheets->get($spreadsheetId);

couter();


function couter(){
$googleAccountKeyFilePath = __DIR__ . '/assets/DarkGlowPhp -36092a905905.json';
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $googleAccountKeyFilePath);

// Документация https://developers.google.com/sheets/api/
$client = new Google_Client();
$client->useApplicationDefaultCredentials();
if (isset($_GET['warseename'])) $waRname = $_GET['warseename'];
// Области, к которым будет доступ
// https://developers.google.com/identity/protocols/googlescopes
$client->addScope('https://www.googleapis.com/auth/spreadsheets');
$service = new Google_Service_Sheets($client);
$spreadsheetId = '16gVrsnBionOheKxMdFG_Gbpq5KYTPj2tBGoijsYYsIY';
$response = $service->spreadsheets->get($spreadsheetId);
foreach ($response->getSheets() as $sheet) {
$tablename = $sheet->getProperties()->title;
if (isset($_POST['warseename'])) $waRname = $_POST['warseename'];
else $waRname = 'Война 12.12';
if (strpos($tablename, $waRname) === false) continue;
$responeSheet = $service->spreadsheets_values->get($spreadsheetId, $tablename . '!B13:B18');
$nameResponeSheet = $service->spreadsheets_values->get($spreadsheetId, $tablename . '!B1:W1');
$tapoksResponeSheet = $service->spreadsheets_values->get($spreadsheetId, $tablename . '!B3:W3');
$responeSheetValues = $responeSheet->values;
$names = $nameResponeSheet->values;
$tapoks = $tapoksResponeSheet->values; ?>
    <h1 class='warname'><?= $tablename ?> </h1>
<?php
$enemyPoints = $responeSheetValues[1][0];
$ourPoints = $responeSheetValues[2][0];
$points = $responeSheetValues[3][0];
$damage = $responeSheetValues[4][0];
$haveTapoks = $responeSheetValues[5][0];
$needTapkov = $responeSheetValues[0][0];
?>
    <div class="pointstable">
        <ul>
            <li>
                <h3 class="enemy">Очки врагов</h3>
                <h4> <?= $enemyPoints; ?></h4>
            </li>
            <li>
                <h3 class="our">Наши очки</h3>
                <h4><?= $ourPoints; ?></h4>
            </li>
            <li>
                <h3 class="points">Разрыв:</h3>
                <h4><?= $points ?></h4>
            </li>
        </ul>
    </div>
    <div class="warinfo">
        <ul>
            <li>
                <h3>Средний Дамаг</h3>
                <h4><?= $damage ?></h4>
            </li>
            <li>
                <h3>Осталось тапков</h3>
                <h4><?= $haveTapoks ?></h4>
            </li>
            <li>
                <h3>Необходимо тапков</h3>
                <h4><?= $needTapkov ?></h4>
            </li>
        </ul>
    </div>
<div class="warNamesDiv">
    <ul>
        <?php

        for ($index = 0; $index < count($tapoks[0]); $index++) {
            if ($tapoks[0][$index] > 0) {
                if ($tapoks[0][$index] > 3) $cssClassBackgroundCollor = 'warnames';
                else if ($tapoks[0][$index] == 3) $cssClassBackgroundCollor = 'warnamesblue';
                else if ($tapoks[0][$index] < 3) $cssClassBackgroundCollor = 'warnamesgreen';
                echo "<li class='" . $cssClassBackgroundCollor . "'<p></p><h4>" . $names[0][$index] . ': ' . "</h4><h3>" . $tapoks[0][$index] . "</h3></li>";
            }
        }

        }
        } ?>
    </ul>
</div>

<?php include __DIR__ . "/footer.php"; ?>
