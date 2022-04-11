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
        return view('auth.login');
    });

    /**
     * 
     *  Eventek routjai
     */

    Route::get('/events', function () {

        if (Auth::check()) {
            if (Auth::user()->hasPermissionTo('users.index')) {
                return view('events.index');
            } else {
                return redirect()->to('/home')->send();
            }
        } else {
            return redirect()->to('/')->send();
        }
    });


    Route::get('/demit/{id}', function () {

        if (Auth::check()) {
            if (Auth::user()->hasPermissionTo('users.events.user.demit')) {
                return view("events.user.demit");
            } else {
                return redirect()->to('/home')->send();
            }
        } else {
            return redirect()->to('/')->send();
        }
    });
    Route::get('/event/{id}', function () {

        if (Auth::check()) {
            if (Auth::user()->hasPermissionTo('users.event_view')) {
                return view("events.user.event_view");
            } else {
                return redirect()->to('/home')->send();
            }
        } else {
            return redirect()->to('/')->send();
        }
    });
    Route::get('/own', function () {
        if (Auth::check()) {
            if (Auth::user()->hasPermissionTo('users.own_event')) {
                return view("events.user.own_event");
            } else {
                return redirect()->to('/home')->send();
            }
        } else {
            return redirect()->to('/')->send();
        }
    });

    /* Admin részleg */
    Route::get('/event_create', function () {
        if (Auth::check()) {
            if (Auth::user()->hasPermissionTo('admin.event.create')) {
                return view('admin.event.event_create');
            } else {
                return redirect()->to('/home')->send();
            }
        } else {
            return redirect()->to('/')->send();
        }
    });

    Route::get('/event/delete/{id}', function () {
        if (Auth::check()) {
            if (Auth::user()->hasPermissionTo('admin.event.delete')) {
                return view("admin.event.confirm_delete");
            } else {
                return redirect()->to('/home')->send();
            }
        } else {
            return redirect()->to('/')->send();
        }
    });

    Route::get('/event/modify/{id}', function () {

        if (Auth::check()) {
            if (Auth::user()->hasPermissionTo('admin.event.modify')) {
                return view("admin.event.event_modify");
            } else {
                return redirect()->to('/home')->send();
            }
        } else {
            return redirect()->to('/')->send();
        }
    });

    Route::get('/event/request/{id}', function () {

        if (Auth::check()) {
            if (Auth::user()->hasPermissionTo('event.request_people')) {
                return view("admin.event.request_people");
            } else {
                return redirect()->to('/home')->send();
            }
        } else {
            return redirect()->to('/')->send();
        }
    });

    Route::get('/admin_own', function () {
        if (Auth::check()) {
            if (Auth::user()->hasPermissionTo('admin.event.admin')) {
                return view("admin.event.index");
            } else {
                return redirect()->to('/home')->send();
            }
        } else {
            return redirect()->to('/')->send();
        }
    });
    Route::get('/modify_user', function () {

        if (Auth::check()) {
            if (Auth::user()->hasPermissionTo('admin.modify_user')) {
                return view("admin.user.modify_user");
            } else {
                return redirect()->to('/home')->send();
            }
        } else {
            return redirect()->to('/')->send();
        }
    });

    /**
     * 
     *    Role, permission manager.
     * 
     */
    Route::get('/role/create', function () {
        if (Auth::check()) {
            if (Auth::user()->hasPermissionTo('admin.create_role')) {
                return view("admin.permission.create_role");
            } else {
                return redirect()->to('/home')->send();
            }
        } else {
            return redirect()->to('/')->send();
        }
    });

    Route::get('/permissions/create', function () {

        if (Auth::check()) {
            if (Auth::user()->hasPermissionTo('admin.create_permission')) {
                return view("admin.permission.perm");
            } else {
                return redirect()->to('/home')->send();
            }
        } else {
            return redirect()->to('/')->send();
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
    Route::get('/delete/user/{id}', function () {
        return view("admin.user.delete_people");
    });
    Route::get('/testet', function () {
        return view("admin.core.test");
    });

    Route::post('file_upload', 'App\Http\Controllers\fileUpload@fileUploadPost');

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



    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    /* 
    
    Esemény kezelése
    
    */
    Auth::routes([
        'register' => false, // Registration Routes...
        'reset' => false, // Password Reset Routes...
        'verify' => false, // Email Verification Routes...
    ]);

    Route::post('check-in', 'App\Http\Controllers\event_manager@check_in');

    Route::post('export_event', 'App\Http\Controllers\event_manager@insert');
    Route::post('delete_event', 'App\Http\Controllers\event_manager@delete');
    Route::post('modify_event', 'App\Http\Controllers\event_manager@modify');
    Route::post('demit_event', 'App\Http\Controllers\event_manager@demit');


    Route::post('create_new_role', 'App\Http\Controllers\CreateRole@insert');
    Route::post('create_new_perm', 'App\Http\Controllers\PermissionCreator@insert');
    Route::post('create_users', 'App\Http\Controllers\user_manager@addUser');

    Route::post('delete_user', 'App\Http\Controllers\user_manager@deleteUser');
    Route::post('modify_user_role', 'App\Http\Controllers\user_manager@updateUserRole');



    //Route::post('delete_group', 'App\Http\Controllers\group_manage@delete_group');

    Route::get('/test', [App\Http\Controllers\PermissionTester::class, 'throttleKey']);
} else {
}
