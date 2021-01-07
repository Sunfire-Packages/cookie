<?php


namespace Sunfire\Cookie\Http;


use Sunfire\Cookie\Services\CookieManager;

class Assets
{
    public static function script()
    {

        $path = route('cookie-consent-script');
        $domain = config('session.domain') ?? request()->getHost();
        $sameSite = config('session.same_site');
        $secure = config('session.secure');

        $cookies = response()->json(
            CookieManager::all()
        );

        $data = $cookies->content();

        return <<<HTML
        <script src="{$path}" data-turbo-eval="false" data-turbolinks-eval="false"></script>
        
        <script>
            window.sunfireCookie.init(
                '{$domain}',
                '{$sameSite}', 
                '{$secure}',
                '{$data}'
            )   
        </script>
        HTML;
    }
}