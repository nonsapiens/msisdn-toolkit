<?php

namespace Nonsapiens\MsisdnToolkit;

abstract class Msisdn
{
    public string $dialPrefix;

    public array $mnoRanges = [];

    public function __construct(protected string $msisdn) {}

    public static function getInstance(
        string $msisdn,
        string $countryCode = 'za'
    ): Msisdn
    {
        $className = 'Nonsapiens\\MsisdnToolkit\\' . strtolower($countryCode) . '\\Msisdn' . ucfirst(strtolower($countryCode));
        if (class_exists($className)) {
            return new $className($msisdn);
        }
        throw new \InvalidArgumentException("Unsupported country code: $countryCode");
    }

    abstract public function isValid(): bool;

    abstract public function toStrict(): string;

    abstract public function toNormal(): string;

    abstract public function toHumanReadable(): string;

}