<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Controllers;

use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Module as BaseModule;
use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits\HasRoutes;
use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits\HasViews;

/**
 * Controllers Module definition.
 */
class Module extends BaseModule
{
    use HasViews;
    use HasRoutes;

    protected static string $name = 'Controllers';

    protected static string $baseView = 'lvdb::modules.controllers';

    protected static string $route = 'lara-vel-dev-buddy.controllers';

    protected static string $icon = 'merge';

}