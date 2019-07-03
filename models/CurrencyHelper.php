<?php

/**
 * Created by PhpStorm.
 * User: ali
 * Date: 7/18/17
 * Time: 1:34 AM
 */

class CurrencyHelper
{
    public static function round($rate, $price, $currency)
    {
        $currency = strtoupper($currency);
        //if change round you must change in back
        if (!is_numeric($price) || !$rate) {
            return $price;
        } elseif ( $rate && in_array($currency, ['BTC', 'ETH'])) {
            return round($price/$rate, 4);
        }
        return ceil($price/$rate);
    }

    public static function icon($currency, $class='')
    {
        $currency = strtoupper($currency);
        $cssClass = '';
        switch ($currency) {
            case 'ETH':
                $cssClass = 'icon-eth-icon';
                break;
            case 'BTC':
                $cssClass = 'fa fa-btc';
                break;
            default:
                $cssClass = 'icon-currency-'.strtolower($currency);
        }

        return "<i class='$cssClass $class'></i>";
    }
}