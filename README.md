# CRUD STEPS

## Creazione Modello, Migrazione, Seeder, Controller (resource)

`php artisan make:model Models/Game -a`


## Compilare la migrazione

Pensa alla struttura della tabella!!

```php
// Metodo UP
   public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('cover')->default('https://picsum.photos/300/200');
            $table->longText('desc')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('games');
    }

```

Migra il db

`php artisan migrate`

## Seeder

Seeder creato prima con -a sul modello, altrimenti `php artisan make:seeder GameSeeder`

Importa il modello nel Seeder

`use App\Models\Game;`

Importa faker

`use Faker\Generator as Faker;`

Dependency injection nel metodo run e ciclo for

```php

public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            # code...
        }
    }
```

Inserire i dati con faker

```php
#code ..
$game = new Game();
$game->title = $faker->sentence();
$game->cover = $faker->imageUrl(300, 200, 'Games');
$game->desc = $faker->paragraphs(10, true);
$game->is_available = $faker->boolean(80);
$game->save();
```

Aggiungi il seeder al DatabaseSeeder.php se vuoi migragrare e seedare tutto insieme

```php
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ComicSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(GameSeeder::class);
    }
}

```

Seeda il db

`php artisan db:seed --class=GameSeeder`

## Creazione CRUD

- creazione rotte
- resource controller x Admin
- controller semplice x guests

in web.php definiamo rotta per mostrare tutte le risorse

```php
# R = READ
Route::get('admin/games', 'Admin\GameController@index')->name('admin.games.index');


```


## Controller lato Admin

Ricorda che il namespace deve essere Admin `namespace App\Http\Controllers\Admin;`

Implementiamo metodo `@index` nel controller Admin\GameControler.php

```php
 public function index()
  {
      $games = Game::orderBy('id', 'desc')->paginate(12);
      return view('admin.games.index', compact('games'));
  }

```

Creazione della View come tabella, usa snippet bootsrap per generare la tabella e inserire i dati.


Creazione rotta per inserire nuova risorsa, in web.php


```php
# R = READ
Route::get('admin/games', 'Admin\GameController@index')->name('admin.games.index');
Route::get('admin/games/create', 'Admin\GameController@create')->name('admin.games.create');
```

Restituire la view dal controller per mostrare un form

nel controller `Admin\GameController` implementa metodo `create`

```php
public function create()
{
    return view('admin.games.create');
}
```

Creazione view nella cartella `resources/views/admin/games/` che chiamiamo create.blade.php

```bash
touch create.blade.php 

```

form per inserire i dati

- ricorda il `@csrf` token
- l'azione nel form é `action="{{ route('admin.games.store') }}"`
- il metodo del form é POST
- non dimenticare l'attributo `name=` sugli input che combacia con nomi colonne tabella.

```html
<form action="{{ route('admin.games.store') }}" method="post">
    @csrf

    <!-- Campi del form qui  -->

</form>

```

### Implementiamo metodo STORE

Crea la rotta in web.php

```php
Route::post(
    'admin/games',
    'Admin\GameController@store'
)->name('admin.games.store');
```

dumpa a schermo la richiesta nel metodo `@store`

```php

 public function store(Request $request)
  {
      //
      ddd($request->all());
  }

```

Validiamo i dati, inserendo le regole di validazione. Sfruttiamo metodo `validate([])` della classe request
[Docs](https://laravel.com/docs/7.x/validation#validation-quickstart)

```php
$val_data = $request->validate([
    'title' => ['required', 'max:200'],
    'cover' => ['nullable', 'max:255'],
    'desc' => ['nullable'],

]);

```

Creaiamo il record nel db, sempre nem metodo `store()`

```php
// Salviamo il record nel database
Game::create($val_data);

```

NOTE: Ricorda di aggiungere le fillable properties nel modello `Add [title] to fillable property to allow mass assignment on [App\Models\Game].`

Aggiungi questa riga nel modello Game.php (se usi modello diverso i valori li devi cambiare!)

```php
protected $fillable = ['title', 'cover', 'desc'];
```

Reindirizza l'utente, qui sotto il metodo completo

```php
   public function store(Request $request)
    {
        //
        //ddd($request->all());

        // Validiamo i dati
        $val_data = $request->validate([
            'title' => ['required', 'max:200'],
            'cover' => ['nullable', 'max:255'],
            'desc' => ['nullable'],

        ]);
        //ddd($val_data);

        // Salviamo il record nel database
        Game::create($val_data);

        // rendirizza l'utente ad una view di tipo get
        return redirect()->route('admin.games.index');
    }

```

Ricorda di aggiungere gli errori di validazione nel form!
[documentazione](https://laravel.com/docs/7.x/validation#quick-displaying-the-validation-errors)

```html


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


```

Ricorda che puoi usare anche la direttiva blade @error, ad esempio

```html
<input id="title" type="text" class="@error('title') is-invalid @enderror">

@error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

```

Puoi anche conservare il testo inserito nel form qualora la validazione fallisse usando funzione `old()`
ad esempio:
`value="{{old('title')}}"`
