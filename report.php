<?php
require_once  'vendor/autoload.php' ;
include_once "conf.php";
include_once "db.php";

DB::connect($dbServer, $dbUser, $dbPass, $db);

$query = "SELECT COUNT(*) FROM users WHERE deleted=1 AND date>SUBDATE(CURDATE(), 1)";
$result = mysqli_query(db::$link, $query);
$tmp = mysqli_fetch_row($result);
$countUsersDeleted = $tmp[0];

$query = "SELECT COUNT(*) FROM users WHERE deleted=0 AND date>SUBDATE(CURDATE(), 1)";
$result = mysqli_query(db::$link, $query);
$tmp = mysqli_fetch_row($result);
$countUsersCreated = $tmp[0];


use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/my_secret.json');
$client = new Google_Client;
try{
    $client->useApplicationDefaultCredentials();
    $client->setApplicationName("Something to do with my representatives");
    $client->setScopes(['https://www.googleapis.com/auth/drive','https://spreadsheets.google.com/feeds']);
    if ($client->isAccessTokenExpired()) {
        $client->refreshTokenWithAssertion();
    }
    $accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
    ServiceRequestFactory::setInstance(
        new DefaultServiceRequest($accessToken)
    );
    // Get our spreadsheet
    $spreadsheet = (new Google\Spreadsheet\SpreadsheetService)
        ->getSpreadsheetFeed()
        ->getByTitle('Report');
    // Get the first worksheet (tab)
    $worksheets = $spreadsheet->getWorksheetFeed()->getEntries();
    $worksheet = $worksheets[0];
    $listFeed = $worksheet->getListFeed();
    $listFeed->insert([
        'created' => "'". $countUsersCreated,
        'deleted' => "'". $countUsersDeleted,
        'date' => date_create('yesterday')->format('Y-m-d H:i:s')
    ]);

}catch(Exception $e){
    echo $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile() . ' ' . $e->getCode;
}
