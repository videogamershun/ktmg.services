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

class PermissionCreator extends Controller
{
    public function insert(Request $request)
    {

        $permName = $request->input('permName');

        Permission::create(['name' => $permName]);


        return redirect("/permissions/create")->with('status', "Sikeresen létrehoztad a permissiont!");
    }
}
