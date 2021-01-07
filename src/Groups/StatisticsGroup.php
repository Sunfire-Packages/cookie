<?php

namespace Sunfire\Cookie\Groups;


use Sunfire\Cookie\BaseGroup;
use Sunfire\Cookie\Cookies\GoogleAnalytics;

class StatisticsGroup extends BaseGroup
{
    public function fill(): array
    {
        return [
            'name' => __('sun-cookie::text.statistics.name'),
            'description' => __('sun-cookie::text.statistics.message'),
            'required' => false,
            'expiry' => 'persistent'
        ];
    }

    public function cookies() : array
    {
        return [
            new GoogleAnalytics()
        ];
    }

}