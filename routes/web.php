<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

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

// Idioma (locale)
Route::get('/lang/{locale}', function ($locale)
{
    if (!in_array($locale, ['en', 'es'])) {
        abort(400);
    }

    session()->put('locale', $locale);
    App::setLocale($locale);

    return redirect()->back();
});

/*
|--------------------------------------------------------------------------
| Basic Routes
|--------------------------------------------------------------------------
|
| Aquí entran aquellas routes que no tienen un controlador principal, simplemente
| una plantilla y esta carga componentes individuales.
|
*/
Route::get('/{section}', function ($section) {
    return view(strtolower(trim($section)));
});
