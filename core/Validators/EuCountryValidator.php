<?php

namespace Validators;

use Error;

class EuCountryValidator
{
    /** @var string[]  */
    const array EU_COUNTRIES = [
        'AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI',
        'FR', 'GR', 'HR', 'HU', 'IE', 'IT', 'LT', 'LU', 'LV', 'MT',
        'NL', 'PO', 'PT', 'RO', 'SE', 'SI', 'SK'
    ];

    public static function checkIsEu(string $countryCode): bool
    {
        if (!$countryCode) {
            throw new Error([
                'message' => 'Country code is invalid',
                'code' => $countryCode,
                'status' => 500
            ]);
        }

        return in_array($countryCode, self::EU_COUNTRIES);
    }
}
