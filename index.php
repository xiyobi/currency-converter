
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri == '/weather') {
        require 'weather.php';
} elseif($uri == '/currency') {
        require 'src/Currency.php';
        $currency = new Currency();
    require 'recources/Views/currency-conventer.php';
}elseif ($uri == '/telegram') {
    require 'app/bot.php';
    $bot = new Bot();
}
else{
    echo "404 no found page";
}
?>
