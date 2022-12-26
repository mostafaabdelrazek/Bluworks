<?php 
namespace App\Services;

class CalculateNumbersGap {
    public static function CalculateGap(int $intStartNumber, int $intEndNumber, int|bool $intExclusion = false) {
        $arrNumbers = range($intStartNumber, $intEndNumber);
        if ($intExclusion) {
           $arrNumbers =  array_filter($arrNumbers,fn($v) => !str_contains($v, $intExclusion));       
        }
        return $intStartNumber. ',' . $intEndNumber. ' -> ' . implode(',',$arrNumbers). ' -> ' . count($arrNumbers);
    }
}
