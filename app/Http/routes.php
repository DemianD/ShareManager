<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('shares/prices', 'SharesController@updatePrices');
    Route::get('shares/guruwatch', 'SharesController@updateGuruwatch');

    Route::resource('shares', 'SharesController');

    /*
     * Buy shares
     */
    Route::get('shares/{shares}/buy', 'PortfolioController@showBuy');
    Route::post('shares/{shares}/buy', 'PortfolioController@pushBuy');

    Route::auth();
    Route::get('/home', 'HomeController@index');

    Route::get('portfolio', 'PortfolioController@index');
    Route::get('portfolio/{share_user}', 'PortfolioController@showShare');
});
