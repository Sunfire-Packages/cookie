<?php


namespace Sunfire\Cookie;

use Sunfire\Cookie\Services\CookieManager;
use Sunfire\Cookie\Traits\Approvable;
use Sunfire\Cookie\Traits\Describable;
use Sunfire\Cookie\Traits\Fillable;

abstract class BaseCookie
{
    use Describable, Fillable, Approvable;

    public $expiry;

    public function check(): bool
    {
        return $this->required || ($this->checked && $this->approved()) || $this->approved();
    }

    public function approved($strict=false): bool
    {
        if (in_array(CookieManager::check($this->name), $this->getAllowedValues())) {
            return true;
        }

        return false;
    }
}