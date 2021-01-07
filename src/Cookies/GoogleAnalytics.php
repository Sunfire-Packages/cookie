<?php


namespace Sunfire\Cookie\Cookies;

use Sunfire\Cookie\BaseCookie;

class GoogleAnalytics extends BaseCookie
{

    public function fill(): array
    {
        return [
            'name' => 'google-analytics',
            'description' => 'We want to see, that u like this site and where you come from.',
            'required' => false,
            'expiry' => 'persistent'
        ];
    }
}