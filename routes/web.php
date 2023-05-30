<?php

use App\Http\Controllers\GradeClasses\GradeClassController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
// routes/web.php
Auth::routes();
Route::group(['prefix' => LaravelLocalization::setLocale(),	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
], function()
{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
	Route::get('/', function()
	{
        return view('dashboard');
	});
	Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
	Route::group(['namespace'=>'Grades'],function(){
		Route::resource('Grades','GradeController');
	});

	Route::group(['namespace'=>'GradeClasses'],function(){
		Route::resource('GradeClasses',GradeClassController::class);
		Route::post('GradeClasses/delete/checked',[GradeClassController::class,'deleteChecked'])->name('GradeClasses.deleteChecked');
		Route::post('GradeClasses/filter/grade',[GradeClassController::class,'filterGrade'])->name('GradeClasses.filterGrade');
	});



	// Route::get('test',function(){
	// 	return View::make('test');
	// });
});

/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/

// Route::get('/', function () {
//     return view('dashboard');
// });


