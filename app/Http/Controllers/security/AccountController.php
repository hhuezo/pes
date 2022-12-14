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
        $users_all = User::get();
        $array_id_user = array();
        $array_id_case_manager = array();
        foreach($users_all as $user)
        {
            if($user->hasAnyRole(['case manager', 'recruiter']))
            {
                array_push($array_id_user,$user->id);
            }
        }
        $users = User::whereIn('id',$array_id_user)->get();
        foreach($users as $user)
        {
            if($user->hasAnyRole(['case manager']))
            {
                $user->role = 'case manager';
                array_push($array_id_case_manager,$user->id);
            }else  if($user->hasAnyRole(['recruiter']))
            {
                $user->role = 'recruiter';
            }
        }
        $case_managers = User::whereIn('id',$array_id_case_manager)->get();
        $countries = Country::get();
        $roles = Role::whereIn('id',[4,5])->get();

        return view('security.account.index', ['users' => $users,'countries' => $countries,'roles' => $roles,'case_managers' => $case_managers]);
    }


    public function store(Request $request)
    {
        $time = Carbon::now('America/El_Salvador');
        $user = new User();
        $user->email = $request->get('email');
        $user->name = $request->get('name');
        $user->last_name = $request->get('last_name');
        $user->password = Hash::make($request->password);
        $user->country = $request->get('country');
        $user->date_admission = $time->toDateTimeString();
        if($request->get('role') == 5)
        {
            $user->case_manager = $request->get('case_manager');
        }
        $user->save();

        $role = Role::findOrFail($request->get('role'));

        $user->assignRole($role->name);
        Alert::success('', 'Record saved');
        return back();
    }

}
