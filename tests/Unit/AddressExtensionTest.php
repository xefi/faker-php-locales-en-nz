<?php

namespace Xefi\Faker\EnNz\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\EnNz\Extensions\AddressExtension;

final class AddressExtensionTest extends TestCase
{
    protected array $regions = [];
    protected array $postcodeRanges = [];
    protected array $cities = [];
    protected array $streetTypes = [];
    protected array $streetNames = [];

    protected function setUp(): void
    {
        parent::setUp();

        $addressExtension = new AddressExtension(new Randomizer());
        $reflection = new ReflectionClass($addressExtension);

        $this->regions = $reflection->getProperty('regions')->getValue($addressExtension);
        $this->postcodeRanges = $reflection->getProperty('postcodeRanges')->getValue($addressExtension);
        $this->cities = $reflection->getProperty('cities')->getValue($addressExtension);
        $this->streetTypes = $reflection->getProperty('streetTypes')->getValue($addressExtension);
        $this->streetNames = $reflection->getProperty('streetNames')->getValue($addressExtension);
    }

    public function testRegion(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->regions); $i++) {
            $results[] = $this->faker->unique()->region();
        }

        $this->assertEqualsCanonicalizing(
            $this->regions,
            $results
        );
    }

    public function testCity(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->cities); $i++) {
            $results[] = $this->faker->unique()->city();
        }

        $this->assertEqualsCanonicalizing(
            array_keys($this->cities),
            $results
        );
    }

    public function testCitiesAndPostcodesBelongToARegion(): void
    {
        foreach ($this->cities as $region) {
            $this->assertContains($region, $this->regions);
        }

        $this->assertEqualsCanonicalizing($this->regions, array_keys($this->postcodeRanges));
    }

    public function testPostcode(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $postcode = $this->faker->postcode();

            $this->assertMatchesRegularExpression('/^\d{4}$/', $postcode);
            $this->assertGreaterThanOrEqual(110, (int) $postcode);
            $this->assertLessThanOrEqual(9898, (int) $postcode);
        }
    }

    public function testHouseNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $houseNumber = $this->faker->houseNumber();

            $this->assertGreaterThanOrEqual(1, $houseNumber);
            $this->assertLessThanOrEqual(300, $houseNumber);
        }
    }

    public function testStreetName(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $streetName = $this->faker->streetName();
            $separator = strrpos($streetName, ' ');

            $this->assertContains(substr($streetName, 0, $separator), $this->streetNames);
            $this->assertContains(substr($streetName, $separator + 1), $this->streetTypes);
        }
    }

    public function testStreetAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\d{1,3} [A-Za-z ]+$/', $this->faker->streetAddress());
        }
    }

    public function testFullAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $fullAddress = $this->faker->fullAddress();

            $this->assertMatchesRegularExpression('/^\d{1,3} [A-Za-z ]+, (\X+) (\d{4})$/u', $fullAddress);

            preg_match('/, (\X+) (\d{4})$/u', $fullAddress, $matches);
            [, $city, $postcode] = $matches;
            [$min, $max] = $this->postcodeRanges[$this->cities[$city]];

            $this->assertGreaterThanOrEqual($min, (int) $postcode);
            $this->assertLessThanOrEqual($max, (int) $postcode);
        }
    }
}
