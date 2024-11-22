<?php

require 'vendor/autoload.php';
use GuzzleHttp\Client;

class Currency
{
    const Currency_API_URL = "https://cbu.uz/uz/arkhiv-kursov-valyut/json/";
    public $client;
    public array $currencies = [];
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::Currency_API_URL,
            'timeout'  => 2.0,
        ]);


        $decoded = json_decode($this->client->request('GET', '')->getBody()->getContents());
        if ($decoded) {
            $this->currencies = $decoded;
            array_unshift($this->currencies, (object)[
                'Ccy' => 'UZS',
                'Rate' => 1,
                'CcyNm_EN' => 'Uzbekistan sum'
            ]);
        }
    }

    public function getCurrencies(): array
    {
        $separated_data = [];
        foreach ($this->currencies as $currency) {
            $separated_data[$currency->Ccy] = $currency->Rate;
        }
        return array_slice($separated_data, 0, 5);
    }

    public function exchange(string $fromCurrency, string $toCurrency, float $amount)
    {
        $currencies = $this->getCurrencies();

        if (!isset($currencies[$fromCurrency]) || !isset($currencies[$toCurrency])) {
            return "Valyuta topilmadi.";
        }

        if ($fromCurrency == $toCurrency) {
            return "Valutalar bir xil.";
        }

        if ($fromCurrency == 'UZS') {
            $result =  $amount / (float)$currencies[$toCurrency];
            return $amount . ' ' . $fromCurrency . '=' . $result . ' ' . $toCurrency;
        }

        if ($toCurrency == 'UZS') {
            $result=$amount * (float)$currencies[$fromCurrency];
            return $amount . ' ' . $fromCurrency . ' = ' . $result . ' ' . $toCurrency;
        }

//        $converted_to_uzs = $amount * (float)$currencies[$fromCurrency];
//        return $converted_to_uzs / (float)$currencies[$toCurrency];
    }
}
