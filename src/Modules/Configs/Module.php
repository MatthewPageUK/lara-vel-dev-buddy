<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Configs;

use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Module as BaseModule;
use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits\HasRoutes;
use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits\HasViews;

/**
 * Configs Module definition.
 */
class Module extends BaseModule
{
    use HasViews;
    use HasRoutes;

    protected static string $name = 'Configs';

    protected static string $baseView = 'lvdb::modules.configs';

    protected static string $route = 'lara-vel-dev-buddy.configs';

    protected static string $icon = 'manufacturing';

}