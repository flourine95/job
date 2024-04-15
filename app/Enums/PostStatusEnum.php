<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PostStatusEnum extends Enum
{
    const PENDING = 0;
    const ADMIN_PENDING = 1;
    const ADMIN_APPROVED = 2;


}
