<?php

namespace Atldays\Visitor\Contracts;

interface FingerprintContract
{
    public function fingerprint(VisitorContract $visitor): string;
}
