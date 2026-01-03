<?php

namespace Chilly2go\NovaPermissions\Http\Middleware;

use Chilly2go\NovaPermissions\Tool;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authorize
{
    public function handle(Request $request, Closure $next): Response
    {
        return app(Tool::class)->authorize($request)
            ? $next($request)
            : abort(403);
    }
}
