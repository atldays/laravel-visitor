<?php

namespace Atldays\Visitor;

use Atldays\Agent\AgentManager;
use Atldays\Geo\GeoManager;
use Atldays\Visitor\Contracts\{LanguageContract, VisitorContract};
use Atldays\Visitor\Data\Language;
use Exception;
use Illuminate\Contracts\Container\{BindingResolutionException, Container};
use Illuminate\Http\Request;

class VisitorManager
{
    public function __construct(
        protected Container $container,
        protected AgentManager $agent,
        protected GeoManager $geo,
    ) {}

    /**
     * @throws BindingResolutionException
     * @throws Exception
     */
    public function from(string $ip, string $userAgent, array|LanguageContract $language = []): VisitorContract
    {
        return $this->container->make(Visitor::class, [
            'ip' => $ip,
            'userAgent' => $userAgent,
            'language' => Language::from($language),
            'agent' => $this->agent->detect($userAgent),
            'geo' => $this->geo->ip($ip),
        ]);
    }

    /**
     * @throws BindingResolutionException
     */
    public function request(?Request $request = null): VisitorContract
    {
        if ($request === null && $this->container->bound('request')) {
            $request = $this->container->make('request');
            $request = $request instanceof Request ? $request : null;
        }

        $agent = $this->agent->request($request);
        $geo = $this->geo->request($request);

        return $this->container->make(Visitor::class, [
            'ip' => $geo->ip(),
            'userAgent' => $agent->userAgent(),
            'language' => Language::from($request ?? []),
            'agent' => $agent,
            'geo' => $geo,
        ]);
    }
}
