<?php


namespace Sunfire\Cookie\Traits;


use Sunfire\Cookie\Services\CookieManager;

trait Approvable
{
    public function getAllowedValues($strict=false): array
    {
        $allowedValues = [
            CookieManager::COOKIE_APPROVED
        ];

        !$strict && $allowedValues[] = CookieManager::COOKIE_NOT_CONSENTED;

        return $allowedValues;
    }


}