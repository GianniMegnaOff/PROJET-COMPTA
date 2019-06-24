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

Route::get('/customer', 'CustomerController@getAllCustomers');
Route::post('/customer/create', 'CustomerController@createCustomer');

Route::get('/product', 'ProductController@getAllProducts');
Route::post('/product/create', 'ProductController@createProduct');

Route::get('/project', 'ProjectController@getAllProjects');
Route::get('/project/{id}', 'ProjectController@getProject');
Route::post('/project/create', 'ProjectController@createProject');
Route::post('/project/statut/update/{id}', 'ProjectController@updateStatut');

Route::put('/project/{id}/deal/update', 'ProjectController@updateDeal');

Route::post('/project/update/{id}', 'ProjectController@updateProject');
Route::post('/project/delete/{id}', 'ProjectController@deleteProject');

Route::get('/statut', 'StatutController@getAllStatut');