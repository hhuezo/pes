<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateFlightItinerary extends Model
{
    use HasFactory;

    protected $table = 'candidate_flight_itinerary';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'departure_date',
        'departure_airport_id',
        'arrival_date',
        'arrival_airport_id',
        'candidate_id',
        'request_id'
    ];

    protected $guarded = [];
}
