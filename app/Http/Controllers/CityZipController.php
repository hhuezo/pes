<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catalogue\County;
use App\Models\catalogue\City;
use App\Models\catalogue\CodeZip;


class CityZipController extends Controller
{
    //

    public function get_counties($id){

        $counties = County::where('state','=',$id)->get();

        return response()->json(
            $counties,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );



    }



    public function get_cities($id){

        //dd($id);

        $county = County::findOrFail($id);
        //$county = County::where('id','=',$id)->get();


        $cities = City::where('state','=',$county->state)->where('county','=',$county->name)->get();

        return response()->json(
            $cities,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );

    }


    public function get_zipcodes($id){

        //dd($id);

        $cities = City::findOrFail($id);
        //$county = County::where('id','=',$id)->get();


        $codes_zip = CodeZip::where('czc_state_fips','=',$cities->state)->where('czc_county','=',$cities->county)->where('czc_city','=',$cities->name)->get();

        //dd($codes_zip);

        return response()->json(
            $codes_zip,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );

    }


}
