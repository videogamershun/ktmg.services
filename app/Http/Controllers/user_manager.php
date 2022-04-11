<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Htpp\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;


class user_manager extends Controller
{
    public function addUser(Request $request)
    {

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $name = $request->input('name');
        $password = $request->input('password');
        $year = $request->input('years');

        for ($i = 0; $i < count($name); $i++) {     
           $userId =substr(str_shuffle(str_repeat($pool, 5)), 0, 10);

            $pwd = Hash::make($password[$i]);

            $email = $name[$i] . '@tancsics.hu';

            $created_at = date("Y-m-d");


            $data = array(
                "id" => $userId,"name" => $name[$i], "email" => $email, "password" => $pwd, "year" => $year[$i], "created_at" => $created_at, "updated_at" => $created_at
            );

            DB::table('users')->insert($data);

            $user = User::where('name', $name[$i])->first();
            $user->assignRole('Diák');
        }

        return redirect("/home")->with('status', "Sikeresen regisztrálta a(z) felhasználókat!");
    }

    public function deleteUser(Request $request)
    {
        $userId = $request->input('userId');


        $checkUserIn = DB::table('users')->where('id', $userId)->first();
        $checkUserEm = DB::table('event_main')->where('id', $userId)->first();
        $checkUserEj = DB::table('event_joined')->where('id', $userId)->first();
        $checkUserHr = DB::table('model_has_roles')->where('model_id', $userId)->first();

        if ($checkUserIn != null) {
            DB::table('users')->where('id', $userId)->delete();
        }
        if ($checkUserEm != null) {
            DB::table('event_main')->where('user_id', $userId)->delete();
        }
        if ($checkUserEj != null) {
            DB::table('event_joined')->where('owner', $userId)->delete();
        }
        if ($checkUserHr != null) {
            DB::table('model_has_roles')->where('model_id', $userId)->delete();

        }
        return redirect("/home")->with('status', "Sikeresen törölted a(z) felhasználót");
    }
    public function updateUserRole(Request $request)
    {
        $userId = $request->input('user_id'); // Felhasználó id
        $userRole = $request->input('role'); //Új role

        $roleId = DB::table('model_has_roles')->where("model_id", $userId)->value('role_id');
        $roleName = DB::table('roles')->where("id", $roleId)->value('name');
        $user = User::where('id', $userId)->first();
        $user->removeRole($roleName);
        $user->assignRole($userRole);

        return redirect("/home")->with('status', "Sikeresen módósítottad a(z) felhasználót");

       
    }
}
