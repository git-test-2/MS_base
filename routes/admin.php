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

//Route::get('/', function () {
//    return view('welcome');
//});


//Route::middleware("auth")->namespace('App\Http\Controllers')->group(function () {
//    Route::get('/logout','AuthController@logout')->name('logout');
//});


// файл маршрутизации для админПанели

// роут admin.login - дописали .admin в Providers\RouteServiceProvider.php как  ->name('admin.')
// урл - admin/login , а нейм - admin.login

Route::middleware('guest:admin')->namespace('App\Http\Controllers\Admin')->group(function () {

    Route::get('/login','AuthController@showLoginForm')->name('login');
    Route::post('/login_process', 'AuthController@login_process')->name('login_process');

//    Route::get('/register','AuthController@showRegisterForm')->name('register');
//    Route::post('/register_process', 'AuthController@register_process')->name('register_process');
//
//    Route::get('/forgot','AuthController@showForgotForm')->name('forgot');
//    Route::post('/forgot_process', 'AuthController@forgot_process')->name('forgot_process');
});


// мидлвар "auth:
// который мы создали в app\Http\Kernel.php и прописали его в app\Providers\RouteServiceProvider.php (c префиксом и неймом)
//
// и гард типа admin"
// который мы создали и добавили в config\auth.php, ( 'admin' => [)  и прописали к нему 'provider' => 'admin_users', и
// прописали к нему драйвер 'admin_users' => [ 'driver' => 'eloquent', 'model' => App\Models\AdminUser::class, ],
// по какой модели App\Models\AdminUser::class будет работать гард
//

// добавляем миддлвар, который будет отвечать за авторизацию, что только авторизованные пользователи и не все (не по дефолту),
// как мы делали на сайте, а только типа гарда admin - будут иметь доступ к этим роутам.
Route::middleware("auth:admin")->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::resource('/quotes','QuoteController');

    Route::get('/logout','AuthController@logout')->name('logout');
});


//Route::group(['namespace' => 'App\Http\Controllers'], function () {
//    Route::get('/','HomeController@index')->name('home');
//    Route::get('/quote','HomeController@quote')->name('quote');
//});
