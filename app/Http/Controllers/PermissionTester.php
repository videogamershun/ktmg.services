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

class PermissionTester extends Controller
{
    public function create_permission()
    {

        echo ("Sikerült");
    }
    public function create_role()
    {
        Role::create(['name' => 'Admin']);
        echo ("Sikerült");
    }
    public function give_role()
    {

        Auth::user()->removeRole('Tanár');
        Auth::user()->assignRole('Admin');
        echo ("Sikerült");
    }
    public function throttleKey(Request $request)
    {
        return Str::lower($request->input($this->username()));
    }
}
