<?php


namespace Sunfire\Cookie\Services;


use Sunfire\Cookie\BaseGroup;
use Sunfire\Cookie\Contracts\CookieGroup;
use Sunfire\Cookie\Groups\MarketingGroup;
use Sunfire\Cookie\Groups\NecessaryGroup;
use Sunfire\Cookie\Groups\StatisticsGroup;

class CookieManager
{

    const COOKIE_NOT_CONSENTED = 'not_consented';
    const COOKIE_APPROVED = 'approved';
    const COOKIE_DENIED = 'denied';

    public static function all(): array
    {
        return static::cookies();
    }

    private static function cookies(): array
    {
        return [
            new NecessaryGroup(),
            new MarketingGroup(),
            new StatisticsGroup(),
        ];
    }

    public static function checkGroup(BaseGroup $group): bool
    {
        return $group->check();
    }

    public static function check($name): string
    {

        if (!static::isConsented($name)) {
            return static::COOKIE_NOT_CONSENTED;
        }

        if (static::isApproved($name, true)) {
            return static::COOKIE_APPROVED;
        }

        return static::COOKIE_DENIED;
    }

    public static function isConsented($name): bool
    {
        return in_array($name, static::getApprovedCookies()) || in_array($name, static::getDeniedCookies());
    }

    public static function isApproved($name, $strict = false): bool
    {
        return $strict
            ? in_array($name, static::getApprovedCookies()) && !static::isDenied($name) && static::isConsented($name)
            : in_array($name, static::getApprovedCookies());
    }

    public static function isDenied($name, $strict = false): bool
    {
        return $strict
            ? in_array($name, static::getDeniedCookies()) && !static::isApproved($name) && static::isConsented($name)
            : in_array($name, static::getDeniedCookies());
    }

    public static function getApprovedCookies(): array
    {
        return static::getCookieStore()
            ? static::getCookieStore()['consents_approved']
            : [];
    }

    public static function getDeniedCookies(): array
    {
        return static::getCookieStore()
            ? static::getCookieStore()['consents_denied']
            : [];
    }

    public static function getCookieStore()
    {
        return json_decode(
            request()->cookie('cookie-consent'),
            true
        );
    }

    public static function findByName($name)
    {
        return collect(static::cookies())
            ->pluck('cookies')
            ->flatten()
            ->filter(fn($cookie) => $cookie->name === $name)
            ->first();
    }

    public function needsConsent(): bool
    {
        return empty(static::getCookieStore());
    }
}