<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTester extends Controller
{
    public function show()
    {
        Permission::create(['name' => 'dok admin']);
        echo("Sikerült");
    }

}
