<?php

namespace Nonsapiens\MsisdnToolkit\Faker;

use Faker\Generator;
use Faker\Provider\Base;

/**
 * Faker provider for generating South African MSISDNs.
 *
 * Methods:
 * - msisdn(): Normal format starting with 0 and 10 digits total (e.g. 0821234567)
 * - msisdnStrict(): Strict format starting with 27 and 11 digits total (e.g. 27821234567)
 * - msisdnE164(): E.164 format with +27 and 12 characters total (e.g. +27821234567)
 */
class MsisdnFakerProvider extends Base
{
    public function __construct(Generator $generator)
    {
        parent::__construct($generator);
    }

    /**
     * Generate a valid South African MSISDN in normal format: 0XXXXXXXXX
     */
    public function msisdn(): string
    {
        // 9 random digits after leading 0
        return '0' . $this->generator->numerify('#########');
    }

    /**
     * Generate a valid South African MSISDN in strict format: 27XXXXXXXXX
     */
    public function msisdnStrict(): string
    {
        // 9 random digits after 27
        return '27' . $this->generator->numerify('#########');
    }

    /**
     * Generate a valid South African MSISDN in E.164 format: +27XXXXXXXXX
     */
    public function msisdnE164(): string
    {
        // 9 random digits after +27
        return '+27' . $this->generator->numerify('#########');
    }
}
