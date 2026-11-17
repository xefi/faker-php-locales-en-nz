<?php

namespace Xefi\Faker\EnNz\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\Calculators\Iban;
use Xefi\Faker\EnNz\Extensions\FinancialExtension;

final class FinancialExtensionTest extends TestCase
{
    public function testIban(): void
    {
        $financialExtension = new FinancialExtension(new Randomizer());
        $bankCodes = (new ReflectionClass($financialExtension))->getProperty('bankCodes')->getValue($financialExtension);

        for ($i = 0; $i < 100; $i++) {
            $iban = $this->faker->iban();

            $this->assertMatchesRegularExpression('/^NZ\d{2}\d{2}\d{4}\d{7}\d{2}$/', $iban);
            $this->assertContains(substr($iban, 4, 2), $bankCodes);
            $this->assertTrue(Iban::isValid($iban));
        }
    }
}
