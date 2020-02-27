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

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>false, 'reset'=>false]);


Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth',
], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('storage/{file}', function($file){
        $directory = 'company/'.$file;

        $file = Storage::get($directory);
        $type = Storage::mimeType($directory);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;

    })->name('file_getter');
    Route::resource('company', 'CompanyController');
    Route::resource('employee', 'EmployeeController');
});
