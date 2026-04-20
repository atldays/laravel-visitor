<?php

namespace Atldays\Visitor;

use Atldays\Agent\Contracts\AgentContract;
use Atldays\Geo\Contracts\GeoContract;
use Atldays\Visitor\Contracts\{FingerprintContract, LanguageContract, VisitorContract};

readonly class Visitor implements VisitorContract
{
    public function __construct(
        private string $ip,
        private string $userAgent,
        private LanguageContract $language,
        private AgentContract $agent,
        private GeoContract $geo,
        private FingerprintContract $fingerprint,
    ) {}

    public function ip(): string
    {
        return $this->ip;
    }

    public function userAgent(): string
    {
        return $this->userAgent;
    }

    public function language(): LanguageContract
    {
        return $this->language;
    }

    public function fingerprint(): string
    {
        return $this->fingerprint->fingerprint($this);
    }

    public function agent(): AgentContract
    {
        return $this->agent;
    }

    public function geo(): GeoContract
    {
        return $this->geo;
    }

    public function toArray(): array
    {
        return [
            'ip' => $this->ip(),
            'user_agent' => $this->userAgent(),
            'language' => $this->language()->toArray(),
            'fingerprint' => $this->fingerprint(),
            'agent' => $this->agent()->toArray(),
            'geo' => $this->geo()->toArray(),
        ];
    }
}
