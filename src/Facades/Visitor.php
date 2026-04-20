<?php

namespace Atldays\Visitor\Facades;

use Atldays\Agent\Contracts\AgentContract;
use Atldays\Geo\Contracts\GeoContract;
use Atldays\Visitor\Contracts\{LanguageContract, VisitorContract};
use Illuminate\Support\Facades\Facade;

/**
 * @method static string ip()
 * @method static string userAgent()
 * @method static LanguageContract language()
 * @method static string fingerprint()
 * @method static AgentContract agent()
 * @method static GeoContract geo()
 * @method static array toArray()
 *
 * @see VisitorContract
 */
class Visitor extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'visitor';
    }
}
