<?php

if (!function_exists('priceAndCurrencyFormat')) {

    /**
     * Handle price and currency formatting
     *
     * @param
     * @return
     */
    function priceAndCurrencyFormat($price, $locale)
    {
        $currency = config('app.currencies.'. $locale);

        if ($locale === 'en') {
            return $currency . number_format($price, 2, '.', ',');
        } else {
            return number_format($price, 2, ',', '.') . ' ' . $currency;
        }
    }
}
