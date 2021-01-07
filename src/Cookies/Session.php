<?php


namespace Sunfire\Cookie\Cookies;

use Sunfire\Cookie\BaseCookie;

class Session extends BaseCookie
{
    public function fill(): array
    {
        return [
            'name' => 'session',
            'description' => 'This is just for authentication.',
            'required' => true,
            'expiry' => 'persistent'
        ];
    }
}