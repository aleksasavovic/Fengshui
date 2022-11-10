<?php
//Ivana Dragutinović 2015/0652, Aleksa Savović 0387/15, Ilija Stevanović 0305/15
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

use App\User;
use App\Oglas;

Route::get('/', function () {
	$oglasi = Oglas::all();
	if(Auth::guest())
   	 	return view('welcome');
   	else 
   		return view ('home')->with('oglasi',$oglasi);
})->name('welcome');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//rute za proifl korisnika:
Route::get('/profiles/myProfile', 'ProfileController@index')->name('myProfile');
Route::post('/profiles/myProfile', 'ProfileController@store')->name('changeInfo');
Route::get('/changePass', function() {
	return view('changePass');
})->name('changePassForm');

Route::post('/changePass', 'ProfileController@changePassword')->name('changePass');


//dizajn:
Route::get('/dizajniranje','UnityController@index')->name('dizajn');
Route::get('/dizajniram{id}','UnityController@dizajnerRadi')->name('dizajniram');
Route::post('/sendEmail','UnityController@sendEmail');

//galerija:
//Route::get('/gallery', 'HomeController@showGallery')->name('showGallery');
Route::get('/gallery', function(){
	$users = User::all();
    return view('gallery')->with('users', $users);
 })->name('showGallery');
 
//pretraga:
Route::post('/profiles/search', 'SearchController@search')->name('search');
Route::get('/profiles/{id}', 'ProfileController@show');
Route::post('/profiles/{id}', 'ProfileController@update');
Route::get('/postaviOglas','OglasController@index')->name('postaviOglas');
Route::get('/proba', function () {
    return view('proba');
})->name('proba');
Route::post('/postaviOglas','HomeController@store');
Route::get('/home{id}','HomeController@showOglas')->name('pregledajOglas');
Route::post('/home{id}','HomeController@storePrijava')->name('prijaviSe');


//biranje
Route::post('/izaberi','HomeController@update')->name('izaberi');


//Slanje mejla:
Route::post('/welcome', 'ResetPassController@posalji')->name('posalji');
Route::get('/obnova', 'ResetPassController@obnova')->name('obnova');