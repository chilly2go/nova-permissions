<?php

return [
    'show_in_navigation' => [
        'role' => env('TRANSLATION_ROLE_SHOW_IN_NAVIGATION', true),
        'permission' => env('TRANSLATION_PERMISSION_SHOW_IN_NAVIGATION', true),
    ],
    'resource_group' => [
        'role' => env('TRANSLATION_ROLE_RESOURCE_GROUP', 'permissions.Permissions'),
        'permission' => env('TRANSLATION_PERMISSION_RESOURCE_GROUP', 'permissions.Permissions'),
    ],
    'translation_prefix' => env('TRANSLATION_PREFIX', 'permissions.'),
    'separate_groups_and_permissions' => env('SEPARATE_GROUPS_AND_PERMISSIONS', false),
];
