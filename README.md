
[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/support-ukraine.svg?t=1" />](https://supportukrainenow.org)

# Nova Permissions tool based on spatie permissions

[//]: # ([![Latest Version on Packagist]&#40;https://img.shields.io/packagist/v/chilly2go/nova-permissions.svg?style=flat-square&#41;]&#40;https://packagist.org/packages/chilly2go/nova-permissions&#41;)
![CircleCI branch](https://img.shields.io/circleci/project/github/chilly2go/nova-permissions/master.svg?style=flat-square)
[![Build Status](https://img.shields.io/travis/chilly2go/nova-permissions/master.svg?style=flat-square)](https://travis-ci.org/chilly2go/nova-permissions)
[![Quality Score](https://img.shields.io/scrutinizer/g/chilly2go/nova-permissions.svg?style=flat-square)](https://scrutinizer-ci.com/g/chilly2go/nova-permissions)

[//]: # ([![Total Downloads]&#40;https://img.shields.io/packagist/dt/chilly2go/nova-permissions.svg?style=flat-square&#41;]&#40;https://packagist.org/packages/chilly2go/nova-permissions&#41;)

I liked how [GrapheneICT/nova-permissions](https://github.com/GrapheneICT/nova-permissions) looked. 
But it lacked nova 4 support.
So here is what I think might be an "ok" take on working with Nova 4 and Spatie/Permissions v6.


## Installation

You can install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require chilly2go/nova-permissions
```

Next up, you must register the tool with Nova. This is typically done in the `tools` method of the `NovaServiceProvider`.
By adding the tool the included Field and Resources are being registered.

```php
// in app/Providers/NovaServiceProvider.php

// ...

public function tools()
{
    return [
        // ...
        new \chilly2go\NovaPermissions\Tool,
    ];
}
```

## Publishing assets

### Database migrations
This migration adds a new column to the permissions table for grouping permissions.
This is required for this package to work.
It will initially iterate all permissions and try to set a reasonable default group based on the permission name.
```bash
php artisan vendor:publish --provider="chilly2go\NovaPermissions\ToolServiceProvider" --tag="migrations"
```


### Config Files
This is optional and allows adjustments for Nova resource groups and translation prefix
```bash
php artisan vendor:publish --provider="chilly2go\NovaPermissions\ToolServiceProvider" --tag="config"
```


### Translation
There is a translation file included that (by running the command below) will publish the translations to your projects lang folder.
This is setup this way to allow easy enhancement for group name translations.

```bash
php artisan vendor:publish --provider="chilly2go\NovaPermissions\ToolServiceProvider" --tag="lang"
```

## Usage

By adding the tool in your ServiceProvider the Field and Resources are being registered.
Resources will be shown in the Nova sidebar based on the configuration in the config file.

I have not yet found a way to set `displayInNavigation` from a function call (`config('...')`) so those two settings are without a function.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email code@chilly2go.de instead of using the issue tracker.

## Credits

- [chilly2go](https://github.com/chilly2go)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
