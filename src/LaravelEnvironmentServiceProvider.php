<?php

namespace AVASTechnology\LaravelEnvironment;

use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelEnvironmentServiceProvider
 *
 * @package AVASTechnology\LaravelEnvironment
 */
class LaravelEnvironmentServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Registering package commands.
        $this->commands(
            [
                EnvironmentCommand::class
            ]
        );
    }
}
