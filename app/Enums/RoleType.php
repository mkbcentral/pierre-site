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
    const admin = 'admin';
    const student = 'student';
    const member = 'member';

    // description method can be added if needed
    public function description(): string
    {
        return match ($this) {
            self::admin => 'Administrator',
            self::student => 'Student',
            self::member => 'Member',
        };
    }

    // label method can be added if needed
    public function label(): string
    {
        return match ($this) {
            self::admin => 'Admin',
            self::student => 'Student',
            self::member => 'Member',
        };
    }
}
