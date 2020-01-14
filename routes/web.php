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

Route::get('/', 'HomeController@index')->name('index');
Route::get('/laravel-excel', 'HomeController@laravelExcel')->name('laravelExcel');
Route::get('/php-excel', 'HomeController@phpSpreadSheet')->name('phpSpreadSheet');
Route::get('/txt', 'ExportTxtController@txt')->name('txt');
Route::post('/upload', 'HomeController@upload')->name('upload');
Route::post('/print', 'HomeController@printFileUploads')->name('print');

Route::post('/convert', 'LaravelExcelController@convert')->name('convert');
Route::post('/check', 'LaravelExcelController@check')->name('check');
Route::get('/truncate', 'LaravelExcelController@truncate')->name('truncate');

Route::post('/filter', 'PhpSpreadSheetController@filter')->name('filter');
Route::post('/count', 'PhpSpreadSheetController@count')->name('count');

Route::post('/export-txt', 'ExportTxtController@exportTXT')->name('export-txt');
Route::post('/count-txt', 'ExportTxtController@count-txt')->name('count-txt');




