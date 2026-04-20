<?php

namespace Atldays\Visitor\Exceptions;

use InvalidArgumentException;

class InvalidFingerprintDriver extends InvalidArgumentException
{
    public static function make(mixed $driver, string $contract): self
    {
        return new self(sprintf(
            'Configured fingerprint driver [%s] must implement [%s].',
            is_string($driver) ? $driver : get_debug_type($driver),
            $contract,
        ));
    }
}
