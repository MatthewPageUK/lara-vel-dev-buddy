<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Models;

use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Module as BaseModule;
use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits\HasRoutes;
use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits\HasViews;

/**
 * Models Module definition.
 */
class Module extends BaseModule
{
    use HasViews;
    use HasRoutes;

    protected static string $name = 'Models';

    protected static string $baseView = 'lvdb::modules.models';

    protected static string $route = 'lara-vel-dev-buddy.models';

    protected static string $icon = 'widgets';

}