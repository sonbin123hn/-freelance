<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SexType extends Enum
{
    public const MALE = 0;
    public const FEMALE = 1;
    public const OTHER = 2;
}
