<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Factories;

use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Module as BaseModule;
use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits\HasRoutes;
use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits\HasViews;

/**
 * Factories Module definition.
 */
class Module extends BaseModule
{
    use HasViews;
    use HasRoutes;

    protected static string $name = 'Factories';

    protected static string $baseView = 'lvdb::modules.factories';

    protected static string $route = 'lara-vel-dev-buddy.factories';

    protected static string $icon = 'factory';

}