<?php

namespace App\Http\Controllers\security;

use App\Http\Controllers\Controller;
use App\Models\catalogue\Country;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();


        if ($user->hasRole('administrator pes') == true) {
            $role = Role::findOrFail(4);
            $case_managers = $role->user_has_role;
            foreach ($case_managers as $obj) {
                $obj->role = $role->name;
            }


            $role = Role::findOrFail(5);
            $recluters = $role->user_has_role;

            foreach ($recluters as $obj) {
                $obj->role = $role->name;
            }
        } else if ($user->hasRole('Case manager') == true) {

            $case_managers = null;
            $role = Role::findOrFail(5);
            $recluters = User::where('case_manager','=',$user->id)->get();
            foreach ($recluters as $obj)
            {
                $obj->role = $role->name;
            }
        }


        $countries = Country::get();
        $roles = Role::whereIn('id', [4, 5])->get();

        return view('security.account.index', ['recluters' => $recluters, 'roles' => $roles, 'countries' => $countries, 'case_managers' => $case_managers]);
    }


    public function store(Request $request)
    {
        $time = Carbon::now('America/El_Salvador');
        $user = new User();
        $user->email = $request->get('email');
        $user->name = $request->get('name');
        $user->last_name = $request->get('last_name');
        $user->password = Hash::make($request->password);
        $user->country_id = $request->get('country');
        $user->date_admission = $time->toDateTimeString();
        if ($request->get('role') == 5) {
            $user->case_manager = $request->get('case_manager');
        }
        $user->save();

        $role = Role::findOrFail($request->get('role'));

        $user->assignRole($role->name);
        Alert::success('', 'Record saved');
        return back();
    }
}
