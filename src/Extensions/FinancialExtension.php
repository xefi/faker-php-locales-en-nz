<?php

namespace Xefi\Faker\EnNz\Extensions;

use Xefi\Faker\Extensions\FinancialExtension as BaseFinancialExtension;

class FinancialExtension extends BaseFinancialExtension
{
    protected array $bankCodes = ['01', '02', '03', '06', '11', '12', '15', '38'];

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
     * New Zealand does not use IBAN: this builds an IBAN-shaped string from a 2-digit bank code,
     * a 4-digit branch, a 7-digit account number and a 2-digit suffix.
     *
     * @param string|null $countryCode
     * @param string|null $format      [{d} => digit, {l} => letter, {a} => any]
     *
     * @return string
     */
    public function iban(?string $countryCode = null, ?string $format = null): string
    {
        if ($countryCode === null) {
            $countryCode = 'NZ';
        }

        if ($format === null) {
            $format = sprintf(
                '%s%s%s%s',
                $this->pickArrayRandomElement($this->bankCodes),
                str_repeat('{d}', 4),
                str_repeat('{d}', 7),
                str_repeat('{d}', 2)
            );
        }

        return parent::iban($countryCode, $format);
    }
}
