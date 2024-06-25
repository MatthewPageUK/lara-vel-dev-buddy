<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Commands;

use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Module as BaseModule;
use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits\HasRoutes;
use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits\HasViews;

/**
 * Commands Module definition.
 */
class Module extends BaseModule
{
    use HasViews;
    use HasRoutes;

    protected static string $name = 'Commands';

    protected static string $baseView = 'lvdb::modules.commands';

    protected static string $route = 'lara-vel-dev-buddy.commands';

    protected static string $icon = 'terminal';

}