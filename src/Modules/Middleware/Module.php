<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Middleware;

use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Module as BaseModule;
use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits\HasRoutes;
use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits\HasViews;

/**
 * Middleware Module definition.
 */
class Module extends BaseModule
{
    use HasViews;
    use HasRoutes;

    protected static string $name = 'Middleware';

    protected static string $baseView = 'lvdb::modules.middleware';

    protected static string $route = 'lara-vel-dev-buddy.middleware';

    protected static string $icon = 'recenter';

}