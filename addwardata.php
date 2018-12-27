<?php include __DIR__ . '/header.php' ?>
<?php
require_once __DIR__ . '/assets/pdo.php';
require_once __DIR__ . '/vendor/autoload.php';
ini_set('max_execution_time', 999);
echo ini_get('max_execution_time'); // 100


//ini_set('display_errors', 'Off');
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

foreach ($response->getSheets() as $sheet) {
    $tablename = $sheet->getProperties()->title;
    if (strpos($tablename, 'Война ') === false) continue;
    echo "<h1>" . $tablename . '</h1><br>';
     getSheetAnaliseNew($service, $spreadsheetId, $tablename);


}



function getSheetAnaliseNew($service, $spreadsheetId, $tablename)
{
    $allValuesResponeSheet = $service->spreadsheets_values->get($spreadsheetId, $tablename . '!B1:W12');
    $allValues = $allValuesResponeSheet->values;


    for ($string = 0; $string <= 21; $string++) {

        $playerName = $allValues[0][$string];
        $playerUnUseSneakers = $allValues[2][$string];
        $playerAllDamage = $allValues[3][$string];
        $playerPerDamage = $allValues[5][$string];
        $pdomassive = [
            'player' => $playerName,
            'sneakers' => $playerUnUseSneakers,
            'damage' => $playerAllDamage,
            'perdamage' => $playerPerDamage,
            '1damage' =>(string) $allValues[6][$string],
            '2damage' => (string)$allValues[7][$string],
            '3damage' => (string)$allValues[8][$string],
            '4damage' =>(string) $allValues[9][$string],
            '5damage' => (string)$allValues[10][$string],
            '6damage' => (string)$allValues[11][$string]
        ];
        $login = 'root';
        $password = '';
        try {
            $pdo = new PDO("mysql:host=localhost" . ";dbname=dark_glow", $login, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "INSERT INTO" . "`" . $tablename . "`" . "VALUES(:player,:sneakers,:damage,:perdamage,:1damage, :2damage, :3damage, :4damage, :5damage, :6damage)";
            $msg = $pdo->prepare($query);
            $msg->execute($pdomassive);

        } catch (PDOException $e) {
            echo $e->getCode();
            echo ' не зашло<br>';
        }
        unset($pdomassive);
    }

}


function shit()
{
    echo "<h1>Shit</h1>";
}

?>
