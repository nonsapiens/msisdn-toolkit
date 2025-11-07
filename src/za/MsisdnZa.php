<?php

namespace Nonsapiens\MsisdnToolkit\za;

use Nonsapiens\MsisdnToolkit\Msisdn;

class MsisdnZa extends Msisdn
{
    public string $dialPrefix = '27';

    public array $mnoRanges = [

    ];

    public function isValid(): bool
    {
        // Validate South African MSISDN format
        $normalized = preg_replace('/\D/', '', $this->msisdn); // Remove non-digit characters
        if (substr($normalized, 0, 1) === '0') {
            $normalized = $this->dialPrefix . substr($normalized, 1);
        } elseif (substr($normalized, 0, 2) !== '27') {
            $normalized = $this->dialPrefix . $normalized;
        }

        // South African MSISDN should be 11 digits long starting with 27
        return preg_match('/^27[0-9]{9}$/', $normalized) === 1;
    }

    public function toStrict(): string
    {
        // Convert to strict format (e.g., 27820000000)
        $normalized = preg_replace('/\D/', '', $this->msisdn); // Remove non-digit characters
        if (substr($normalized, 0, 1) === '0') {
            $normalized = '27' . substr($normalized, 1);
        } elseif (substr($normalized, 0, 2) !== '27') {
            $normalized = '27' . $normalized;
        }
        return $normalized;
    }

    public function toNormal(): string
    {
        // Convert to normal format (e.g., 0820000000)
        $strict = $this->toStrict();
        return '0' . substr($strict, 2);
    }

    public function toHumanReadable(): string
    {
        // Convert to human-readable format (e.g., +27 82 000 0000)
        $strict = $this->toStrict();
        return '+' . substr($strict, 0, 2) . ' ' . substr($strict, 2, 2) . ' ' . substr($strict, 4, 3) . ' ' . substr($strict, 7);
    }
}