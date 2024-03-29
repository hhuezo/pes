<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;
    protected $table = 'employer';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'legal_business_name',
        'applicable_trade_name',
        'trade_name',
        'federal_id_number',
        'year_business_established',
        'number_employees_full_time',
        'primary_business_phone',
        'primary_business_fax',
        'company_website',
        'has_participate_h2b',
        'quantity_year_has_participate_h2b',
        'catalog_industry_id',
        'naics_id',
        'naics_code',
        'year_end_gross_company_income',
        'year_end_net_company_income',
        'principal_county_id',
        'principal_state_id',
        'principal_city_id',
        'principal_street_address',
        'principal_zip_code',
        'mailing_address_same_above',
        'mailing_address',
        'mailing_city_id',
        'mailing_county_id',
        'mailing_state_id',
        'mailing_zip_code',
        'primary_contact_name',
        'primary_contact_last_name',
        'primary_contact_job_title',
        'primary_contact_email',
        'primary_contact_phone',
        'primary_contact_cellphone',
        'add_contact_person',
        'additional_contact',
        'additional_contact_job_title',
        'additional_contact_email',
        'additional_contact_phone',
        'additional_contact_cellphone',
        'signed_all_documents',
        'signatory_name',
        'signatory_last_name',
        'signatory_job_title',
        'signatory_email',
        'signatory_phone',

        'main_worksite_location',
        'is_there_additional_worksite',
        'normal_business_seven_days',
        'normal_business_five_days',
        'normal_business_six_days',
        'normal_business_other_days',
        'normal_business_other_days_des',
        'is_transportation_provided',
        'how_far_transportation_from_worksite',
        'local_transportation_website',
        'place_employment_notes',
        'validated',
        'case_manager_id'

    ];



    protected $guarded = [];


    public function industry()
    {
        return $this->belongsTo('App\Models\catalogue\Industry', 'catalog_industry_id', 'id');
    }

    public function naicsCode()
    {
        return $this->belongsTo('App\Models\catalogue\NaicsCode', 'naics_id', 'id');
    }

    public function principal_state()
    {
        return $this->belongsTo('App\Models\catalogue\State', 'principal_state_id', 'id');
    }

    public function principal_county()
    {
        return $this->belongsTo('App\Models\catalogue\CityZip', 'principal_county_id', 'id');
    }

    public function principal_city()
    {
        return $this->belongsTo('App\Models\catalogue\CityZip', 'principal_city_id', 'id');
    }

    public function user_has_employer()
    {
        return $this->belongsToMany('App\Models\User','users_has_employers','employer_id');
    }


    public function mailling_state()
    {
        return $this->belongsTo('App\Models\catalogue\State', 'mailing_state_id', 'id');
    }




    public function mailling_county()
    {
        return $this->belongsTo('App\Models\catalogue\CityZip', 'mailing_county_id', 'id');
    }


    public function mailling_city()
    {
        return $this->belongsTo('App\Models\catalogue\CityZip', 'mailing_city_id', 'id');
    }


    public function case_manager()
    {
        return $this->belongsTo('App\Models\User', 'case_manager_id', 'id');
    }

}
