<?php

namespace chilly2go\NovaPermissions\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['prepared_permissions'];

    /**
     * @return array
     */
    public function getPreparedPermissionsAttribute(): array
    {
        return $this->permissions->pluck('name')->toArray();
    }
}
