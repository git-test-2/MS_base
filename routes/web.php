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


// миддлваре 'auth' фильтрует запросы, если юзер не авторизован, то правила тут выполняться не будут. Он вернёт редирект
// на страницу входа. Для тех кто авторизован мы добавляем logout (то есть выйти может только авторизованный пользователь).
Route::middleware("auth")->namespace('App\Http\Controllers')->group(function () {
    Route::get('/logout','AuthController@logout')->name('logout');

    // маршруты для редактирования профиля
    // auth - middleware ограничивает доступ к этим маршрутам только для авторизованных пользователей.
    Route::get('/profile','ProfileController@edit')->name('profile.edit');
    Route::post('/profile','ProfileController@update')->name('profile.update');
    Route::post('/profile/delete','ProfileController@destroy')->name('profile.destroy');

});


// Добавим сюда регистрацию - если мы зарегистрированы, то для нас только 'guest'. Если ты "гость", ты можешь
// зарегистрироваться и залогинится.
Route::middleware('guest')->namespace('App\Http\Controllers')->group(function () {

    Route::get('/login','AuthController@showLoginForm')->name('login');
    Route::post('/login_process', 'AuthController@login_process')->name('login_process');

    Route::get('/register','AuthController@showRegisterForm')->name('register');
    Route::post('/register_process', 'AuthController@register_process')->name('register_process');

    Route::get('/forgot','AuthController@showForgotForm')->name('forgot');
    Route::post('/forgot_process', 'AuthController@forgot_process')->name('forgot_process');
});



Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/','HomeController@index')->name('home');
    Route::get('/quote','HomeController@quote')->name('quote');

    //контактная форма
    Route::get('/contacts', 'HomeController@showContactForm')->name('contacts');
    Route::post('/contact_form_process', 'HomeController@contactForm')->name('contact_form_process');
});
