<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PersonalDataController;

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


/*Route::get('/personalData', function () {
    return view('personalData/index');
});*/
//Route::get('/personalData', 'PersonalDataController@index')->name('personalData');
Route::post('personalData/importPersonalData', [PersonalDataController::class, 'importPersonalData'])->name('importPersonalData');
//Route::resource('projects', ProjectController::class);
Route::resource('personalData', PersonalDataController::class);

// Route::resource('projects', 'ProjectController');