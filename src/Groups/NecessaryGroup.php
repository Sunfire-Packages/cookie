<?php


namespace Sunfire\Cookie\Groups;

use Sunfire\Cookie\BaseGroup;
use Sunfire\Cookie\Cookies\Session;

class NecessaryGroup extends BaseGroup
{
    public $cookies;

    public function fill(): array
    {
        return [
            'name' => __('sun-cookie::text.necessary.name'),
            'description' => __('sun-cookie::text.necessary.message'),
            'required' => true,
            'expiry' => 'persistent'
        ];
    }

    public function cookies() : array
    {
        return [
            new Session()
        ];
    }
}