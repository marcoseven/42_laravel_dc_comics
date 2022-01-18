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
Route::get('/comics', function () {

    $comics = config('db.comics');
    //ddd($comics);

    return view('comics.index', compact('comics'));
})->name('comics');


Route::get('comics/{id}', function ($id) {
    $comics = config('db.comics');

    // check if the id is a numeric value
    // and check the value is greather than or equal to 0
    // and check if the value if less than the length of the array
    if (is_numeric($id) && $id >= 0 && $id < count($comics)) {
        $comic = $comics[$id];
        //ddd($comic);

        return view('comics.show', compact('comic'));
    } else {
        abort(404);
    }
})->name('comic');


/* /COMICS ROUTES */



Route::get('/movies', function () {
    /* return view('movies'); */
    return 'Movies Page';
})->name('movies');

Route::get('/tv', function () {
    /* return view('movies'); */
    return 'Tv Page';
})->name('tv');

Route::get('/games', function () {
    /* return view('movies'); */
    return 'Games Page';
})->name('games');

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

Route::get('/news', function () {
    /* return view('movies'); */
    return 'New Page';
})->name('news');

Route::get('/shop', function () {
    /* return view('movies'); */
    return 'shop Page';
})->name('shop');



Route::get('oop', function () {

    // Sintassi Class oop
    /*
    - parola chiave class
    - node in PascalCase dell'entitá da rappresentare
    - parentesi graffe
    */
    class Person
    {
        public $name;
        public $lastname;
        public $type = 'Human';
    }

    // Instanza di una classe (oggetto)
    $giovanni = new Person();
    $doina = new Person();

    // Aggiungere valori agli attributi
    $giovanni->name = 'Giovanni';
    $giovanni->lastname = 'Belda';

    $doina->name = 'Doina';
    $doina->lastname = 'Ganceriuc';
    // Accedere alle attributi
    //dd($giovanni->name, $doina->name);

    //dd($giovanni, $doina);


    class Car
    {
        public $make;
        public $model;
        public $price;


        public function setPrice(int $price)
        {

            $this->price = $price;
        }

        public function getPrice()
        {
            return $this->price;
        }
    }

    $tesla = new Car();
    $tesla->make = "tesla";
    $tesla->model = 'X';
    $tesla->setPrice(30000);

    $teslax_price = $tesla->getPrice();

    dd($tesla->price, $teslax_price,$tesla);
});
