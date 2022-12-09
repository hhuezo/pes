<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('security.role.index', ['roles' => Role::get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role;
        $role->name = $request->get('name');
        $role->guard_name = "web";
        $role->save();
        Alert::success('', 'Record saved');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $current_permissions = $role->role_has_permissions;
        $permissions = Permission::get();

        return view('security.role.edit', ['role' => $role,'permissions' => $permissions,'current_permissions' => $current_permissions ]);
    }


    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->get('name');
        $role->update();
        Alert::success('', 'Record saved');
        return back();
    }


    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        Alert::error('', 'Record delete');
        return back();
    }
}
