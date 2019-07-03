<?php

/**
 * Created by PhpStorm.
 * User: ali
 * Date: 7/18/17
 * Time: 1:20 AM
 */
interface CurrencyStrategy
{
    public function getRate();
}