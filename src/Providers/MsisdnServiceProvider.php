<?php

namespace Nonsapiens\MsisdnToolkit\Providers;

use Faker\Generator as FakerGenerator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Nonsapiens\MsisdnToolkit\Faker\MsisdnFakerProvider;
use Nonsapiens\MsisdnToolkit\Msisdn;

class MsisdnServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        // Extend Faker to include our MSISDN provider so `$faker->msisdn()` etc. are available
        $this->app->extend(FakerGenerator::class, function ($faker, $app) {
            if ($faker instanceof FakerGenerator) {
                $faker->addProvider(new MsisdnFakerProvider($faker));
            }
            return $faker;
        });
    }

    public function boot(): void
    {
        // Validation rule for strict South African MSISDNs
        Validator::extend('msisdn', function ($attribute, $value, $parameters, $validator) {
            if (!is_string($value)) {
                return false;
            }
            try {
                return Msisdn::isValid($value, true);
            } catch (\Throwable $e) {
                return false;
            }
        }, 'The :attribute is not a valid South African MSISDN.');
    }

}