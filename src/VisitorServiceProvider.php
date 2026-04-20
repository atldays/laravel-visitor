<?php

namespace Atldays\Visitor;

use Atldays\Visitor\Contracts\{FingerprintContract, VisitorContract};
use Atldays\Visitor\Exceptions\InvalidFingerprintDriver;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Spatie\LaravelPackageTools\{Package, PackageServiceProvider};

class VisitorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-visitor')
            ->hasConfigFile('visitor');
    }

    public function registeringPackage(): void
    {
        $this->app->bind(FingerprintContract::class, function (Application $app): FingerprintContract {
            $driver = $app->make('config')->get('visitor.fingerprint.driver');

            if (!is_string($driver) || !is_a($driver, FingerprintContract::class, true)) {
                throw InvalidFingerprintDriver::make($driver, FingerprintContract::class);
            }

            return $app->make($driver);
        });

        $this->app->singleton(VisitorManager::class);

        $this->app->bind(VisitorContract::class, fn (Application $app) => $app->make(VisitorManager::class)->request());

        $this->app->alias(VisitorContract::class, 'visitor');
    }

    public function packageBooted(): void
    {
        Request::macro('visitor', function () {
            /** @var Request $this */
            return App::make(VisitorManager::class)->request($this);
        });
    }
}
