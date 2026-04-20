<?php

namespace Atldays\Visitor\Tests\Feature;

use Atldays\Visitor\Contracts\LanguageContract;
use Atldays\Visitor\Data\Language;
use Atldays\Visitor\Tests\TestCase;
use Illuminate\Http\Request;

class LanguageDataTest extends TestCase
{
    public function test_language_can_be_created_from_request(): void
    {
        $request = Request::create('/', 'GET', server: [
            'HTTP_ACCEPT_LANGUAGE' => 'en-US,en;q=0.9,de-DE;q=0.8,de;q=0.7',
        ]);

        $language = Language::fromRequest($request);

        $this->assertSame('en_US', $language->language());
        $this->assertSame(['en_US', 'en', 'de_DE', 'de'], $language->languages());
    }

    public function test_language_can_be_created_from_language_contract(): void
    {
        $language = Language::fromLanguage(new class implements LanguageContract
        {
            public function language(): ?string
            {
                return 'en-US';
            }

            public function languages(): array
            {
                return ['en-US', '', 'en'];
            }

            public function toArray(): array
            {
                return [
                    'language' => $this->language(),
                    'languages' => $this->languages(),
                ];
            }
        });

        $this->assertSame('en-US', $language->language());
        $this->assertSame(['en-US', 'en'], $language->languages());
    }
}
