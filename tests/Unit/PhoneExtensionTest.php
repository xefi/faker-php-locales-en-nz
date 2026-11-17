<?php

namespace Xefi\Faker\EnNz\Tests\Unit;

final class PhoneExtensionTest extends TestCase
{
    public function testPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^0([34679]\d{7}|2[1279]\d{6,7})$/', $this->faker->phoneNumber());
        }
    }

    public function testCellPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^02[1279]\d{6,7}$/', $this->faker->cellPhoneNumber());
            $this->assertMatchesRegularExpression('/^02[1279] \d{3} \d{3,4}$/', $this->faker->spacedCellPhoneNumber());
        }
    }

    public function testLandlinePhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^0[34679]\d{7}$/', $this->faker->landlinePhoneNumber());
            $this->assertMatchesRegularExpression('/^0[34679] \d{3} \d{4}$/', $this->faker->spacedLandlinePhoneNumber());
        }
    }

    public function testIndicatoredPhoneNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\+64([34679]\d{7}|2[1279]\d{6,7})$/', $this->faker->indicatoredPhoneNumber());
            $this->assertMatchesRegularExpression('/^\+64 2[1279] \d{3} \d{3,4}$/', $this->faker->spacedIndicatoredCellPhoneNumber());
            $this->assertMatchesRegularExpression('/^\+64 [34679] \d{3} \d{4}$/', $this->faker->spacedIndicatoredLandlinePhoneNumber());
        }
    }
}
