<?php

/**
 * Created by PhpStorm.
 * User: ali
 * Date: 7/18/17
 * Time: 1:29 AM
 */
class CbarRate implements CurrencyStrategy
{
    use CbarTrait;

    private $currency;
    private $rate;

    public function __construct($currency)
    {
        $this->currency = $currency;
    }

    public function getRate()
    {
        $this->setRate($this->currency);
        return $this->rate;
    }
}