<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Routes;

use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Module as BaseModule;
use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits\HasRoutes;
use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits\HasViews;

/**
 * Routes Module definition.
 */
class Module extends BaseModule
{
    use HasViews;
    use HasRoutes;

    protected static string $name = 'Routes';

    protected static string $baseView = 'lvdb::modules.routes';

    protected static string $route = 'lara-vel-dev-buddy.routes';

    protected static string $icon = 'route';

}