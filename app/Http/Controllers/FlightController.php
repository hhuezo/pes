<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\views\FlightCandidate;
use App\Models\catalogue\Airport;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\CandidateFlightItinerary;
use App\Models\CandidateDocumentRequest;
use App\Models\CandidateRequest;


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
        $airports = Airport::where('catalog_countries_id','=','235')->get();
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



        //inicio usar para subir archivo
        $file = $request->file('airplane_ticket');
        $id = uniqid();
        $file->move(public_path("flights/"), $id . ' ' . $file->getClientOriginalName());

        $cdr = new CandidateDocumentRequest();
        $cdr->request_id = $request_id;
        $cdr->document_id = 22; // documento boleto de viaje
        $cdr->candidate_id = $candidate_id;
        $cdr->comments = '';
        $cdr->document_path = $id . ' ' . $file->getClientOriginalName();
        $cdr->save();

        //dd($candidate_id);

        $candidate_request_detail_id = CandidateRequest::where('candidate_id', '=', $candidate_id)
        ->join('request_detail', 'request_detail.id', '=', 'candidates_per_request.request_detail_id')->get()->first()->id;

        //dd($candidate_request_detail_id);
        $candidate_request_id = CandidateRequest::where('request_detail_id', '=', $candidate_request_detail_id)->get()->first()->id;

        //dd($candidate_request_id);

        $candidate_request = CandidateRequest::findOrFail($candidate_request_id);
        $candidate_request->recruitment_status_id = 11; //FLIGHT TICKET PURCHASED
        $candidate_request->update();

        //fin usar para subir archivo

        Alert::success('', 'Record saved');
        return redirect('flight_admin');


    }


    public function get_airports_code($id)
    {
        return Airport::where('catalog_countries_id', '=', $id)->get();
    }

    public function get_candidate_flight_itinerary($id)
    {
        return CandidateFlightItinerary::where('candidate_id', '=', $id)->where('request_id', '=', '17')->get();
    }

}
