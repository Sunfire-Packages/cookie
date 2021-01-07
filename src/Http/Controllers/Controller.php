<?php


namespace Sunfire\Cookie\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Sunfire\Cookie\Groups\MarketingGroup;
use Sunfire\Cookie\Groups\NecessaryGroup;
use Sunfire\Cookie\Groups\StatisticsGroup;
use Sunfire\Cookie\Services\CookieManager;
use Sunfire\Cookie\Traits\CanPretendToBeAFile;

class Controller extends BaseController
{
    use CanPretendToBeAFile;

    public function index()
    {
        return response()->json(
            CookieManager::all()
        );
    }

    public function view()
    {
        return view('sun-cookie::banner', [
            'manager' => new CookieManager
        ]);
    }

    public function script()
    {
        return $this->pretendResponseIsFile(__DIR__.'/../../../js/dist/main.js');
    }
}