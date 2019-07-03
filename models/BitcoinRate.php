<?php

/**
 * Created by PhpStorm.
 * User: ali
 * Date: 7/18/17
 * Time: 1:29 AM
 */
class BitcoinRate implements CurrencyStrategy
{
    private $currency;
    private $coinRate = 1.07;

    public function __construct($currency)
    {
        $this->currency = $currency;
    }


    public function bitcoinToAZN()
    {
        $json = @file_get_contents('https://inbitcoin.it/api/rates/?currency=AZN');
        $data = json_decode($json, true);
//        $dataAZN = array_filter($data, function ($el) {
//            return (
//                $el['code'] == "AZN"
//            );
//        });
//        foreach ($dataAZN as $curr) {
//            if(!isset($curr['rate'])){
//                throw new Exception('Invalid Currency');
//            }
//            return $curr['rate'];
//        }
        if(!empty($data['rate'])) {
            return $data['rate'];
        } else {
            throw new Exception('Invalid Currency');
        }

    }

    public function getRate()
    {
        return $this->bitcoinToAZN() / $this->coinRate;
    }
}