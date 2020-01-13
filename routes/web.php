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
    return view('import');
});
Route::post('/import_parse', 'InventoryController@import_parse')->name('import_parse');
Route::get('/report', 'ReportController@report_parse')->name('report');
route::get('/reports', 'ReportController@report_lists')->name('reports');
//Route::post('/reports_search', 'ReportController@report_search');  