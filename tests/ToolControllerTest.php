<?php

namespace Chilly2go\NovaPermissions\Tests;

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
