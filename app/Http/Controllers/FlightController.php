<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\views\FlightCandidate;
use App\Models\catalogue\Airport;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\CandidateFlightItinerary;


class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $airports = Airport::get();
        $flight_candidates = FlightCandidate::get();

        return view('flight_admin.index', ["flight_candidates"=>$flight_candidates, "airports"=>$airports]);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function update_itinerary(Request $request){
        //dd("hola desde update_itinerary");

        $candidate_id = $request->get('candidate_id');
        $request_id = $request->get('request_id');
        $departure_date = $request->get('departure_date');
        $departure_time = $request->get('departure_time');
        $departure_airport_id = $request->get('departure_airport_id');
        $arrival_date = $request->get('arrival_date');
        $arrival_time = $request->get('arrival_time');
        $arrival_airport_id = $request->get('arrival_airport_id');


        $cfi = new CandidateFlightItinerary();
        $cfi->departure_date = $departure_date.' '.$departure_time;
        $cfi->departure_airport_id = $departure_airport_id;
        $cfi->arrival_date = $arrival_date.' '.$arrival_time;
        $cfi->arrival_airport_id = $arrival_airport_id;
        $cfi->candidate_id = $candidate_id;
        $cfi->request_id = $request_id;
        $cfi->save();

        Alert::success('', 'Record saved');
        return redirect('flight_admin');


    }
}
