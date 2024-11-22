<?php

require 'src/Bot.php';
require 'src/Weather.php';
require 'src/Currency.php';

$bot = new Bot();
$weather = new Weather();
$currency = new Currency();

$data = json_decode(file_get_contents('php://input'));

if (isset($data->message)) {
    $message = $data->message;
    $text = $data->message->text;
    $from_id = $message->from->id;
    $user_name = $message->from->first_name;

    if ($text == '/start') {
        $bot->saveUser($from_id, $user_name);

        $reply_keyboard = [
            'keyboard' => [
                [
                ['text' => "Ob havo"],
                    ['text' => "Valuta"]
                    ]
            ],
            'resize_keyboard' => true,
        ];

        $response = $bot->makeRequest('sendMessage', [
            'chat_id' => $from_id,
            'text' => "Salom! Bu bot sizga yordam beradi.",
            'reply_markup' => json_encode($reply_keyboard),
        ]);
    }


    if ($text == '/weather' or $text == 'Ob havo') {
        $weather_data = $weather->getWeather();

        $temperature = $weather_data->main->temp;
        $humidity = $weather_data->main->humidity;

        $text = "Ob-havo ma'lumotlari:\n";
        $text .= "Harorat: " . $temperature. "°C\n";
        $text .= "Namlik: " . $humidity . "%\n";

        $bot->makeRequest('sendMessage', [
            'chat_id' => $from_id,
            'text' => $text,
        ]);
    }
    if ($text == '/currency' or $text == 'Valuta') {
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
