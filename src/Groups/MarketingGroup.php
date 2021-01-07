<?php


namespace Sunfire\Cookie\Groups;


use Sunfire\Cookie\BaseGroup;

class MarketingGroup extends BaseGroup
{
    public function fill(): array
    {
        return [
            'name' => __('sun-cookie::text.marketing.name'),
            'description' => __('sun-cookie::text.marketing.message'),
            'required' => false,
            'expiry' => 'persistent'
        ];
    }

    public function Cookies() : array
    {
        return [];
    }
}