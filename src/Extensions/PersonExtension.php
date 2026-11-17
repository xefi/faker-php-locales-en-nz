<?php

namespace Xefi\Faker\EnNz\Extensions;

use Xefi\Faker\Extensions\PersonExtension as BasePersonExtension;

class PersonExtension extends BasePersonExtension
{
    /**
     * The extension locale.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'en_NZ';
    }

    protected $firstNameMale = [
        'Oliver', 'Jack', 'Noah', 'Leo', 'George', 'Charlie', 'William', 'Lucas', 'James', 'Hunter',
        'Mason', 'Thomas', 'Arlo', 'Theodore', 'Luca', 'Hamish', 'Liam', 'Finn', 'Lachlan', 'Ryan',
        'Blake', 'Logan', 'Nikau', 'Ari', 'Tama', 'Wiremu', 'Rāwiri', 'Mikaere', 'Tāne', 'Manaia',
        'Kahu', 'Tamati', 'Hemi', 'Rangi', 'Matiu', 'Ethan', 'Jacob', 'Toby', 'Sam', 'Callum',
    ];

    protected $firstNameFemale = [
        'Isla', 'Charlotte', 'Amelia', 'Olivia', 'Mia', 'Ava', 'Willow', 'Harper', 'Lily', 'Ella',
        'Sophie', 'Grace', 'Ruby', 'Zoe', 'Georgia', 'Emma', 'Hannah', 'Aroha', 'Anahera', 'Kaia',
        'Maia', 'Mere', 'Ngaio', 'Moana', 'Hine', 'Kiri', 'Awhina', 'Tui', 'Aria', 'Matilda',
        'Evie', 'Poppy', 'Isabella', 'Stella', 'Hazel', 'Ivy', 'Rosie', 'Maddison', 'Frankie', 'Indie',
    ];

    protected $lastName = [
        'Smith', 'Williams', 'Brown', 'Wilson', 'Taylor', 'Jones', 'Singh', 'Anderson', 'Thompson', 'Walker',
        'Ngata', 'Tipene', 'Parata', 'Henare', 'Wihongi', 'Hohaia', 'Tapsell', 'Tamihana', 'Campbell', 'Kelly',
        'Robinson', 'Harris', 'Martin', 'King', 'Clark', 'Scott', 'Stewart', 'Young', 'Mitchell', 'Wood',
        'Hall', 'White', 'Patel', 'Lee', 'Murray', 'Morgan', 'Cooper', 'Edwards', 'Hughes', 'Ruawai',
    ];

    protected $titleMale = ['Mr', 'Dr', 'Prof', 'Rev', 'Sir'];

    protected $titleFemale = ['Ms', 'Mrs', 'Miss', 'Dr', 'Prof', 'Rev', 'Dame'];

    /**
     * Generate an Inland Revenue (IRD) number with a valid modulus 11 check digit, between 10,000,000 and 150,000,000.
     *
     * @param bool $formatted Whether to pad the number to 9 digits grouped as "NNN-NNN-NNN".
     *
     * @return string
     */
    public function irdNumber(bool $formatted = false): string
    {
        do {
            $base = sprintf('%08d', $this->randomizer->getInt(1000000, 14999999));
            $checkDigit = $this->irdCheckDigit($base, [3, 2, 7, 6, 5, 4, 3, 2]);

            if ($checkDigit === 10) {
                $checkDigit = $this->irdCheckDigit($base, [7, 4, 3, 2, 5, 2, 7, 6]);
            }
        } while ($checkDigit === 10);

        $ird = ltrim($base, '0').$checkDigit;

        return $formatted ? implode('-', str_split(sprintf('%09d', $ird), 3)) : $ird;
    }

    /**
     * Compute an IRD check digit with the given weights; 10 means the weights cannot produce a valid digit.
     *
     * @param string $base    The 8-digit zero-padded base number.
     * @param array  $weights
     *
     * @return int
     */
    protected function irdCheckDigit(string $base, array $weights): int
    {
        $sum = 0;
        foreach ($weights as $index => $weight) {
            $sum += (int) $base[$index] * $weight;
        }

        $remainder = $sum % 11;

        return $remainder === 0 ? 0 : 11 - $remainder;
    }
}
