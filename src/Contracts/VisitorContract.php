<?php

namespace Atldays\Visitor\Contracts;

use Atldays\Agent\Contracts\AgentContract;
use Atldays\Geo\Contracts\GeoContract;
use Illuminate\Contracts\Support\Arrayable;

interface VisitorContract extends Arrayable
{
    public function ip(): string;

    public function userAgent(): string;

    public function language(): LanguageContract;

    public function fingerprint(): string;

    public function agent(): AgentContract;

    public function geo(): GeoContract;
}
