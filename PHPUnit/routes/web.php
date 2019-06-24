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

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ola', function () {
    return 'Olá mundo!';
});

Route::post('post', function (Request $request) {
    $name = $request->name;
    $email = $request->email;

    return response()->json(compact('name', 'email'));
});
