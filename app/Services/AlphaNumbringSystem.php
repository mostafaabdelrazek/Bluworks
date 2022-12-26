<?php 
namespace App\Services;

class AlphaNumbringSystem {
    private const ERR_TYPE_IS_NOT_VALID = 'Paramentr must be alpha letter.';

    public const BASE = 26;
    public const BASE_NUMBERS = [
        'A' => 1,
        'B' => 2,
        'C' => 3,
        'D' => 4,
        'E' => 5,
        'F' => 6,
        'G' => 7,
        'H' => 8,
        'I' => 9,
        'J' => 10,
        'K' => 11,
        'L' => 12,
        'M' => 13,
        'N' => 14,
        'O' => 15,
        'P' => 16,
        'Q' => 17,
        'R' => 18,
        'S' => 19,
        'T' => 20,
        'U' => 21,
        'V' => 22,
        'W' => 23,
        'X' => 24,
        'Y' => 25,
        'Z' =>26
    ];

    public static function ConvertToDecimal(string $strAlphaNumber) {
        if (!self::validate($strAlphaNumber)) {
            return self::ERR_TYPE_IS_NOT_VALID;
        }
        $arrAlpha = str_split(strrev(strtoupper($strAlphaNumber)));
        return self::calculateDecimalValues($arrAlpha);
    }

    private static function calculateDecimalValues(array $arrAlpha) {
        $intResult = 0;
        $intOrder = 0;
        if (empty($arrAlpha)) {
            return $intResult;
        }
        // result = base power n multiply m + base power n+1 multiply m ........
        foreach ($arrAlpha as $strChar) {
            // c -> character, n = position of char start from left to right and with value zero, m = the opposit value of character in decimal.
            $intResult += pow(self::BASE, ($intOrder++)) * self::BASE_NUMBERS[$strChar];
        }
        return (int)$intResult;
    }

    private static function validate(string $strAlphaNumber) {
        if (preg_match("/[^a-z]/i", $strAlphaNumber)) {
            return false;
        }

        return true;
    }
}
