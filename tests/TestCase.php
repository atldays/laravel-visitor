<?php

namespace Atldays\Visitor\Tests;

use Atldays\Agent\AgentServiceProvider;
use Atldays\Geo\GeoServiceProvider;
use Atldays\Url\UrlServiceProvider;
use Atldays\Visitor\VisitorServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Spatie\LaravelData\LaravelDataServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelDataServiceProvider::class,
            UrlServiceProvider::class,
            AgentServiceProvider::class,
            GeoServiceProvider::class,
            VisitorServiceProvider::class,
        ];
    }
}
