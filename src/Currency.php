<?php
class Currency{

    const Currency_API_URL = "https://cbu.uz/uz/arkhiv-kursov-valyut/json/";

    public array $currencies = [];
    public function __construct(){

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, self::Currency_API_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        $decoded = json_decode($output);
        $this->currencies = $decoded;
        array_unshift($this->currencies, (object)[
            'Ccy'=>'UZS',
            'Rate'=>1,
            'CcyNm_EN'=>'Uzbekistan sum'
        ]);

    }
    public function  getCurrencies():array
    {
        $separated_data = [];
        $currencies_info = $this->currencies;
        foreach ($currencies_info as $currency):
                $separated_data[$currency->Ccy] = $currency->Rate;

           endforeach;

        return array_slice($separated_data, 0, 5);

    }
    public function  exchange(string $fromCurrency, string $toCurrency,int $amount)
    {
        $currencies = $this->getCurrencies();
        if ($fromCurrency == $toCurrency) {
            return "valutalar bir xil ";
        }
        if ($toCurrency=='UZS') {
            return $amount*(int)$currencies[$fromCurrency];
        }
        if ($fromCurrency=='UZS') {
            return $amount/(int)$currencies[$fromCurrency];
        }

            return "O'zbek so'mi kiritilmadi";

    }
}