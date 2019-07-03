<?php

/**
 * Created by PhpStorm.
 * User: ali
 * Date: 7/18/17
 * Time: 1:56 AM
 */

class CurrencyRate
{
    private $rateObj = null;
    private $currency;
    private $rate;

    public function __construct($currency)
    {
        $this->currency = strtoupper($currency);
    }

    private function setClient()
    {
        switch ($this->currency) {
            case 'AZN':
                $this->rateObj = null;
                break;
            case 'BTC':
                $this->rateObj = new BitcoinRate($this->currency);
                break;
            case 'ETH':
                $this->rateObj = new EthereumRate($this->currency);
                break;
            default:
                $this->rateObj = new CbarRate($this->currency);

        }

        $this->rate = !empty($this->rateObj) ? $this->rateObj->getRate() : 1;
    }

    public function getRate()
    {
        $this->rate = $this->getRateFromState();
        if($this->rate) {
            return $this->rate;
        }
        $this->setClient();
        $this->setState();
        return $this->rate;
    }

    public function getRateFromState(){
        $currency = isset(Yii::app()->request->cookies['rate_currency']) ? Yii::app()->request->cookies['rate_currency']->value : '';
        if($currency == strtolower($this->currency)){
            if(Yii::app()->user->hasState('rate') && $state = Yii::app()->user->getState('rate')){
                return $state;
            }
        }
        return false;
    }

    public function setState() {
        Yii::app()->user->setState('rate', $this->rate);

        $cookie = new CHttpCookie('rate_currency', $this->currency);
        $cookie->expire = time() + 1*60*60;
        Yii::app()->request->cookies['rate_currency'] = $cookie;
    }
}