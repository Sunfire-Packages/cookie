<?php


namespace Sunfire\Cookie;


use Sunfire\Cookie\Services\CookieManager;
use Sunfire\Cookie\Traits\Approvable;
use Sunfire\Cookie\Traits\Describable;
use Sunfire\Cookie\Traits\Fillable;

abstract class BaseGroup
{
    use Describable, Fillable, Approvable;

    abstract public function cookies(): array;

    public function check(): bool
    {
        return $this->required || ($this->checked && $this->allCookiesApproved()) || $this->allCookiesApproved();
    }

    public function allCookiesApproved($strict=false): bool
    {

        foreach ($this->cookies() as $cookie) {
            if (!in_array(CookieManager::check($cookie->name), $this->getAllowedValues())) {
                return false;
            }
        }

        return true;
    }

    public function allCookiesConsented(): bool
    {
        foreach ($this->cookies() as $cookie) {
            if (CookieManager::check($cookie->name) === CookieManager::COOKIE_NOT_CONSENTED) {
                return false;
            }
        }

        return true;
    }

}