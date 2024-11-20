
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once "vendor/autoload.php";
use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'https://api.telegram.org/bot7020930131:AAE-2OF_-xf-lQXgxnbHFZsHVDIYpPA--_Y/',
    'timeout'  => 2.0,
]);
$request = $client->request('GET', 'getMe');
var_dump($request->getBody()->getContents());


//
//    require 'src/Currency.php';
//    $currency = new Currency();
//    require 'recources/Views/currency-conventer.php';
?>
