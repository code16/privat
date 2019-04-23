<?php

Route::group(['middleware' => 'web'], function () {

    Route::get('/privat')
        ->uses('Code16\Privat\Controllers\PrivatController@index');

    Route::post('/privat')
        ->uses('Code16\Privat\Controllers\PrivatController@store');

    Route::get('/privat_waiting')
        ->uses('Code16\Privat\Controllers\PrivatWaitingController@index');

});