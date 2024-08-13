<?php

namespace API;

class CommissionService
{
    // I'm not sure that this service is really need, because the value could be calculated anywhere, so this service is kinda terrible
    public static function calculateAmount($amount, $currency, $rate) {
        return $currency == 'EUR' || $rate == 0 ? $amount : $amount / $rate;
    }

}
