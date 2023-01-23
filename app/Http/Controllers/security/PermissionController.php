<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use RealRashid\SweetAlert\Facades\Alert;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function unlink(Request $request)
    {
        $role = Role::findOrFail($request->get('role'));
        $permission = Permission::findOrFail($request->get('permission'));

        $role->revokePermissionTo($permission->name);
        Alert::success('', 'Record delete');
        return back();
    }

    public function link(Request $request)
    {
        $role = Role::findOrFail($request->get('role'));
        $permission = Permission::findOrFail($request->get('permission'));

        $role->givePermissionTo($permission->name);
        Alert::success('', 'Record saved');
        return back();
    }
}
