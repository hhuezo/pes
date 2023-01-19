<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\EmployerWorksite;
use App\Models\JobRequest;
use Illuminate\Http\Request;
use App\Models\SwaLogin;
use App\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;


class EmployerAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('administrator') || $user->hasRole('administrator pes')) {
            $employers = Employer::get();
            $estate = ["Cancel", "Active"];
            return view('employer_admin.index', ['employers' => $employers, 'estate' => $estate]);
        }
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


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = auth()->user();
        if ($user->hasRole('administrator') || $user->hasRole('administrator pes')) {
            $employer = Employer::findOrFail($id);

            $request = JobRequest::join('catalog_request_status as status', 'status.id', '=', 'request.request_status_id')
                ->where('request.employer_id', '=', $employer->id)->groupBy('request.request_status_id')
                ->select(\DB::raw('count(*) as count'), 'status.name')
                ->orderBy('request.request_status_id')
                ->get();


            $swa_login = SwaLogin::where('employer_id', '=', $employer->id)->get();

            $contact_worksite = EmployerWorksite::where('employer_id', '=', $id)->where('address_type_id', '=', 5)->first();
            $main_worksite = EmployerWorksite::where('employer_id', '=', $id)->where('address_type_id', '=', 3)->first();
            $aditional_worksite = EmployerWorksite::where('employer_id', '=', $id)->where('address_type_id', '=', 4)->get();
            //dd($contact_worksite);

            $role = Role::findOrFail(4);
            $case_managers = $role->user_has_role;

            return view('employer_admin.edit', [
                'employer' => $employer, 'request' => $request, 'swa_login' => $swa_login, 'contact_worksite' => $contact_worksite,
                'main_worksite' => $main_worksite, 'aditional_worksite' => $aditional_worksite,'case_managers'=>$case_managers
            ]);
        }
    }


    public function activate(Request $request)
    {
        $employer = Employer::findOrFail($request->get('id'));
        $employer->validated = 1;
        $employer->case_manager_id = $request->get('case_manager_id');
        $employer->save();
        Alert::success('Ok', 'Record saved');
        return redirect('employer_admin/' .  $employer->id. '/edit');
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
