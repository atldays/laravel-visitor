<?php

namespace Atldays\Visitor\Fingerprints;

use Atldays\Visitor\Contracts\{FingerprintContract, VisitorContract};

class IpUserAgentGeo implements FingerprintContract
{
    public function fingerprint(VisitorContract $visitor): string
    {
        $geo = $visitor->geo();
        $continent = $geo->continent();
        $country = $geo->country();
        $city = $geo->city();

        return hash('sha256', implode('|', [
            $visitor->ip(),
            $visitor->userAgent(),
            $geo->provider(),
            $continent?->getExternalId() ?? $continent?->getName(),
            $country?->getExternalId() ?? $country?->getIsoCode(),
            $city?->getExternalId() ?? $city?->getName(),
        ]));
    }
}
