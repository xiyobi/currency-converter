<?php
class Bot {
    const API_URL = 'https://api.telegram.org/bot';
    private $token = '7020930131:AAE-2OF_-xf-lQXgxnbHFZsHVDIYpPA--_Y';

    public function makeRequest($method, $data = []) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::API_URL . $this->token . '/' . $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // data properly encoded
        $response = curl_exec($ch);
        curl_close($ch);
        var_dump($response);
    }
}

$bot = new Bot();
$bot->makeRequest('sendMessage', [
    'chat_id' => 5777562832,
    'text'=>'Hello Salom'
]);
$bot->makeRequest('sendVideo', [
    'chat_id' => 5777562832,
    'video '=>'https://www.w3schools.com/html/mov_bbb.mp4'
]);

$json = file_get_contents('https://cbu.uz/uz/arkhiv-kursov-valyut/json/');
$data = json_decode($json, true);

// Valyuta kurslari haqida xabar tayyorlash
$message = "Valyuta kurslari:\n";
foreach ($data as $valyuta) {
    $message .= $valyuta['CcyNm_UZ'] . ": " . $valyuta['Rate'] . " so'm\n";
}

?>
