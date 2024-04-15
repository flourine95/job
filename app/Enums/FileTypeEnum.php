<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class FileTypeEnum extends Enum
{
    const JD = 1; // Job description
    const CV = 2; // Curriculum vitae
}
