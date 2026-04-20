<?php

namespace Atldays\Visitor\Tests\Feature;

use Atldays\Visitor\Facades\Visitor as VisitorFacade;
use Atldays\Visitor\Tests\TestCase;
use Illuminate\Http\Request;

class VisitorFacadeTest extends TestCase
{
    public function test_facade_proxies_to_current_request_visitor(): void
    {
        $request = Request::create('/', 'GET', server: [
            'REMOTE_ADDR' => '8.8.4.4',
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36',
            'HTTP_ACCEPT_LANGUAGE' => 'uk-UA,uk;q=0.9,en-US;q=0.8,en;q=0.7',
        ]);

        $this->app->instance('request', $request);

        $this->assertSame('8.8.4.4', VisitorFacade::ip());
        $this->assertSame('Chrome', VisitorFacade::agent()->browser()?->name());
        $this->assertSame('uk_UA', VisitorFacade::language()->language());
    }
}
