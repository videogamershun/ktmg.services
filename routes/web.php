<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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


    Route::get('/demit/{id}', function () {
        return view("events.user.demit");
    });
    Route::get('/event/{id}', function () {
        return view("events.user.event_view");
    });
    Route::get('/own', function () {
        return view("events.user.own_event");
    });

    /* Admin részleg */
    Route::get('/event_create', function () {
        return view('admin.event.event_create');
    });

    Route::get('/event/delete/{id}', function () {
        return view("admin.event.confirm_delete");
    });

    Route::get('/event/modify/{id}', function () {
        return view("admin.event.event_modify");
    });

    Route::get('/event/request/{id}', function () {
        return view("admin.event.request_people");
    });

    Route::get('/admin_own', function () {
        return view("admin.event.index");
    });
    Route::get('/modify_user', function () {
        return view("admin.user.modify_user");
    });

    /**
     * 
     *    Role, permission manager.
     * 
     */
    Route::get('/role/create', function () {
        return view("admin.permission.create_role");
    });

    Route::get('/permissions/create', function () {

        if (Auth::check()) {
          /*  if (Auth::user()->hasPermissionTo('admin.create_permission')) {
                return view("admin.permission.perm");
            } else {
                header("Location: /home");
            }*/
            return view("admin.permission.perm");
        } else {
            header("Location: /home");
        }
    });

  /**
     * 
     *   User manager.
     * 
     */
    Route::get('/user/create', function () {
        return view("admin.user.index");
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
    Route::post('demit_event', 'App\Http\Controllers\event_manager@demit');


    Route::post('create_new_role', 'App\Http\Controllers\CreateRole@insert');
    Route::post('create_new_perm', 'App\Http\Controllers\PermissionCreator@insert');

    //Route::post('delete_group', 'App\Http\Controllers\group_manage@delete_group');

    Route::get('/test', [App\Http\Controllers\PermissionTester::class, 'give_role']);
} else {
}
