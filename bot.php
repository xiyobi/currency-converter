<?php
require 'src/Bot.php';
$bot = new Bot();
require 'src/Currency.php';
require 'src/Weather.php';

$weather = new Weather();


$currency = new Currency();
$currencies = $currency->getCurrencies();

$update = json_decode(file_get_contents('php://input'),true);
$massage = $update['massage'];
if (isset($message['text'])) {
    $text = $update->message->text;
    $from_id = $update->message->from->id;
//    $fromW_id = $update->message->from->id;
//    $textW = $update->message->text;

$data = json_decode(file_get_contents('php://input', true));

$weather = $data['weather'][0];
$main = $weather['main'];
$description = $weather['description'];
$icon = $weather['icon'];

    if ($text=='/startW'){
        $response = $bot->makeRequest('weather',[
            'main' => $main,
            'description' => $description,
            'icon' => $icon,
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
    
    if ($text == $currency) {
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
