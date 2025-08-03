<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TrainingStatusType extends Enum
{
    const DRAFT = 'draft';
    const PUBLISHED = 'published';
    const ARCHIVED = 'archived';
    const   CANCELED = 'canceled';

    /**
     * Get the description of the enum value.
     *
     * @return string
     */
    public function description(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft Status',
            self::PUBLISHED => 'Published Status',
            self::ARCHIVED => 'Archived Status',
            self::CANCELED => 'Canceled Status',
        };
    }
}
