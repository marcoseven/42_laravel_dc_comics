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

Route::get('/', function () {
    return view('home');
})->name('home');


/* COMICS ROUTES */
Route::get('/comics', 'ComicController@index')->name('comics');
Route::get('comics/{comic}', 'ComicController@show')->name('comic');


/* Dashboard */
Route::view('admin', 'admin.dashboard')->name('admin');

/* Posts */

// Mostra lista di risorse
Route::get('admin/posts', 'Admin\PostController@index')->name('admin.posts.index');
// Mostra form per creare nuova risorsa
Route::get('admin/posts/create', 'Admin\PostController@create')->name('admin.posts.create');
// Salvo nel database la risorsa
Route::post('admin/posts', 'Admin\PostController@store')->name('admin.posts.store');
// Mostra la singlola risorsa
Route::get('admin/posts/{post}', 'Admin\PostController@show')->name('admin.posts.show');
// Mostra un form per modificare la risorsa
Route::get('admin/posts/{post}/edit', 'Admin\PostController@edit')->name('admin.posts.edit');
// Aggiorniamo la risorda nel database
Route::put('admin/posts/{post}', 'Admin\PostController@update')->name('admin.posts.update');
// Cancello la risorsa
Route::delete('admin/posts/{post}', 'Admin\PostController@destroy')->name('admin.posts.destroy');




/* /COMICS ROUTES */


/* Route::get('/movies', function () {
    return view('movies');
    return 'Movies Page';
})->name('movies'); */

Route::resource('movies', 'Admin\MovieController');



Route::get('/tv', function () {
    /* return view('movies'); */
    return 'Tv Page';
})->name('tv');

/* GAMES

# migration
- id
- title
- cover
- description
- is_available
- created_at
- updated_at

Routes - guest: index, show
Route - admin: index, show, create, edit, store, update, delete


*/

/* GAMES Routes - GUEST */

Route::get('/games', function () {
    /* return view('movies'); */
    return 'Games Page';
})->name('games');
Route::get('games/{game}', 'GameController@show');

/* Games Routes - Admin */
Route::get('admin/games', 'Admin\GameController@index')->name('admin.games.index');
Route::get('admin/games/create', 'Admin\GameController@create')->name('admin.games.create');
Route::post(
    'admin/games',
    'Admin\GameController@store'
)->name('admin.games.store');
Route::get('admin/games/{game}', 'Admin\GameController@show')->name('admin.games.show');


/* /Games */


Route::get('/collectibles', function () {
    /* return view('movies'); */
    return 'Collectibles Page';
})->name('collectibles');

Route::get('/video', function () {
    /* return view('movies'); */
    return 'Vide Page';
})->name('video');

Route::get('/fans', function () {
    /* return view('movies'); */
    return 'Fans Page';
})->name('fans');


/* POSTS - GUEST */
Route::get('/news', 'PostController@index')->name('news');
Route::get('/news/{post}', 'PostController@show')->name('single-post');


Route::get('/shop', function () {
    /* return view('movies'); */
    return 'shop Page';
})->name('shop');
