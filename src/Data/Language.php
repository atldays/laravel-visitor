<?php

namespace Atldays\Visitor\Data;

use Atldays\Visitor\Contracts\LanguageContract;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;

class Language extends Data implements LanguageContract
{
    /**
     * @param string[] $languages
     */
    public function __construct(
        public readonly ?string $language = null,
        public readonly array $languages = [],
    ) {}

    public function language(): ?string
    {
        return $this->language;
    }

    public function languages(): array
    {
        return $this->languages;
    }

    public static function fromRequest(Request $request): self
    {
        return new static(
            language: $request->getPreferredLanguage(),
            languages: array_values(array_filter(
                $request->getLanguages(),
                static fn (mixed $language): bool => is_string($language) && $language !== '',
            )),
        );
    }

    public static function fromLanguage(LanguageContract $language): self
    {
        return new self(
            language: $language->language(),
            languages: array_values(array_filter(
                $language->languages(),
                static fn (mixed $item): bool => is_string($item) && $item !== '',
            )),
        );
    }
}
