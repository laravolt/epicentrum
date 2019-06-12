<?php

namespace Laravolt\Epicentrum;

use BenSampo\Enum\Enum;

final class Permission extends Enum
{
    const MANAGE_USER = 'epicentrum::manage-user';
    const MANAGE_ROLE = 'epicentrum::manage-role';
    const MANAGE_PERMISSION = 'epicentrum::manage-permission';
}
