<?php

namespace Atldays\Visitor\Fingerprints;

use Atldays\Visitor\Contracts\{FingerprintContract, VisitorContract};

class IpUserAgent implements FingerprintContract
{
    public function fingerprint(VisitorContract $visitor): string
    {
        return hash('sha256', implode('|', [
            $visitor->ip(),
            $visitor->userAgent(),
        ]));
    }
}
