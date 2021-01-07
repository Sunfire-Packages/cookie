<?php
use Illuminate\Support\Facades\Route;
use Sunfire\Cookie\Http\Controllers\Controller;

Route::get('/cookie-consent', [Controller::class , 'index'])->name('cookie-consent');
Route::get('/cookie-consent/view', [Controller::class , 'view'])->name('cookie-consent-view');

Route::get('/cookie-consent/assets/js', [Controller::class, 'script'])->name('cookie-consent-script');