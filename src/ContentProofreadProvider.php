<?php

declare(strict_types=1);

namespace SharpAPI\ContentProofread;

use Illuminate\Support\ServiceProvider;

/**
 * @api
 */
class ContentProofreadProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/sharpapi-content-proofread.php' => config_path('sharpapi-content-proofread.php'),
            ], 'sharpapi-content-proofread');
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Merge the package configuration with the app configuration.
        $this->mergeConfigFrom(
            __DIR__.'/../config/sharpapi-content-proofread.php', 'sharpapi-content-proofread'
        );
    }
}