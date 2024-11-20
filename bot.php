<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require 'vendor/autoload.php';

$bot = new Bot();
$weather = new Weather();
$currency = new Currency();

$weatherdata = $weather->getWeather();
$currencies = $currency->getCurrencies();

$data = json_decode(file_get_contents('php://input'));

var_dump($data);

$response = $bot->makeRequest('sendMessage', [
    'chat_id' => $data->message->chat->id,
    'text' => "Hello World! <a href='https://core.telegram.org/bots/'>Click here</a>",
    'parse_mode' => 'HTML',
]);
if (!$response->ok) {
    $bot->makeRequest('sendMessage', [
        'chat_id' => $data->message->chat->id,
        'text' => "Error: " . json_encode($response),
    ]);
}

if (isset($data->message)) {
    $message = $data->message;
    $text = $message->text;
    $from_id = $message->from->id;

    $weather=$weather->getWeather();
    if (isset($data->weather)) {
        $weather = $data->weather[0];
        $main = $weather->main;
        $icon = $weather->icon;

    }

    if ($text=='/weather'){
        $information_list = "";
        $information_list .= "Toshkent"."\n";
        $information_list .= "Harorat"." ".($weather)."C"."\n";
        $information_list .= "Namlik"." ".($main)."%"."\n";
        $information_list .= "posim"." ".($icon)."pa"."\n";


        $response = $bot->makeRequest('sendMessage', [
            'chat_id' => $from_id,
            'parse_mode' => 'HTML',
            'text'=> $information_list
        ]);
    }
    if ($text == '/start') {
        $response = $bot->makeRequest('sendMessage', [
            'chat_id' => $from_id,
            'text' => "Hello World! <a href='https://core.telegram.org/bots/'>Click here</a>",
            'parse_mode' => 'HTML',
        ]);
        if (!$response->ok) {
            $bot->makeRequest('sendMessage', [
                'chat_id' => $from_id,
                'text' => "Error: " . json_encode($response),
            ]);
        }
    }

    if ($text == '/currency') {
        $currencies = $currency->getCurrencies();

        if ($currencies) {
            $currency_list = "";
            foreach ($currencies as $currency => $rate) {
                $currency_list .= $currency . ": " . $rate . "\n";
            }
            $bot->makeRequest('sendMessage', [
                'chat_id' => $from_id,
                'text' => $currency_list,
            ]);
        } else {
            $bot->makeRequest('sendMessage', [
                'chat_id' => $from_id,
                'text' => "Valyuta ma'lumotlari mavjud emas.",
            ]);
        }
    }
}
