<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
    require 'vendor/autoload.php';
    use GuzzleHttp\Client;
    class Weather{
        const WEATHER_API_URL = 'https://api.openweathermap.org/data/2.5/';
        public $client;
        public  function __construct()
        {
            $this->client = new Client([
                'base_uri' => self::WEATHER_API_URL,
                'timeout'  => 2.0,
            ]);
        }
        public function getWeather(){

            $response = $this->client->request('GET', 'weather', [
                'query' => [
                    'q' => 'Tashkent',
                    'appid'=>'1f2c4527291b18aaab758440a1f8e071',
                    'units'=>'metric',
                    'lang'=>'uz'
                ]
            ]);
            return json_decode($response->getBody(), true);

        }
    }
$weather = new Weather();
print_r($weather->getWeather());
