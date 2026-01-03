<?php

namespace Chilly2go\NovaPermissions\Tests;

use Chilly2go\NovaPermissions\Http\Controllers\ToolController;
use Chilly2go\NovaPermissions\Tool;
use Symfony\Component\HttpFoundation\Response;

class ToolControllerTest extends TestCase
{
    /** @test */
    public function it_can_can_return_a_response()
    {
        $this
            ->get('nova-vendor/chilly2go/nova-permissions/endpoint')
            ->assertSuccessful();
    }
}
