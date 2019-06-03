<?php

namespace Laravolt\Epicentrum;

use MyCLabs\Enum\Enum;

class Permission extends Enum
{
    const MANAGE_USER = 'epicentrum::manage-user';
    const MANAGE_ROLE = 'epicentrum::manage-role';
    const MANAGE_PERMISSION = 'epicentrum::manage-permission';
}
