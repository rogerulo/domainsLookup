<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::post('/dino', function(){
    return response()->json([
        // 'name' => 'Abigail',
        // 'state' => 'CA'
        'created' => true
    ]);
});

Route::post('/getDomainsRecords', function(){

    return response()->json(
        [
            'domains'=>[
                ['name'=>'roravel.com','records'=>[]],
                ['name'=>'marvel.com','records'=>[]],
            ]
        ]);
});

Route::post( '/getDomainsRecords',['as'=>'getDomainRecords','uses'=>'DomainSearchController@getDomainRecords']);
