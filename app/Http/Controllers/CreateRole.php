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

class CreateRole extends Controller
{
    public function insert(Request $request)
    {

        $name = $request->input('name');
        $permission = $request->input('check_list');

        Role::create(['name' => $name]);

        $role = Role::findByName($name);
    

        foreach ($_POST['check_list'] as $check) {
          
            $role->givePermissionTo($check);
        }

        return redirect("/role/create")->with('status', "Sikeresen létrehoztad a csoportot!");
    }
}
