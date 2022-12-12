<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'legal_business_name' => 'required|min:4',
            'federal_id_number' => 'required|min:9',
            'year_business_established' => 'required|min:4',
            'number_employees_full_time' => 'required|min:1',
            'primary_business_phone' => 'required|min:10',
            'primary_business_fax' => 'required|min:10',
            'primary_business_type_id' => 'required|min:0',
            'naics_id' => 'required|min:0',
            'year_end_gross_company_income' => 'required|min:4',
            'principal_street_address' => 'required|min:6',
            'principal_city' => 'required|min:4',
            'principal_country' => 'required|min:6',
            'principal_state_id' => 'required|min:0',
            'principal_zip_code' => 'required|min:5',        
        ];
    }

    public function messages()
    {
        return [
            'legal_business_name.required' => 'legal_business_name is required',   
            'federal_id_number.required' => 'federal_id_number is required',   
            'year_business_established.required' => 'year_business_established is required',   
            'number_employees_full_time.required' => 'number_employees_full_time is required',   
            'primary_business_phone.required' => 'primary_business_phone is required',   
            'primary_business_fax.required' => 'primary_business_fax is required',   
            'primary_business_type_id.required' => 'primary_business_type_id is required',   
            'naics_id.required' => 'naics_id is required',   
            'year_end_gross_company_income.required' => 'year_end_gross_company_income is required',   
            'principal_street_address.required' => 'principal_street_address is required',   
            'principal_city.required' => 'principal_city is required',   
            'principal_country.required' => 'principal_country is required',   
            'principal_state_id.required' => 'principal_state_id is required',   
            'principal_zip_code.required' => 'principal_zip_code is required',                                 
        ];
    }
}
