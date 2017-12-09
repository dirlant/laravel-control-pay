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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/signup', 'AuthController@signup');
Route::post('/login', 'AuthController@login');

Route::resource('customer', 'CustomerController', [
      'except' => [
        'create', 'edit'
      ]
    ]
  );

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

Route::resource('user', 'UserController', [
      'except' => [
        'edit', 'update', 'destroy'
      ]
    ]
  );
