<?php

namespace Atldays\Visitor\Tests\Feature;

use Atldays\Geo\Contracts\{DriverContract, GeoContract};
use Atldays\Geo\Data\{City, Continent, Country, Geo};
use Atldays\Visitor\Fingerprints\IpUserAgentGeo;
use Atldays\Visitor\Tests\TestCase;
use Atldays\Visitor\VisitorManager;

class IpUserAgentGeoFingerprintTest extends TestCase
{
    public function test_ip_user_agent_geo_fingerprint_uses_geo_external_ids_when_available(): void
    {
        $this->app['config']->set('geo.driver', ExternalIdGeoDriver::class);
        $this->app['config']->set('visitor.fingerprint.driver', IpUserAgentGeo::class);

        $visitor = $this->app->make(VisitorManager::class)->from(
            ip: '8.8.8.8',
            userAgent: 'UnitTest/1.0',
        );

        $this->assertSame(
            hash('sha256', '8.8.8.8|UnitTest/1.0|TestGeo|6255147|840|5375480'),
            $visitor->fingerprint(),
        );
    }

    public function test_ip_user_agent_geo_fingerprint_falls_back_to_geo_names_and_country_iso_code(): void
    {
        $this->app['config']->set('geo.driver', NamedGeoDriver::class);
        $this->app['config']->set('visitor.fingerprint.driver', IpUserAgentGeo::class);

        $visitor = $this->app->make(VisitorManager::class)->from(
            ip: '1.1.1.1',
            userAgent: 'UnitTest/2.0',
        );

        $this->assertSame(
            hash('sha256', '1.1.1.1|UnitTest/2.0|TestGeo|Oceania|AU|Sydney'),
            $visitor->fingerprint(),
        );
    }

    public function test_ip_user_agent_geo_fingerprint_handles_unresolved_geo_data(): void
    {
        $this->app['config']->set('geo.driver', UnresolvedGeoDriver::class);
        $this->app['config']->set('visitor.fingerprint.driver', IpUserAgentGeo::class);

        $visitor = $this->app->make(VisitorManager::class)->from(
            ip: '127.0.0.1',
            userAgent: 'UnitTest/3.0',
        );

        $this->assertSame(
            hash('sha256', '127.0.0.1|UnitTest/3.0|TestGeo|||'),
            $visitor->fingerprint(),
        );
    }
}

class ExternalIdGeoDriver implements DriverContract
{
    public function resolve(string $ip): GeoContract
    {
        $continent = new Continent(
            name: 'North America',
            code: 'NA',
            externalId: 6255147,
        );

        $country = new Country(
            name: 'United States',
            isoCode: 'US',
            continent: $continent,
            externalId: 840,
        );

        return new Geo(
            ip: $ip,
            provider: 'TestGeo',
            continent: $continent,
            country: $country,
            city: new City(
                name: 'Mountain View',
                country: $country,
                externalId: 5375480,
            ),
        );
    }
}

class NamedGeoDriver implements DriverContract
{
    public function resolve(string $ip): GeoContract
    {
        $continent = new Continent(
            name: 'Oceania',
            code: 'OC',
        );

        $country = new Country(
            name: 'Australia',
            isoCode: 'AU',
            continent: $continent,
        );

        return new Geo(
            ip: $ip,
            provider: 'TestGeo',
            continent: $continent,
            country: $country,
            city: new City(
                name: 'Sydney',
                country: $country,
            ),
        );
    }
}

class UnresolvedGeoDriver implements DriverContract
{
    public function resolve(string $ip): GeoContract
    {
        return Geo::unresolved($ip, 'TestGeo');
    }
}
