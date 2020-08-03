<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'HomeController@index')->name('home');
Route::resource('companies', 'CompanyController');
Route::resource('proposals', 'ProposalController');
Route::resource('users', 'UserController');
Route::resource('{proposal}/proposal-section', 'ProposalSectionController')->except('create');
Route::get('{proposal}/section/add/{type}', 'ProposalSectionController@create')->name("proposal-section.create");
