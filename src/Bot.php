<?php
require "vendor/autoload.php";
use GuzzleHttp\Client;
class Bot {
    const API_URL = 'https://api.telegram.org/bot';
    public $client;
    private $token = "7020930131:AAE-2OF_-xf-lQXgxnbHFZsHVDIYpPA--_Y";


    public function makeRequest($method, $data = []) {
        $this->client = new Client([
            'base_uri' => self::API_URL.$this->token.'/',
            'timeout'  => 2.0,
        ]);

        $response = $this->client->request('POST',$method, [
            'form_params' => $data
        ]);
        return json_decode($response->getBody()->getContents(),true);
    }
}
