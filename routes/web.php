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
//Route::get('envio-email', function (){
//    $user = stdClass();
//    $user->name = 'Roberto';
//    $user->email = 'roberto@housecriative.com.br';
//    return new \App\Mail\newUserMail($user);
//});

Route::group(['namespace' => 'Site'], function () {
    Route::get('/', 'SiteController@index')->name('site.home');
    Route::post('/store', 'SiteController@store')->name('site.store');
});


Route::group(['namespace' => 'Admin', 'name' => 'admin.', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('company', 'CompanyController');
    Route::post('company-observation/{id}/update', 'CompanyController@observationUpdate')->name('company.observation.update');

    /** CERTIFICADOS */
    Route::get('company-certificado/{uuid}', 'CertificateController@certificate')->name('company.certificate.final');
    Route::get('company-certificado', 'CertificateController@index')->name('company.certificate.index');
    Route::post('company-certificado/store', 'CertificateController@store')->name('company.certificate.store');


    /** USUÁRIOS DO SISTEMA */
    Route::get('/usuario', 'UserController@index')->name('usuario.index');
    Route::get('usuario/create', 'UserController@create')->name('usuario.create');
    Route::post('usuario/store', 'UserController@store')->name('usuario.store');
    Route::get('usuario/{uuid}/edit', 'UserController@edit')->name('usuario.edit');
    Route::put('usuario/{uuid}/update', 'UserController@update')->name('usuario.update');
    Route::delete('usuario/{uuid}/delete', 'UserController@destroy')->name('usuario.destroy');

    /** TOMADA DE PREÇO */
    Route::get('/tomada-de-preco', 'OutletPriceController@index')->name('outletprice.index');
    Route::get('/tomada-de-preco/create', 'OutletPriceController@create')->name('outletprice.create');
    Route::post('/tomada-de-preco/store', 'OutletPriceController@store')->name('outletprice.store');
    Route::get('/tomada-de-preco/{uuid}/edit', 'OutletPriceController@edit')->name('outletprice.edit');
    Route::put('/tomada-de-preco/{id}/update', 'OutletPriceController@update')->name('outletprice.update');
    Route::delete('/tomada-de-preco/{id}/delete', 'OutletPriceController@destroy')->name('outletprice.delete');
    Route::get('/tomada-de-preco/{uuid}/show', 'OutletPriceController@show')->name('outletprice.show');
});


Auth::routes(['register' => false]);

Route::get('/admin', 'HomeController@index')->name('home');
