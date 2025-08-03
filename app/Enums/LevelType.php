<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class LevelType extends Enum
{
    const BEGINNER = 'beginner';
    const INTERMEDIATE = 'intermediate';
    const ADVANCED = 'advanced';

    /**
     * Get the description of the enum value.
     *
     * @return string
     */
    public function description(): string
    {
        return match ($this) {
            self::BEGINNER => 'Beginner Level',
            self::INTERMEDIATE => 'Intermediate Level',
            self::ADVANCED => 'Advanced Level',
        };
    }

    /**
     * Get the label for the enum value.
     *
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::BEGINNER => 'Beginner',
            self::INTERMEDIATE => 'Intermediate',
            self::ADVANCED => 'Advanced',
        };
    }
}
