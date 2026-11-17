<?php

namespace Xefi\Faker\EnNz\Extensions;

use Xefi\Faker\Extensions\Extension;

class CompanyExtension extends Extension
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

    private array $companies = [
        'Kiwi Orchards Limited', 'Southern Alps Tourism Limited', 'Kauri Coast Timber Limited',
        'Aotearoa Digital Limited', 'Pohutukawa Property Group Limited', 'Tasman Bay Seafoods Limited',
        'Canterbury Plains Dairy Limited', 'Waitemata Harbour Ferries Limited', 'Fiordland Adventures Limited',
        'Hauraki Gulf Marine Limited', 'Central Otago Vineyards Limited', 'Rimutaka Engineering Limited',
        'Silver Fern Logistics Limited', 'Taranaki Energy Services Limited', 'Rangitoto Software Limited',
        'Coromandel Honey Company Limited', 'Waikato River Farms Limited', 'Kapiti Coast Builders Limited',
        'Tui Brewing Collective Limited', 'Mount Cook Insurance Limited', 'Ruapehu Ski Holdings Limited',
        'Northland Kumara Growers Limited', 'Hawke\'s Bay Fruitgrowers Limited', 'Te Anau Lodges Limited',
        'Marlborough Sounds Aquaculture Limited', 'Wellington Harbour Capital Limited', 'Otago Peninsula Wool Limited',
        'Bay of Islands Charters Limited', 'Nelson Lakes Consulting Limited', 'Manuka Health Products Limited',
    ];

    /**
     * Return a random company name.
     *
     * @return string
     */
    public function company(): string
    {
        return $this->pickArrayRandomElement($this->companies);
    }

    /**
     * Generate a Companies Office company number.
     *
     * @return string
     */
    public function companyNumber(): string
    {
        return (string) $this->randomizer->getInt(1000000, 8999999);
    }

    /**
     * Generate a New Zealand Business Number (NZBN): a GS1 GLN starting with 9429 and ending with a valid check digit.
     *
     * @return string
     */
    public function nzbn(): string
    {
        $base = '9429'.$this->randomizer->getBytesFromString('0123456789', 8);

        $sum = 0;
        foreach (str_split($base) as $index => $digit) {
            $sum += (int) $digit * ($index % 2 === 0 ? 1 : 3);
        }

        return $base.((10 - $sum % 10) % 10);
    }
}
