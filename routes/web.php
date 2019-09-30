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


Route::get('/eventh', 'EventController@index');





Route::resource('events', 'EventTController');




//add menu

Route::resource('menus', 'EventMenuController');

//search


Route::get('/search','EventMenuController@search');

//add item

Route::resource('eitems','EventItemController');
Route::get('searcheitem', 'EventItemController@searcheitem');
Route::get('/e_item/edit/pdf','EventItemController@pdf');





//staff

Route::resource('estaff', 'EstaffController');

//e report

Route::resource('ereport', 'EreportController');
Route::get('/e_report/edit/pdf','EreportController@pdf');

Route::get('searchereport', 'EreportController@searchereport');






