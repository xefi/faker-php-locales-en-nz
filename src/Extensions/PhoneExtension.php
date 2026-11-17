<?php

namespace Xefi\Faker\EnNz\Extensions;

use Xefi\Faker\Extensions\PhoneExtension as BasePhoneExtension;

class PhoneExtension extends BasePhoneExtension
{
    public string $defaultPrefix = '0';

    public string $indicator = '+64';

    protected array $landlineFormats = [
        '3{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '4{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '6{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '7{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '9{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
    ];

    protected array $cellFormats = [
        '21{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '21{separator}{d}{d}{d}{separator}{d}{d}{d}',
        '22{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '27{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
        '29{separator}{d}{d}{d}{separator}{d}{d}{d}{d}',
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
     * Generate a phone number, dropping the trunk prefix "0" in favour of the separated "+64" indicator.
     *
     * @param string|null $format
     * @param string      $separator
     * @param string|null $prefix
     *
     * @return string
     */
    public function phoneNumber(?string $format = null, string $separator = '', ?string $prefix = null): string
    {
        if ($format === null) {
            $format = $this->pickArrayRandomElement(array_merge($this->landlineFormats, $this->cellFormats));
        }

        if ($prefix === $this->indicator) {
            $prefix .= $separator;
        }

        return parent::phoneNumber($format, $separator, $prefix);
    }
}
