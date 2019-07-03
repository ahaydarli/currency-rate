<?php

/**
 * Created by PhpStorm.
 * User: ali
 * Date: 7/18/17
 * Time: 2:08 AM
 */
trait CbarTrait
{
    public function setRate($currency)
    {
        $newRate = null;
        $xml = @file_get_contents('http://www.cbar.az/currencies/'.date('d.m.Y').'.xml');
        $xml = new SimpleXMLElement($xml);

        /** @noinspection PhpUndefinedFieldInspection */
        $rates = $xml->ValType->Type == 'Xarici valyutalar'
            ? $xml->ValType[0]->Valute
            : $xml->ValType[1]->Valute;

        $curr = strtoupper($currency);

        foreach ($rates as $r)
        {
            if ($curr == $r->attributes()->Code) {
                $newRate = (string) $r->Value;
                break;
            }
        }

        $this->rate = $newRate;
    }
}