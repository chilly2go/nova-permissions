# Changelog

All notable changes to `nova-permissions` will be documented in this file

## v1.0.2 - 2026-01-04

- Remove absolute positioning of permissions container in Form Field to prevent overflow resulting in hidden permissions
- Move translation from JS to Nova (with fallback to remove prefix for permissions)
- Role Index shows pills to indicate permissions. If viewed through relations the Checkbox responsible for this display has a wrong value. So this part is hidden for roles index view through relations (i.e. User -> Roles on User Resource Details View)

## 1.0.1 - 2026-01-03

Nova 4 Package for managing spatie/permissions based on https://github.com/GrapheneICT/nova-permissions

And a patch version bump for styling fixes

## 1.0.0 - 2026-01-02

- initial release with spatie/laravel-permission v6.1 for Laravel Nova 4
