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

//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, self::Currency_API_URL);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $output = curl_exec($ch);
//        curl_close($ch);

        $decoded = json_decode($this->client->request('GET', ''));
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
        return array_slice($separated_data, 0, 5); // Barcha valyutalarni qaytarish uchun tuzatildi
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

        // UZS dan boshqa valyutaga almashtirish
        if ($fromCurrency == 'UZS') {
            return $amount / (float)$currencies[$toCurrency];
        }

        // Boshqa valyutadan UZSga almashtirish
        if ($toCurrency == 'UZS') {
            return $amount * (float)$currencies[$fromCurrency];
        }

        // Valyutani boshqa valyutaga almashtirish
        $converted_to_uzs = $amount * (float)$currencies[$fromCurrency];
        return $converted_to_uzs / (float)$currencies[$toCurrency];
    }
}
