<?php

namespace Xefi\Faker\EnNz\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\EnNz\Extensions\CompanyExtension;

final class CompanyExtensionTest extends TestCase
{
    protected array $companies = [];

    protected function setUp(): void
    {
        parent::setUp();

        $companyExtension = new CompanyExtension(new Randomizer());
        $this->companies = (new ReflectionClass($companyExtension))->getProperty('companies')->getValue($companyExtension);
    }

    public function testCompany(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->companies); $i++) {
            $results[] = $this->faker->unique()->company();
        }

        $this->assertEqualsCanonicalizing(
            $this->companies,
            $results
        );
    }

    public function testCompanyNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^[1-8]\d{6}$/', $this->faker->companyNumber());
        }
    }

    public function testNzbn(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $nzbn = $this->faker->nzbn();

            $this->assertMatchesRegularExpression('/^9429\d{9}$/', $nzbn);
            $this->assertTrue($this->isValidGs1($nzbn), "NZBN {$nzbn} has an invalid GS1 check digit.");
        }
    }

    public function testValidatorMatchesKnownGtin(): void
    {
        $this->assertTrue($this->isValidGs1('4006381333931'));
        $this->assertFalse($this->isValidGs1('4006381333932'));
    }

    private function isValidGs1(string $number): bool
    {
        $sum = 0;
        foreach (str_split(strrev($number)) as $index => $digit) {
            $sum += (int) $digit * ($index % 2 === 0 ? 1 : 3);
        }

        return $sum % 10 === 0;
    }
}
