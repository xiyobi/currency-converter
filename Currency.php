<?php
class Currency{
    const Currency_API_URL = "https://cbu.uz/uz/arkhiv-kursov-valyut/json/";
    public function __construct(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::Currency_API_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        $decoded = json_decode($output);
        echo $decoded[0]->Ccy;
    }
}