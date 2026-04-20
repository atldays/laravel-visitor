<?php

namespace Atldays\Visitor\Contracts;

use Illuminate\Contracts\Support\Arrayable;

interface LanguageContract extends Arrayable
{
    /**
     * Get the most preferred language from the visitor request.
     */
    public function language(): ?string;

    /**
     * Get all accepted languages ordered by visitor preference.
     *
     * @return string[]
     */
    public function languages(): array;
}
