<?php

namespace IoDigital\PeachPayment\Helpers;

/**
 * Class Currency
 *
 * Amounts are stored in cents, requires conversions.
 *
 * @package App\Helpers
 */
class Currency
{
    /**
     * Format amounts for display eg. 2,000.00
     *
     * @param $integerAmount
     *
     * @return string
     */
    public static function getFriendly(int $integerAmount)
    {
        try {
            return number_format($integerAmount / 100, 2, '.', ',');
        } catch (\Throwable $t) {
            echo $t->getMessage();
        }
    }

    /**
     * Format amounts for Peach Payment eg. 2000.00
     *
     * @param $integerAmount
     *
     * @return string
     */
    public static function paymentFriendlyNumber(int $integerAmount)
    {
        try {
            return number_format($integerAmount / 100, 2, '.', '');
        } catch (\Throwable $t) {
            echo $t->getMessage();
        }
    }
}
