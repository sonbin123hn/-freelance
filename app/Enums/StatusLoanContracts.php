<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusLoanContracts extends Enum
{
    const PENDING   = 0;
    const CANCEL    = 1;
    const SUCCESS   = 2;
}
