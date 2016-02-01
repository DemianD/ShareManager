<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('shares/prices', 'SharesController@updatePrices');
    Route::resource('shares', 'SharesController');

    /*
     * Buy shares
     */
    Route::get('shares/{shares}/buy', 'PortfolioController@showBuy');
    Route::post('shares/{shares}/buy', 'PortfolioController@pushBuy');

    Route::auth();
    Route::get('/home', 'HomeController@index');

    Route::get('portfolio', 'PortfolioController@index');

});
