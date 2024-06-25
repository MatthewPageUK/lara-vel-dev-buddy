<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Migrations;

use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Module as BaseModule;
use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits\HasRoutes;
use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits\HasViews;

/**
 * Migrations Module definition.
 */
class Module extends BaseModule
{
    use HasViews;
    use HasRoutes;

    protected static string $name = 'Migrations';

    protected static string $baseView = 'lvdb::modules.migrations';

    protected static string $route = 'lara-vel-dev-buddy.migrations';

    protected static string $icon = 'change_circle';

}