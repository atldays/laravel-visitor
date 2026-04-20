<?php

namespace Atldays\Visitor\Tests\Feature;

use Atldays\Visitor\Tests\TestCase;
use Atldays\Visitor\VisitorManager;

class DefaultFingerprintTest extends TestCase
{
    public function test_default_fingerprint_driver_hashes_ip_and_user_agent(): void
    {
        $visitor = $this->app->make(VisitorManager::class)->from(
            ip: '8.8.8.8',
            userAgent: 'UnitTest/1.0',
        );

        $this->assertSame(
            hash('sha256', '8.8.8.8|UnitTest/1.0'),
            $visitor->fingerprint(),
        );
    }
}
