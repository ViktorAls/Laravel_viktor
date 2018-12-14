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
	
	
	use Illuminate\Support\Facades\Route;
	
	Route::match(['post','get'],'/worker/delete/{id}/{organization}','WorkerController@delete');
	Route::get('/worker/{id}','WorkerController@worker');
	Route::match(['post','get'],'/organization/delete/{id}','CompanyController@delete');
	Route::get('/organization/{id}','CompanyController@oneOrganization');
	Route::get('/','CompanyController@index');
	Route::post('/','CompanyController@xmlLoading');
	Route::match(['post','get'],'/save','WorkerController@save');


