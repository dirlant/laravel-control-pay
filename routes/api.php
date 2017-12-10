<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'PassportController@login');
Route::post('/register', 'PassportController@register');

Route::group(['middleware' => 'auth:api'], function(){

    Route::get('details', 'PassportController@getDetails');

    Route::get('user', 'UserController@index');

});

Route::resource('project.monthly', 'MonthlyPaymentController', [
      'except' => [
        'create', 'edit'
      ]
    ]
  );

Route::resource('project.payment', 'PaymentController', [
      'except' => [
        'create', 'edit'
      ]
    ]
  );

Route::resource('customer.project', 'ProjectController', [
      'except' => [
        'create', 'edit'
      ]
    ]
  );
/*
Route::resource('user', 'UserController', [
      'except' => [
        'edit', 'update', 'destroy'
      ]
    ]
  );
*/
