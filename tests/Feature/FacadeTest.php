<?php

namespace Atldays\Visitor\Tests\Feature;

use Atldays\Visitor\Facades\VisitorManager as VisitorManagerFacade;
use Atldays\Visitor\Tests\TestCase;
use Illuminate\Http\Request;

class FacadeTest extends TestCase
{
    public function test_facade_detect_returns_explicit_visitor(): void
    {
        $visitor = VisitorManagerFacade::from(
            '1.1.1.1',
            'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
            ['en'],
        );

        $this->assertSame('1.1.1.1', $visitor->ip());
        $this->assertTrue($visitor->agent()->isBot());
    }

    public function test_facade_proxies_to_current_request_visitor(): void
    {
        $request = Request::create('/', 'GET', server: [
            'REMOTE_ADDR' => '8.8.4.4',
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36',
        ]);

        $this->app->instance('request', $request);

        $visitor = VisitorManagerFacade::request();

        $this->assertSame('8.8.4.4', $visitor->ip());
        $this->assertSame('Chrome', $visitor->agent()->browser()?->name());
    }
}
