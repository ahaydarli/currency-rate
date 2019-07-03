<?php

$currency = 'USD';

$currencyRate = new CurrencyRate($currency);
$rate = $currencyRate->getRate();
