<?php

namespace Atldays\Visitor\Tests\Feature;

use Atldays\Visitor\Contracts\VisitorContract;
use Atldays\Visitor\Tests\TestCase;
use Illuminate\Http\Request;

class RequestMacroTest extends TestCase
{
    public function test_request_macro_returns_visitor_instance(): void
    {
        $request = Request::create('/', 'GET', server: [
            'HTTP_X_FORWARDED_FOR' => '10.0.0.1, 8.8.8.8',
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36',
            'HTTP_ACCEPT_LANGUAGE' => 'en-US,en;q=0.9,de-DE;q=0.8,de;q=0.7',
        ]);

        $visitor = $request->visitor();

        $this->assertInstanceOf(VisitorContract::class, $visitor);
        $this->assertSame('8.8.8.8', $visitor->ip());
        $this->assertSame('Chrome', $visitor->agent()->browser()?->name());
        $this->assertSame('en_US', $visitor->language()->language());
        $this->assertSame(['en_US', 'en', 'de_DE', 'de'], $visitor->language()->languages());
    }
}
