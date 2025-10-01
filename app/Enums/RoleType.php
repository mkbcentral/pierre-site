<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RoleType extends Enum
{
    const ADMIN = 'admin';
    const STUDENT = 'student';
    const MEMBER = 'member';

    // description method can be added if needed
    public function description(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrator',
            self::STUDENT => 'Student',
            self::MEMBER => 'Member',
        };
    }

    // label method can be added if needed
    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::STUDENT => 'Student',
            self::MEMBER => 'Member',
        };
    }
}
