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
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// 社員一覧画面表示
Route::get('/users', 'UserController')->name('社員一覧')->middleware('auth');
// 役職一覧表示
Route::get('/roles', 'RoleController')->name('ロール一覧')->middleware('auth');
// 顧客画面 表示・登録画面
Route::resource('/customers', 'CustomerController')->middleware('auth');
// 顧客履歴登録
Route::post('/customers/{customer}/logs', 'CustomerLogController')->middleware('auth');
// 顧客検索画面を表示
Route::get('customer_search', 'CustomerSearchController@index')->middleware('auth');
// 顧客検索結果画面を表示
Route::post('customer_search', 'CustomerSearchController@search')->middleware('auth');
