<?php

namespace Atldays\Visitor\Tests\Feature;

use Atldays\Visitor\Contracts\FingerprintContract;
use Atldays\Visitor\Exceptions\InvalidFingerprintDriver;
use Atldays\Visitor\Tests\TestCase;

class InvalidFingerprintDriverTest extends TestCase
{
    public function test_it_rejects_invalid_fingerprint_driver_configuration(): void
    {
        $this->app['config']->set('visitor.fingerprint.driver', \stdClass::class);

        $this->expectException(InvalidFingerprintDriver::class);
        $this->expectExceptionMessage(sprintf(
            'Configured fingerprint driver [%s] must implement [%s].',
            \stdClass::class,
            FingerprintContract::class,
        ));

        $this->app->make(FingerprintContract::class);
    }
}
