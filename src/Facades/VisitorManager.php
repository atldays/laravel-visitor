<?php

namespace Atldays\Visitor\Facades;

use Atldays\Visitor\VisitorManager as VisitorManagerService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Atldays\Visitor\Contracts\VisitorContract from(string $ip, string $userAgent, array|\Atldays\Visitor\Contracts\LanguageContract $language = [])
 * @method static \Atldays\Visitor\Contracts\VisitorContract request(?\Illuminate\Http\Request $request = null)
 * @method static string ip(?\Illuminate\Http\Request $request = null)
 * @method static string userAgent(?\Illuminate\Http\Request $request = null)
 * @method static \Atldays\Visitor\Contracts\LanguageContract language(?\Illuminate\Http\Request $request = null)
 * @method static string fingerprint(?\Illuminate\Http\Request $request = null)
 * @method static \Atldays\Agent\Contracts\AgentContract agent(?\Illuminate\Http\Request $request = null)
 * @method static \Atldays\Geo\Contracts\GeoContract geo(?\Illuminate\Http\Request $request = null)
 * @method static array toArray(?\Illuminate\Http\Request $request = null)
 *
 * @see VisitorManagerService
 */
class VisitorManager extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return VisitorManagerService::class;
    }
}
