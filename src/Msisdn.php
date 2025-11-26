<?php

namespace Nonsapiens\MsisdnToolkit;

class Msisdn
{
    public static function toStrict(string $msisdn): ?string
    {
        // If there are any alpha characters at all, return null
        if (preg_match('/[a-zA-Z]/', $msisdn)) {
            return null;
        }

        // Remove any non-digit characters
        $digits = preg_replace('/\D/', '', $msisdn);

        // Check if the number starts with '0' and is 10 digits long
        if (preg_match('/^0\d{9}$/', $digits)) {
            return '27' . substr($digits, 1);
        }

        // Check if the number starts with '27' and is 11 digits long
        if (preg_match('/^27\d{9}$/', $digits)) {
            return $digits;
        }

        return null;
    }

    public static function toNormal(string $msisdn): ?string
    {
        // If there are any alpha characters at all, return null
        if (preg_match('/[a-zA-Z]/', $msisdn)) {
            return null;
        }

        // Remove any non-digit characters
        $digits = preg_replace('/\D/', '', $msisdn);

        // Check if the number starts with '27' and is 11 digits long
        if (preg_match('/^27\d{9}$/', $digits)) {
            return '0' . substr($digits, 2);
        }

        // Check if the number starts with '0' and is 10 digits long
        if (preg_match('/^0\d{9}$/', $digits)) {
            return $digits;
        }

        return null;
    }

    public static function isValid(string $msisdn, bool $strict = false): bool
    {
        // If there are any alpha characters at all, return null
        if (preg_match('/[a-zA-Z]/', $msisdn)) {
            return false;
        }

        // Remove any non-digit characters
        $digits = preg_replace('/\D/', '', $msisdn);

        if ($strict) {
            // Check if the number is in strict format (27xxxxxxxxx)
            return preg_match('/^27\d{9}$/', $digits) === 1;
        } else {
            // Check if the number is either in strict (27xxxxxxxxx) or normal (0xxxxxxxxx) format
            return preg_match('/^(27\d{9}|0\d{9})$/', $digits) === 1;
        }
    }

}