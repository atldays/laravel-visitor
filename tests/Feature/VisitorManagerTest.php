<?php

namespace Atldays\Visitor\Tests\Feature;

use Atldays\Visitor\Contracts\VisitorContract;
use Atldays\Visitor\Tests\TestCase;
use Atldays\Visitor\VisitorManager;

class VisitorManagerTest extends TestCase
{
    public function test_manager_can_detect_explicit_visitor(): void
    {
        $visitor = $this->app->make(VisitorManager::class)->from(
            ip: '8.8.8.8',
            userAgent: 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36',
            language: [
                'language' => 'en-US',
                'languages' => ['en-US', 'en'],
            ],
        );

        $this->assertInstanceOf(VisitorContract::class, $visitor);
        $this->assertSame('8.8.8.8', $visitor->ip());
        $this->assertSame('Chrome', $visitor->agent()->browser()?->name());
        $this->assertSame('en-US', $visitor->language()->language());
        $this->assertSame(['en-US', 'en'], $visitor->language()->languages());
    }
}
