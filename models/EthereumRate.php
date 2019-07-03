<?php

/**
 * Created by PhpStorm.
 * User: ali
 * Date: 7/18/17
 * Time: 1:29 AM
 */
class EthereumRate implements CurrencyStrategy
{
    use CbarTrait;

    private $rate;
    private $currency;
    private $fromCurrency = 'ETH';
    private $toCurrency = 'USD';
    private $coinRate = 1.07;

    public function __construct($currency)
    {
        $this->currency = $currency;
    }


    public function usdToEthereum()
    {
        $this->setRate($this->toCurrency);
        $json = @file_get_contents('https://min-api.cryptocompare.com/data/price?fsym='.
            $this->fromCurrency.'&tsyms='.$this->toCurrency);
        $data = json_decode($json, true);
        if(!isset($data[$this->toCurrency])){
            throw new Exception('Invalid Currency');
        }

        $this->rate *= $data[$this->toCurrency];
    }

    public function getRate()
    {
        $this->usdToEthereum();
        return $this->rate / $this->coinRate;
    }
}