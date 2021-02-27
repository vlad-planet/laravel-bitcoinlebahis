<?

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'libs/KrakenApiClient.php';
$kraken = new KrakenAPI('YOUR API KEY', 'YOUR API SECRET');


echo var_dump($kraken);
?>