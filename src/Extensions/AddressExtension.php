<?php

namespace Xefi\Faker\EnNz\Extensions;

use Xefi\Faker\Extensions\Extension;

class AddressExtension extends Extension
{
    protected $regions = [
        'Northland', 'Auckland', 'Waikato', 'Bay of Plenty', 'Gisborne', 'Hawke\'s Bay', 'Taranaki',
        'Manawatū-Whanganui', 'Wellington', 'Tasman', 'Nelson', 'Marlborough', 'West Coast', 'Canterbury',
        'Otago', 'Southland',
    ];

    protected $postcodeRanges = [
        'Northland' => [110, 599], 'Auckland' => [600, 2699], 'Waikato' => [3200, 3999], 'Bay of Plenty' => [3010, 3199],
        'Gisborne' => [4010, 4099], 'Hawke\'s Bay' => [4100, 4299], 'Taranaki' => [4310, 4399],
        'Manawatū-Whanganui' => [4410, 4999], 'Wellington' => [5010, 6972], 'Tasman' => [7020, 7199],
        'Nelson' => [7010, 7011], 'Marlborough' => [7201, 7299], 'West Coast' => [7800, 7895],
        'Canterbury' => [7300, 8999], 'Otago' => [9010, 9599], 'Southland' => [9810, 9898],
    ];

    protected $cities = [
        'Auckland' => 'Auckland', 'Wellington' => 'Wellington', 'Christchurch' => 'Canterbury', 'Hamilton' => 'Waikato',
        'Tauranga' => 'Bay of Plenty', 'Dunedin' => 'Otago', 'Palmerston North' => 'Manawatū-Whanganui',
        'Napier' => 'Hawke\'s Bay', 'Hastings' => 'Hawke\'s Bay', 'Nelson' => 'Nelson', 'Rotorua' => 'Bay of Plenty',
        'New Plymouth' => 'Taranaki', 'Whangārei' => 'Northland', 'Invercargill' => 'Southland',
        'Whanganui' => 'Manawatū-Whanganui', 'Gisborne' => 'Gisborne', 'Blenheim' => 'Marlborough',
        'Timaru' => 'Canterbury', 'Queenstown' => 'Otago', 'Masterton' => 'Wellington', 'Lower Hutt' => 'Wellington',
        'Porirua' => 'Wellington', 'Upper Hutt' => 'Wellington', 'Taupō' => 'Waikato', 'Greymouth' => 'West Coast',
        'Ashburton' => 'Canterbury', 'Levin' => 'Manawatū-Whanganui', 'Richmond' => 'Tasman', 'Oamaru' => 'Otago',
        'Whakatāne' => 'Bay of Plenty',
    ];

    protected $streetTypes = [
        'Street', 'Road', 'Avenue', 'Drive', 'Crescent', 'Place', 'Terrace', 'Lane', 'Grove', 'Way',
        'Close', 'Parade', 'Quay',
    ];

    protected $streetNames = [
        'Queen', 'Lambton', 'Cuba', 'Colombo', 'Princes', 'George', 'Victoria', 'Willis', 'Karangahape', 'Ponsonby',
        'Dominion', 'Manners', 'Riccarton', 'Papanui', 'Hagley', 'Kowhai', 'Rimu', 'Totara', 'Matai', 'Puriri',
        'Kauri', 'Pohutukawa', 'Tui', 'Moana', 'Rata', 'Miro', 'Nikau', 'Harakeke', 'Seddon', 'Ballance',
        'Hobson', 'Fitzroy', 'Grey', 'Selwyn', 'Wakefield', 'Rutherford', 'Hillary', 'Sheppard',
    ];

    /**
     * The extension locale.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'en_NZ';
    }

    /**
     * Return a random region.
     *
     * @return string
     */
    public function region(): string
    {
        return $this->pickArrayRandomElement($this->regions);
    }

    /**
     * Return a random city or town.
     *
     * @return string
     */
    public function city(): string
    {
        return $this->pickArrayRandomKey($this->cities);
    }

    /**
     * Return a random 4-digit postcode, within the range of a random region.
     *
     * @return string
     */
    public function postcode(): string
    {
        return $this->postcodeForRegion($this->pickArrayRandomElement($this->regions));
    }

    /**
     * Return a random house number.
     *
     * @return int
     */
    public function houseNumber(): int
    {
        return $this->randomizer->getInt(1, 300);
    }

    /**
     * Return a random street name followed by its street type.
     *
     * @return string
     */
    public function streetName(): string
    {
        return sprintf(
            '%s %s',
            $this->pickArrayRandomElement($this->streetNames),
            $this->pickArrayRandomElement($this->streetTypes)
        );
    }

    /**
     * Return a random street address.
     *
     * @return string
     */
    public function streetAddress(): string
    {
        return sprintf('%d %s', $this->houseNumber(), $this->streetName());
    }

    /**
     * Return a full address on one line, following the NZ Post order: street address, town and postcode.
     *
     * @return string
     */
    public function fullAddress(): string
    {
        $city = $this->city();

        return sprintf('%s, %s %s', $this->streetAddress(), $city, $this->postcodeForRegion($this->cities[$city]));
    }

    /**
     * Return a random postcode within the range of the given region.
     *
     * @param string $region
     *
     * @return string
     */
    protected function postcodeForRegion(string $region): string
    {
        [$min, $max] = $this->postcodeRanges[$region];

        return sprintf('%04d', $this->randomizer->getInt($min, $max));
    }
}
