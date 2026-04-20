<?php

namespace Atldays\Visitor\Tests\Feature;

use Atldays\Visitor\Contracts\{FingerprintContract, VisitorContract};
use Atldays\Visitor\Tests\TestCase;
use Atldays\Visitor\VisitorManager;

class FingerprintTest extends TestCase
{
    public function test_custom_fingerprint_driver_can_be_configured(): void
    {
        $this->app['config']->set('visitor.fingerprint.driver', TestFingerprint::class);

        $visitor = $this->app->make(VisitorManager::class)->from(
            ip: '8.8.8.8',
            userAgent: 'UnitTest/1.0',
            language: [
                'language' => 'uk',
                'languages' => ['uk', 'en'],
            ],
        );

        $this->assertSame('8.8.8.8|UnitTest/1.0|uk,en', $visitor->fingerprint());
    }
}

class TestFingerprint implements FingerprintContract
{
    public function fingerprint(VisitorContract $visitor): string
    {
        return implode('|', [
            $visitor->ip(),
            $visitor->userAgent(),
            implode(',', $visitor->language()->languages()),
        ]);
    }
}
