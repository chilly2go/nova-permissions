<?php

namespace chilly2go\NovaPermissions;

use chilly2go\NovaPermissions\Nova\Permission;
use chilly2go\NovaPermissions\Nova\Role;
use Illuminate\Http\Request;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool as BaseTool;

class Tool extends BaseTool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     */
    public function boot(): void
    {
        Nova::script('nova-permissions', __DIR__.'/../dist/js/tool.js');
        Nova::style('nova-permissions', __DIR__.'/../dist/css/tool.css');

        Nova::resources([
            Permission::class,
            Role::class,
        ]);
    }

    /**
     * Build the view that renders the navigation links for the tool.
     */
    public function renderNavigation(): \Illuminate\View\View
    {
        return view('nova-permissions::navigation');
    }
    //    ErrorException: file_get_contents(/home/chilly/PhpstormProjects/nova-permissions/src/../dist/css/tool.css): Failed to open stream: No such file or directory in file /var/www/vendor/laravel/nova/src/Asset.php on line 115

    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Roles & Permissions';
    }

    /**
     * We use the Tool as entry point. We actually rely on a new Field and 2 Resources using said field.
     */
    public function menu(Request $request)
    {
        return null;
    }
}
