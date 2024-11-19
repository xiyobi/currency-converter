<?php
class Bot {
    const API_URL = 'https://api.telegram.org/bot';
    private $token = "7020930131:AAE-2OF_-xf-lQXgxnbHFZsHVDIYpPA--_Y";

    public function makeRequest($method, $data = []) {
        $ch = curl_init(self::API_URL . $method);
        curl_setopt($ch, CURLOPT_URL, self::API_URL . $this->token . '/' . $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response); // Javobni qaytarish va JSON formatiga o'tkazish
    }
}
