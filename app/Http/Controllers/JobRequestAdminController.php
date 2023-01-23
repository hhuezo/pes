<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\JobRequest;
use App\Models\RequestDetail;
use App\Models\RequestDetailEnglishLevel;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class JobRequestAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('read request admin')) {
            $job_requests = JobRequest::join('employer','request.employer_id','=','employer.id')
            ->select('request.id','employer.legal_business_name as employer', 'request.start_date', 'request.end_date','request.request_status_id','request.paid',\DB::raw(
            "(select ifnull(SUM(detail.number_workers),0) from request_detail as detail where detail.request_id = request.id) as number_workers") )
            ->where('request.request_status_id', '>', '1')->get();
            return view('job_request_admin.index', ['job_requests' => $job_requests]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
        $job_request = JobRequest::findOrFail($id);

        $details = RequestDetail::where('request_id', '=', $id)->get();

        //dd($details);

        $array_id_details = [];

        foreach ($details as $detail) {
            array_push($array_id_details, $detail->id);
        }

        $positions = RequestDetailEnglishLevel::whereIn('request_detail_id', $array_id_details)->with('english_level')->get();

        //dd($positions);

        $now = Carbon::now();

        $start_date = Carbon::parse($job_request->start_date);
        $DeferenceInDays = Carbon::parse($now)->diffInDays($start_date);

        $end_hour = Carbon::parse($now->format('Y-m-d 23:59:59'));
        $DeferenceInHours = Carbon::parse($now)->diffInHours($end_hour);

        $start_hour = Carbon::parse($now->format('Y-m-d 23:i:00'));
        $DeferenceInMinutes = Carbon::parse($start_hour)->diffInMinutes($end_hour);

        $start_hour = Carbon::parse($now->format('Y-m-d 23:59:s'));
        $DeferenceInSeconds = Carbon::parse($start_hour)->diffInSeconds($end_hour);



        return view('job_request_admin.edit', [
            'job_request' => $job_request, 'positions' => $positions,
            'DeferenceInDays' => $DeferenceInDays, 'DeferenceInHours' => $DeferenceInHours, 'DeferenceInMinutes' => $DeferenceInMinutes,
            'DeferenceInSeconds' => $DeferenceInSeconds
        ]);

        //dd($job_request);
        //dd("llego a edit");
    }

    public function update(Request $request, $id)
    {
        $job_request = JobRequest::findOrFail($id);
        $job_request->request_rate = $request->get('request_rate');
        $job_request->request_status_id = 3; //RATE ASSIGNED
        $job_request->update();

        Alert::success('', 'Record saved');
        return redirect('job_request_admin/' . $id . '/edit');
    }

    public function destroy($id)
    {
        //
    }


}
