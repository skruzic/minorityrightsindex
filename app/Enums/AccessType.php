<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Free()
 * @method static static Invite()
 */
final class AccessType extends Enum
{
    const Free = 1;
    const Invite = 2;
}
