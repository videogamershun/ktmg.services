<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

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


/*

Ellenőrzí a szükséges dolgoakt:
    - A felhasználó be, van-e jelentkezve.
    - A felhasználó, rendelkezik-e a megfelelő role-al vagy permissional.
    - A weboldal csatlakozik-e az adatbázishoz.
    - Főoldal url definicíó
*/


function loggedIn()
{
    if (Auth::user()) {
        return true;
    } else {
        return false;
    }
}
function userHasRole()
{
}

function dbConnect()
{
    try {
        DB::connection()->getPDO();
        return true;
    } catch (\Exception $e) {
        return false;
    }
}

/*

    Routeok

*/

if (dbConnect()) {

    Route::get('/', function () {
        return view('welcome');
    });

    /**
     * 
     *  Eventek routjai
     */

    Route::get('/events', function () {
        return view('events.index');
    });

    Route::get('/event_create', function () {
        return view('events.event_create');
    });

    Route::get('/event/delete/{id}', function () {
        return view("events.confirm_delete");
    });

    Route::get('/event/modify/{id}', function () {
        return view("events.event_modify");
    });

    Route::get('/event/{id}', function () {
        return view("events.event_view");
    });
    

    /**
     * 
     * Egyenlőre minden más route.
     * 
     */
    Route::get('/blog', function () {
        return view('blog.index');
    });



    /* 
    
    Methodok kezelése
    
    */


    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    /* 
    
    Esemény kezelése
    
    */
    Route::post('check-in', 'App\Http\Controllers\event_manager@check_in');

    Route::post('export_event', 'App\Http\Controllers\event_manager@insert');
    Route::post('delete_event', 'App\Http\Controllers\event_manager@delete');
    Route::post('modify_event', 'App\Http\Controllers\event_manager@modify');

    //Route::post('delete_group', 'App\Http\Controllers\group_manage@delete_group');

    Route::get('/test', [App\Http\Controllers\PermissionTester::class, 'show']);
} else {
}
