<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Enums;

use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Module as BaseModule;
use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits\HasRoutes;
use MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits\HasViews;

/**
 * Enums Module definition.
 */
class Module extends BaseModule
{
    use HasViews;
    use HasRoutes;

    protected static string $name = 'Enums';

    protected static string $baseView = 'lvdb::modules.enums';

    protected static string $route = 'lara-vel-dev-buddy.enums';

    protected static string $icon = 'list';

}