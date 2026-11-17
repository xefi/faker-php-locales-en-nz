<?php

namespace Xefi\Faker\EnNz\Extensions;

use Xefi\Faker\Extensions\ColorsExtension as BaseColorsExtension;

class ColorsExtension extends BaseColorsExtension
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

    protected array $safeColorNames = [
        'Black', 'Maroon', 'Green', 'Navy', 'Olive',
        'Purple', 'Teal', 'Lime', 'Blue', 'Silver',
        'Grey', 'Yellow', 'Fuchsia', 'Aqua', 'White',
    ];

    protected array $colorNames = [
        'Black', 'Maroon', 'Green', 'Navy', 'Olive',
        'Purple', 'Teal', 'Lime', 'Blue', 'Silver',
        'Grey', 'Yellow', 'Fuchsia', 'Aqua', 'White',
        'Beige', 'Chocolate', 'Coral', 'Cyan', 'Crimson',
        'DarkBlue', 'DarkOrange', 'FireBrick', 'SeaGreen', 'FloralWhite',
        'ForestGreen', 'Gold', 'Pink', 'Indigo', 'Khaki',
        'Lavender', 'LightBlue', 'LightCoral', 'LightGreen', 'LightSalmon',
        'Linen', 'Magenta', 'MediumBlue', 'MediumOrchid', 'Moccasin',
        'Orange', 'Red', 'Plum', 'Peru', 'RoyalBlue',
        'Salmon', 'SandyBrown', 'SkyBlue', 'Snow', 'Turquoise',
        'Violet', 'WhiteSmoke',
    ];
}
