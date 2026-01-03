<?php

namespace chilly2go\NovaPermissions;

use Chilly2go\NovaPermissions\Http\Middleware\Authorize;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../lang');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'nova-permissions');

        $this->publishes([
            __DIR__.'/../database/migrations/add_tool_columns_to_permission_tables.php.stub' => $this->getMigrationFileName('add_tool_columns_to_permission_tables.php'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../config/nova-permissions.php' => config_path('nova-permissions.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath(),
        ], 'lang');

        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            $loadTranslations = $this->loadTranslations();
            Nova::provideToScript([
                'translations' => $loadTranslations,
            ]);

            Nova::translations($loadTranslations);
        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        // Register nova routes
        Nova::router()->group(function ($router) {
            $path = 'permissions';
            $router->get($path, fn () => inertia('nova-permissions', ['basePath' => $path]));
        });

        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
            ->prefix('nova-vendor/chilly2go/nova-permissions')
            ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function getMigrationFileName(string $migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make([$this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR])
            ->flatMap(fn ($path) => $filesystem->glob($path.'*_'.$migrationFileName))
            ->push($this->app->databasePath()."/migrations/{$timestamp}_{$migrationFileName}")
            ->first();
    }

    protected function loadTranslations(): array
    {
        $directory = lang_path(app()->getLocale());
        $translations = [];

        if (! is_dir($directory)) { // fallback locale can still be something we don't have translations for
            $directory = lang_path(app()->getFallbackLocale());
        }

        if (! is_dir($directory)) {
            $directory = lang_path('en');
        }

        $prefix = config('nova-permissions.translation_prefix');
        $path = $directory.'/'.$prefix.'php';
        if (! is_file($path)) {
            $prefix = 'permissions.';
            $path = $directory.'/'.$prefix.'php';
        }

        if (is_file($path)) {
            $tmp = require $path;
            foreach ($tmp as $key => $value) {
                $translations[$prefix.$key] = $value;
            }
        }

        return $translations;
    }
}
