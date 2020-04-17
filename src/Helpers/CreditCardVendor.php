<?php

namespace IoDigital\PeachPayment\Helpers;

class CreditCardVendor
{
    private static function isVISA(string $card) : bool
    {
        return preg_match("/^4[0-9]{0,15}$/i", $card);
    }
    private static function isMASTER(string $card) :  bool
    {
        return preg_match("/^5[1-5][0-9]{5,}|222[1-9][0-9]{3,}|22[3-9][0-9]{4,}|2[3-6][0-9]{5,}|27[01][0-9]{4,}|2720[0-9]{3,}$/i", $card);
    }

    public static function detect(string $card)
    {
        $cardTypes = [
            'VISA',
            'MASTER',
        ];

        foreach ($cardTypes as $cardType) {
            $method = 'is' . $cardType;

            if (self::$method($card)) {
                return $cardType;
            }
        }

        return false;
    }
}
