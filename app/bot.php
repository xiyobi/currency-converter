<?php

require 'src/Bot.php';
require 'src/Weather.php';
require 'src/Currency.php';

$bot = new Bot();
$weather = new Weather();
$currency = new Currency();

$data = json_decode(file_get_contents('php://input'));
error_log("Request data: " . file_get_contents('php://input'));

if (isset($data->message)) {
    $message = $data->message;
    $text = strtolower(trim($message->text));
    $from_id = $message->from->id;
    $user_name = $message->from->first_name;

    if ($text == '/start') {
        $bot->saveUser($from_id, $user_name);

        $reply_keyboard = [
            'keyboard' => [
                [['text' => "Ob havo"],
                    ['text' => "Valuta"]],
            ],
            'resize_keyboard' => true,
        ];

        $response = $bot->makeRequest('sendMessage', [
            'chat_id' => $from_id,
            'text' => "Salom! Bu bot sizga yordam beradi.",
            'reply_markup' => $reply_keyboard,
        ]);

        if (!$response->ok) {
            error_log("Telegram error: " . json_encode($response));
        }
    }

    if ($text=='Ob havo')
    {
        $weather_data = $weather->getWeather();
        $text = "Ob-havo ma'lumotlari:\n";
        $text .= "Harorat: " . ($weather_data->temperature) . "°C\n";
        $text .= "Namlik: " . ($weather_data->humidity ) . "%\n";

        $bot->makeRequest('sendMessage', [
            'chat_id' => $from_id,
            'text' => $text,
        ]);
    }
    if ($text=='Valuta'){
        $currencies = $currency->getCurrencies();
        $text = "Valyuta kurslari:\n";

        if ($currencies) {
            foreach ($currencies as $currency => $rate) {
                $text .= "$currency: $rate\n";
            }
        } else {
            $text = "Valyuta ma'lumotlari topilmadi.";
        }

        $bot->makeRequest('sendMessage', [
            'chat_id' => $from_id,
            'text' => $text,
        ]);
    }
    if ($text == '/weather') {
        $weather_data = $weather->getWeather();
        $text = "Ob-havo ma'lumotlari:\n";
        $text .= "Harorat: " . ($weather_data->temperature) . "°C\n";
        $text .= "Namlik: " . ($weather_data->humidity ) . "%\n";

        $bot->makeRequest('sendMessage', [
            'chat_id' => $from_id,
            'text' => $text,
        ]);
    }
    if ($text == '/currency') {
        $currencies = $currency->getCurrencies();
        $text = "Valyuta kurslari:\n";

        if ($currencies) {
            foreach ($currencies as $currency => $rate) {
                $text .= "$currency: $rate\n";
            }
        } else {
            $text = "Valyuta ma'lumotlari topilmadi.";
        }
        $bot->makeRequest('sendMessage', [
            'chat_id' => $from_id,
            'text' => $text,
        ]);
    }
}
