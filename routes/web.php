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

// Auth::routes();


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'HomeController@index')->name('home');

    // Route::resource('documents', 'DocumentController');
    // Route::put('documents/{id}/close', 'DocumentController@close')->name('document.close');
    // Route::put('documents/{id}/forward', 'DocumentController@forward')->name('document.forward');

    Route::resource('legislative', 'LegislativeMeasureController');
    Route::resource('sessions', 'SessionController');
    Route::resource('agendas', 'AgendaController');
    Route::delete('agenda_attachment/{attachment_id}', 'AgendaController@deleteAttachment')->name('agenda_attachment.delete');

    Route::group(['prefix' => 'forms'], function() {
        Route::resource('franform', 'FranformController');
        Route::resource('ordform', 'OrdformController');
        Route::resource('resform', 'ResformController');
    });

    Route::group(['prefix' => 'api'], function() {
        Route::get('ord_res_nos', 'LegislativeMeasureController@getOrdResNos')->name('ord_res_no');
        Route::get('title_subjects', 'LegislativeMeasureController@getTitleSubjects')->name('title_subject');

        Route::get('ord_nos', 'FranformController@getOrdNos')->name('franform_ordnos');
        Route::get('names', 'FranformController@getNames')->name('franform_names');

        Route::get('ordform_ord_nos', 'OrdformController@getOrdNos')->name('ordform_ordnos');
        Route::get('resform_res_nos', 'OrdformController@getOrdNos')->name('resform_resnos');
    });
});

Route::group(['middleware' => 'admin'], function() {
    Route::resource('offices', 'UserController', [
        'except' => ['show']
    ]);
});

Route::get('session', 'Session2Controller@index')->name('session_index');
Route::get('session/{id}', 'Session2Controller@show')->name('session_show');
