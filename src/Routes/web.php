<?php 

use Illuminate\Support\Facades\Route;

Route::namespace('Novay\Smrpas\Http\Controllers')->prefix('oauth')->as('smrpas.')->group(function() 
{
    Route::middleware(['web'])->group(function() {
        Route::get('redirect', 'OAuthController@redirect')->name('authorize');
        Route::get('callback', 'OAuthController@callback');
        Route::get('refresh', 'OAuthController@refresh');
    });
});