<?php

namespace Xefi\Faker\EnNz\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\Extensions\PersonExtension;

final class PersonExtensionTest extends TestCase
{
    protected array $firstNameMale = [];
    protected array $firstNameFemale = [];
    protected array $lastName = [];
    protected array $titleMale = [];
    protected array $titleFemale = [];

    protected function setUp(): void
    {
        parent::setUp();

        $personExtension = new \Xefi\Faker\EnNz\Extensions\PersonExtension(new Randomizer());
        $reflection = new ReflectionClass($personExtension);

        $this->firstNameMale = $reflection->getProperty('firstNameMale')->getValue($personExtension);
        $this->firstNameFemale = $reflection->getProperty('firstNameFemale')->getValue($personExtension);
        $this->lastName = $reflection->getProperty('lastName')->getValue($personExtension);
        $this->titleMale = $reflection->getProperty('titleMale')->getValue($personExtension);
        $this->titleFemale = $reflection->getProperty('titleFemale')->getValue($personExtension);
    }

    public function testFirstNameFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameFemale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->firstNameFemale,
            $results
        );
    }

    public function testFirstNameMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameMale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->firstNameMale,
            $results
        );
    }

    public function testFirstName(): void
    {
        $results = [];
        $firstNames = array_unique(array_merge($this->firstNameMale, $this->firstNameFemale));
        for ($i = 0; $i < count($firstNames); $i++) {
            $results[] = $this->faker->unique()->firstName();
        }

        $this->assertEqualsCanonicalizing(
            $firstNames,
            $results
        );
    }

    public function testLastName(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->lastName); $i++) {
            $results[] = $this->faker->unique()->lastName();
        }

        $this->assertEqualsCanonicalizing(
            $this->lastName,
            $results
        );
    }

    public function testName(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $gender = $this->faker->randomElement([null, PersonExtension::GENDER_MALE, PersonExtension::GENDER_FEMALE]);
            $firstNames = match ($gender) {
                PersonExtension::GENDER_MALE => $this->firstNameMale,
                PersonExtension::GENDER_FEMALE => $this->firstNameFemale,
                default => array_merge($this->firstNameMale, $this->firstNameFemale),
            };

            [$firstName, $lastName] = explode(' ', $this->faker->name($gender), 2);

            $this->assertContains($firstName, $firstNames);
            $this->assertContains($lastName, $this->lastName);
        }
    }

    public function testTitle(): void
    {
        $titles = array_unique(array_merge($this->titleFemale, $this->titleMale));

        $results = [];
        for ($i = 0; $i < count($titles); $i++) {
            $results[] = $this->faker->unique()->title();
        }

        $this->assertEqualsCanonicalizing(
            $titles,
            $results
        );
    }

    public function testTitleByGender(): void
    {
        for ($i = 0; $i < 50; $i++) {
            $this->assertContains($this->faker->title(PersonExtension::GENDER_MALE), $this->titleMale);
            $this->assertContains($this->faker->title(PersonExtension::GENDER_FEMALE), $this->titleFemale);
        }
    }

    public function testIrdNumber(): void
    {
        for ($i = 0; $i < 200; $i++) {
            $ird = $this->faker->irdNumber();

            $this->assertMatchesRegularExpression('/^[1-9]\d{7,8}$/', $ird);
            $this->assertGreaterThan(10000000, (int) $ird);
            $this->assertLessThan(150000000, (int) $ird);
            $this->assertTrue($this->isValidIrd($ird), "IRD number {$ird} has an invalid check digit.");
        }
    }

    public function testFormattedIrdNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $ird = $this->faker->irdNumber(true);

            $this->assertMatchesRegularExpression('/^\d{3}-\d{3}-\d{3}$/', $ird);
            $this->assertTrue($this->isValidIrd(str_replace('-', '', $ird)));
        }
    }

    public function testValidatorMatchesKnownIrdNumbers(): void
    {
        $this->assertTrue($this->isValidIrd('49091850'));
        $this->assertTrue($this->isValidIrd('35901981'));
        $this->assertTrue($this->isValidIrd('49098576'));
        $this->assertTrue($this->isValidIrd('136410132'));
        $this->assertFalse($this->isValidIrd('136410133'));
    }

    private function isValidIrd(string $ird): bool
    {
        $padded = sprintf('%09d', $ird);
        $base = substr($padded, 0, 8);

        foreach ([[3, 2, 7, 6, 5, 4, 3, 2], [7, 4, 3, 2, 5, 2, 7, 6]] as $weights) {
            $sum = 0;
            foreach ($weights as $index => $weight) {
                $sum += (int) $base[$index] * $weight;
            }

            $check = $sum % 11 === 0 ? 0 : 11 - $sum % 11;

            if ($check !== 10) {
                return $check === (int) $padded[8];
            }
        }

        return false;
    }
}
