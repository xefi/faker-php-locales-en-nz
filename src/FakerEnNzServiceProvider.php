<?php

namespace Xefi\Faker\EnNz;

use Xefi\Faker\EnNz\Extensions\AddressExtension;
use Xefi\Faker\EnNz\Extensions\ColorsExtension;
use Xefi\Faker\EnNz\Extensions\CompanyExtension;
use Xefi\Faker\EnNz\Extensions\FinancialExtension;
use Xefi\Faker\EnNz\Extensions\PersonExtension;
use Xefi\Faker\EnNz\Extensions\PhoneExtension;
use Xefi\Faker\EnNz\Extensions\TextExtension;
use Xefi\Faker\Providers\Provider;

class FakerEnNzServiceProvider extends Provider
{
    public function boot(): void
    {
        $this->extensions([
            AddressExtension::class,
            ColorsExtension::class,
            CompanyExtension::class,
            FinancialExtension::class,
            PersonExtension::class,
            PhoneExtension::class,
            TextExtension::class,
        ]);
    }
}
