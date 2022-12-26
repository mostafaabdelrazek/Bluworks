<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

// Unified response here is useless.
// return values only with nothing else.

class TaskController extends Controller
{
    protected function ConvertAlphaToDecimal(string $strAlpha) {
        echo \App\Services\AlphaNumbringSystem::ConvertToDecimal($strAlpha);
    }

    protected function ReturnGapWithFiveExclusion(int $intStartNumber, int $intEndNumber) {
        if ($intStartNumber >= $intEndNumber) {
            return 'the first number should be smaller than second number.';
        }
        echo \App\Services\CalculateNumbersGap::CalculateGap($intStartNumber, $intEndNumber, 5);
    }
}
