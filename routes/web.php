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

Route::get('/', 'UserController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/history', 'UserController@history')->name('UserHistory');
Route::get('/projects', 'UserController@projects')->name('UserProjects');
Route::get('/newproject', 'UserController@newProject')->name('UserNewProject');

//ADMIN
Route::get('admin','AdminController@index');
Route::get('admin/newinvoices','AdminController@newInvoices');
Route::get('admin/approvedinvoices','AdminController@approvedInvoices');
Route::get('admin/urgentinvoices','AdminController@urgentInvoices');
Route::get('admin/loadInvoicesApi/{id}','AdminController@loadInvoicesApi');

//Post
Route::post('/invoice/create','UserController@createInvoice');
Route::post('/admin/approve','AdminController@approveInvoice');
Route::post('/admin/decline','AdminController@declineInvoice');
