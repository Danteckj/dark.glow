<?php include __DIR__ . "/header.php"; ?>
<?php
require_once __DIR__ . '/assets/pdo.php';
require_once __DIR__ . '/vendor/autoload.php';
//require __DIR__ . '/sqlFunctions.php';
//require __DIR__ . '/simplePDOFunc.php';


//ini_set('display_errors', 'Off');
//error_reporting('E_ALL');

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
$tableSheetsArray = [];
foreach ($response->getSheets() as $sheet) {
    $tablename = $sheet->getProperties()->title;
    if (strpos($tablename, 'Война ') === false) continue;
    else {
      getSheetAnaliseNew($service, $spreadsheetId, $tablename);


    }
}

function getSheetAnaliseNew($service, $spreadsheetId, $tablename)
{
    $allValuesResponeSheet = $service->spreadsheets_values->get($spreadsheetId, $tablename . '!B1:W12');
    $allValues = $allValuesResponeSheet->values;
    for ($string = 0; $string <= 21; $string++) {

        $playerName = $allValues[0][$string];
        $damageArray = [$allValues[6][$string], $allValues[7][$string], $allValues[8][$string], $allValues[9][$string], $allValues[10][$string], $allValues[11][$string], $allValues[12][$string]];
        foreach ($damageArray as $damage) {
            $pdomassive = [
                'id' => NULL,
                'war_date' => $tablename,
                'damage' => $damage,
                'player_name' => $playerName
            ];
            try {
                $pdo = new PDO("mysql:host=localhost" . ";dbname=Dark_glow", "root", "");
                //   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query = "INSERT INTO `War`" . "VALUES(:id, :war_date,:damage,:player_name)";


                $msg = $pdo->prepare($query);
                $msg->execute($pdomassive);

            } catch (PDOException $e) {
                $e->getMessage();
                echo $e->getCode();
                echo ' не зашло<br>';
            }
        }
    }
}

//        $pdomassive = [
//            'player' => $playerName,
//            '1damage' =>(string) $allValues[6][$string],
//            '2damage' => (string)$allValues[7][$string],
//            '3damage' => (string)$allValues[8][$string],
//            '4damage' =>(string) $allValues[9][$string],
//            '5damage' => (string)$allValues[10][$string],
//            '6damage' => (string)$allValues[11][$string]
//        ];
//        //  var_dump($pdomassive);
//        /   echo '<br>';
//
//
//        $login = 'f0252648_Dark_glow';
//        $password = '3776019';
//
//        try {
//            $pdo = new PDO("mysql:host=localhost" . ";dbname=f0252648_Dark_glow", $login, $password);
//            //   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            $query = "INSERT INTO `War`" ."VALUES(:player,:perdamage,:1damage, :2damage, :3damage, :4damage, :5damage, :6damage)";
//
//
//            $msg = $pdo->prepare($query);
//            $msg->execute($pdomassive);
//
//        } catch (PDOException $e) {
//            // $e-getMessage();
//            echo $e->getCode();
//            echo ' не зашло<br>';
//        }
//        unset($pdomassive);
//    }
//    return $arrayOfPlayers;
//}
//
//var_dump($tableSheetsArray);


//foreach ($warDiff as $warTableName) {
//
//
//
//
//$query = "INSERT INTO War VALUES ( :war_date,:damage,:player_name )";
//    $pdo = pdoCreate();
//    $insertIntoWarTable = $pdo->prepare($query);
//    $insertIntoWarTable->execute();
//
//}
?>