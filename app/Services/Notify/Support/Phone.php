<?php

namespace App\Services\Notify\Support;

class Phone
{
    /**
     * Number normalization (generalize according to your target market)
     * Input: 0912..., 98912..., +98912...
     * Output: +98912...
     */
    public static function normalize(string $input): string
    {
        $s = preg_replace('/\D+/', '', $input ?? '');
        if (!$s) {
            return $input;
        }
        
        if (str_starts_with($s, '00')) {
            $s = substr($s, 2);
        }
        if (str_starts_with($s, '0')) {
            $s = '98' . substr($s, 1);
        }
        if (!str_starts_with($s, '98')) {
            $s = '98' . $s;
        }
        
        return '+' . $s;
    }
}
