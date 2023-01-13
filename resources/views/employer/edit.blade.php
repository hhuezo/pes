@extends ('dashboard2')

@section('contenido')
    @if (session()->has('action'))
        @php($action = session('action'))
    @else
        @php($action = 1)
    @endif

    @if ($employer->signed_all_documents == 1)
        <style>
            .DivSignatory {
                display: none;
            }
        </style>
    @endif


    @if ($employer->is_main_worksite_location == 1)
        <style>
            .DivSamePlaceBusiness1 {
                display: none;
            }
        </style>
    @endif


    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">EMPLOYER</h4>

                    @can('approve employer')
                        @if ($employer->validated != 1)
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                onclick="modal();">Approve</button>
                        @endif
                    @endcan

                </div>
                <div class="card-body">
                    <!-- Nav tabs -->
                    <div class="default-tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab_content1">{!! trans('employer.GeneralData') !!}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab"
                                    href="#tab_content2">{!! trans('employer.EmployerInformation') !!}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab_content3">{!! trans('employer.EmployerData') !!}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab_content4">{!! trans('employer.Contact') !!}</a>
                            </li>

                        </ul>





                        <div class="tab-content">
                            <!-- tab 1 -->
                            <div class="tab-pane fade show active" id="tab_content2" role="tabpanel">
                                <form method="POST" action="{{ route('employer.update', $employer->id) }}">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">


                                        <div class="col-xl-12 col-xxl-12">&nbsp;</div>
                                        <div class="col-xl-6 col-xxl-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{!! trans('employer.LegalName') !!}<b
                                                        style="color: #FF9696">(*This field
                                                        is required
                                                        )</b></label>
                                                <input type="text" name="legal_business_name"
                                                    value="{{ old('legal_business_name', $employer->legal_business_name) }}"
                                                    class="form-control">
                                                @error('legal_business_name')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>{!! trans('employer.TradeName') !!}</label>
                                                <input type="text" name="trade_name"
                                                    value="{{ old('trade_name', $employer->trade_name) }}"
                                                    class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.IdentificationNumber') !!}<b style="color: #FF9696">(*This field
                                                        is required
                                                        )</b></label>
                                                <input type="text" name="federal_id_number"
                                                    data-inputmask="'mask': ['99-9999999']" data-mask
                                                    value="{{ old('federal_id_number', $employer->federal_id_number) }}"
                                                    class="form-control">
                                                @error('federal_id_number')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.YearBusinessEstablished') !!}<b style="color: #FF9696">(*This field
                                                        is required
                                                        )</b></label>
                                                <input type="text" name="year_business_established"
                                                    value="{{ old('year_business_established', $employer->year_business_established) }}"
                                                    min="1900" max="<?php echo date('Y'); ?>" class="form-control"
                                                    data-inputmask="'mask': ['9999']" data-mask class="form-control"
                                                    maxlength="4">
                                                @error('year_business_established')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.NumberEmployees') !!}<b style="color: #FF9696">(*This field
                                                        is required
                                                        )</b></label>
                                                <input type="text" name="number_employees_full_time"
                                                    value="{{ old('number_employees_full_time', $employer->number_employees_full_time) }}"
                                                    class="form-control">
                                                @error('number_employees_full_time')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryBusinessPhone') !!}<b style="color: #FF9696">(*This field
                                                        is required
                                                        )</b></label>
                                                <input type="text" name="primary_business_phone"
                                                    data-inputmask="'mask': ['(999)999-9999']" data-mask
                                                    value="{{ old('primary_business_phone', $employer->primary_business_phone) }}"
                                                    class="form-control">
                                                @error('primary_business_phone')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryBusinessFax') !!}</label>
                                                <input type="text" name="primary_business_fax"
                                                    data-inputmask="'mask': ['(999)999-9999']" data-mask
                                                    value="{{ old('primary_business_fax', $employer->primary_business_fax) }}"
                                                    class="form-control">
                                            </div>
                                        </div>


                                        <div class="col-xl-6 col-xxl-6">

                                            <div class="form-group">
                                                <label>{!! trans('employer.CompanyWebsite') !!}</label>
                                                <input type="text" name="company_website"
                                                    value="{{ old('company_website', $employer->company_website) }}"
                                                    class="form-control">
                                                @error('company_website')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label>{!! trans('employer.ParticipatedH-2B') !!}</label>
                                                <select class="form-control" name="has_participate_h2b"
                                                    value="{{ old('has_participate_h2b', $employer->has_participate_h2b) }}"
                                                    id="ParticipatedH-2B">
                                                    @if ($employer->has_participate_h2b == 0)
                                                        <option value="0" selected>
                                                            {!! trans('employer.No') !!}
                                                        </option>
                                                    @else
                                                        <option value="0">{!! trans('employer.No') !!}
                                                        </option>
                                                    @endif

                                                    @if ($employer->has_participate_h2b == 1)
                                                        <option value="1" selected>
                                                            {!! trans('employer.Yes') !!}
                                                        </option>
                                                    @else
                                                        <option value="1">{!! trans('employer.Yes') !!}
                                                        </option>
                                                    @endif

                                                </select>
                                            </div>


                                            <div class="form-group" id="DivYearsCompanyParticipated">
                                                <label>{!! trans('employer.YearsCompanyParticipated') !!}</label>
                                                <input type="number" name="quantity_year_has_participate_h2b"
                                                    id="quantity_year_has_participate_h2b"
                                                    value="{{ old('quantity_year_has_participate_h2b', $employer->quantity_year_has_participate_h2b) }}"
                                                    min="1" maxlength="4" class="form-control">
                                                @error('quantity_year_has_participate_h2b')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryBusiness') !!}<b style="color: #FF9696">(*This field
                                                        is required
                                                        )</b></label>
                                                <select class="form-control select2" name="industry_id"
                                                    value="{{ old('industry_id', $employer->industry_id) }}"
                                                    id="Industry">
                                                    <option value="">Select</option>
                                                    @foreach ($industries as $obj)
                                                        @if ($obj->id == $employer->catalog_industry_id)
                                                            <option value="{{ $obj->id }}" selected>
                                                                {{ $obj->id_code . ' ' . $obj->name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $obj->id }}">
                                                                {{ $obj->id_code . ' ' . $obj->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach

                                                </select>
                                            </div>

                                            <div class="form-group" id="DivNaicsCodCompany">
                                                <label>{!! trans('employer.NaicsCodCompany') !!}<b style="color: #FF9696">(*This field
                                                        is required
                                                        )</b></label>
                                                <select class="form-control select2" name="naics_id"
                                                    value="{{ old('naics_id', $employer->naics_id) }}" id="NaicsCod">

                                                </select>
                                            </div>

                                            <div class="form-group" id="DivNaicsNameCompany">
                                                <label>{!! trans('employer.NaicsCodCompany') !!}</label>
                                                <input type="text" name="naics_code"
                                                    value="{{ old('naics_code', $employer->naics_code) }}"
                                                    class="form-control">
                                                @error('naics_code')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.GrossCompanyIncome') !!}<b style="color: #FF9696">(*This field
                                                        is required
                                                        )</b></label>
                                                <input type="number" step="0.01" name="year_end_gross_company_income"
                                                    value="{{ old('year_end_gross_company_income', $employer->year_end_gross_company_income) }}"
                                                    class="form-control" class="form-control">
                                                @error('year_end_gross_company_income')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.NetCompanyIncome') !!}</label>
                                                <input type="number" step="0.01" name="year_end_net_company_income"
                                                    value="{{ old('year_end_net_company_income', $employer->year_end_net_company_income) }}"
                                                    class="form-control" class="form-control">
                                                @error('year_end_net_company_income')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        @can('edit employer')
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                                            </div>
                                        @endcan
                                    </div>

                                </form>



                            </div>
                            <!-- end tab 1 -->


                            <!-- tab 2 -->
                            <div class="tab-pane fade" id="tab_content3">
                                <form action="{{ url('employer_place_of_business') }}" method="POST">
                                    @csrf
                                    <div class="row">

                                        <div class="col-xl-12 col-xxl-12">&nbsp;</div>
                                        <div class="col-xl-6 col-xxl-6">



                                            <br>
                                            <br>


                                            <div class="form-group">
                                                <label>{!! trans('employer.PrincipalState') !!}<b style="color: #FF9696">(*This field
                                                        is required
                                                        )</b></label>
                                                <select class="form-control select2" name="principal_state_id"
                                                    id="PrincipalState">
                                                    <option value="">Select</option>
                                                    @foreach ($states as $obj)
                                                        @if ($obj->id == $employer->principal_state_id)
                                                            <option value="{{ $obj->id }}" selected>
                                                                {{ $obj->name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $obj->id }}">
                                                                {{ $obj->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('principal_state_id')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>



                                            <div class="form-group">
                                                <label>{!! trans('employer.PrincipalCountry') !!}<b style="color: #FF9696">(*This field
                                                        is required
                                                        )</b></label>
                                                <select class="form-control select2" name="principal_county_id"
                                                    id="principal_county_id">
                                                    @if ($counties_principal)
                                                        @foreach ($counties_principal as $obj)
                                                            @if ($obj->name == $employer->principal_county->czc_county)
                                                                <option value="{{ $obj->id }}" selected>
                                                                    {{ $obj->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $obj->id }}">
                                                                    {{ $obj->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endif


                                                </select>
                                                @error('principal_county_id')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>



                                            <div class="form-group">
                                                <label>{!! trans('employer.PrincipalCity') !!}<b style="color: #FF9696">(*This field
                                                        is required
                                                        )</b></label>
                                                <select class="form-control select2" name="principal_city_id"
                                                    id="principal_city_id"
                                                    value="{{ old('principal_city_id', $employer->principal_city_id) }}">
                                                    @if ($cities_principal)
                                                        @foreach ($cities_principal as $obj)
                                                            @if ($obj->name == $employer->principal_city->czc_city)
                                                                <option value="{{ $obj->id }}" selected>
                                                                    {{ $obj->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $obj->id }}">
                                                                    {{ $obj->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                </select>
                                                @error('principal_city_id')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label>{!! trans('employer.PrincipalZipCode') !!}<b style="color: #FF9696">(*This field
                                                        is required
                                                        )</b></label>
                                                <select class="form-control select2" name="principal_zip_code"
                                                    id="principal_zip_code">
                                                    @if ($codes_zip_principal)
                                                        @foreach ($codes_zip_principal as $obj)
                                                            @if ($obj->czc_zipcode == $employer->principal_zip_code)
                                                                <option value="{{ $obj->id }}" selected>
                                                                    {{ $obj->czc_zipcode }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $obj->id }}">
                                                                    {{ $obj->czc_zipcode }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endif


                                                </select>
                                                @error('principal_zip_code')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>





                                            <div class="form-group">
                                                <input type="hidden" name="id" value="{{ $employer->id }}">
                                                <label>{!! trans('employer.PrincipalStreetAddress') !!}<b style="color: #FF9696">(*This field
                                                        is required
                                                        )</b></label>
                                                <input type="text" name="principal_street_address"
                                                    value="{{ old('principal_street_address', $employer->principal_street_address) }}"
                                                    class="form-control">
                                                @error('principal_street_address')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>



                                        </div>


                                        <div class="col-xl-6 col-xxl-6">
                                            <div class="form-group">
                                                @if (old('mailing_address_same_above', $employer->mailing_address_same_above) === 1)
                                                    <input type="checkbox" name="mailing_address_same_above"
                                                        id="SameAsAbove" checked="">
                                                @else
                                                    <input type="checkbox" name="mailing_address_same_above"
                                                        id="SameAsAbove"
                                                        {{ old('mailing_address_same_above') ? 'checked' : '' }}>
                                                @endif
                                                &nbsp;{!! trans('employer.SameAsLeft') !!}
                                            </div>

                                            <div id="DivMailin">

                                                <div class="form-group">
                                                    <label>{!! trans('employer.MailingState') !!}<b style="color: #FF9696">(*This
                                                            field
                                                            is required
                                                            )</b></label>
                                                    <select class="form-control select2" name="mailing_state_id"
                                                        id="MailingState">
                                                        <option value="">Select</option>
                                                        @foreach ($states as $obj)
                                                            @if ($obj->id == $employer->mailing_state_id)
                                                                <option value="{{ $obj->id }}" selected>
                                                                    {{ $obj->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $obj->id }}">
                                                                    {{ $obj->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('mailing_state_id')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>



                                                <div class="form-group">
                                                    <label>{!! trans('employer.MailingCountry') !!}<b style="color: #FF9696">(*This
                                                            field
                                                            is required
                                                            )</b></label>
                                                    <select class="form-control select2" name="mailing_county_id"
                                                        id="mailing_county_id">
                                                        @if ($counties_mailing)
                                                            @foreach ($counties_mailing as $obj)
                                                                @if ($obj->name == $employer->mailling_county->czc_county)
                                                                    <option value="{{ $obj->id }}" selected>
                                                                        {{ $obj->name }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $obj->id }}">
                                                                        {{ $obj->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        @endif


                                                    </select>
                                                    @error('mailing_county_id')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>



                                                <div class="form-group">
                                                    <label>{!! trans('employer.MailingCity') !!}<b style="color: #FF9696">(*This
                                                            field
                                                            is required
                                                            )</b></label>
                                                    <select class="form-control select2" name="mailing_city_id"
                                                        id="mailing_city_id">
                                                        @if ($cities_mailing)
                                                            @foreach ($cities_mailing as $obj)
                                                                @if ($obj->name == $employer->mailling_city->czc_city)
                                                                    <option value="{{ $obj->id }}" selected>
                                                                        {{ $obj->name }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $obj->id }}">
                                                                        {{ $obj->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        @endif


                                                    </select>
                                                    @error('mailing_city_id')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label>{!! trans('employer.MailingZipCode') !!}<b style="color: #FF9696">(*This
                                                            field
                                                            is required
                                                            )</b></label>
                                                    <select class="form-control select2" name="mailing_zip_code"
                                                        id="mailing_zip_code"
                                                        value="{{ old('mailing_zip_code', $employer->mailing_zip_code) }}">
                                                        @if ($codes_zip_mailing)
                                                            @foreach ($codes_zip_mailing as $obj)
                                                                @if ($obj->czc_zipcode == $employer->mailing_zip_code)
                                                                    <option value="{{ $obj->id }}" selected>
                                                                        {{ $obj->czc_zipcode }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $obj->id }}">
                                                                        {{ $obj->czc_zipcode }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        @endif


                                                    </select>
                                                    @error('mailing_zip_code')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>




                                                <div class="form-group">
                                                    <input type="hidden" name="id" value="{{ $employer->id }}">
                                                    <label>{!! trans('employer.MailingAddress') !!}<b style="color: #FF9696">(*This
                                                            field
                                                            is required
                                                            )</b></label>
                                                    <input type="text" name="mailing_street_address"
                                                        value="{{ old('mailing_street_address', $employer->mailing_street_address) }}"
                                                        class="form-control">
                                                    @error('mailing_street_address')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>









                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                                        </div>





                                    </div>
                                </form>
                            </div>
                            <!-- end tab 2 -->

                            <!-- tab 3 -->
                            <div class="tab-pane fade" id="tab_content4">
                                <form action="{{ url('employer_contact_information') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="id" value="{{ $employer->id }}">
                                        <div class="col-xl-12 col-xxl-12">&nbsp;</div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryContact') !!}<b style="color: #FF9696">(*This field
                                                        is required
                                                        )</b></label>
                                                <input type="text" name="primary_contact_name"
                                                    value="{{ old('primary_contact_name', $employer->primary_contact_name) }}"
                                                    class="form-control">
                                                @error('primary_contact_name')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label>{!! trans('employer.contact_middle_name') !!}</label>
                                                <input type="text" name="contact_middle_name"
                                                    value="{{ old('contact_middle_name', $employer->contact_middle_name) }}"
                                                    class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.Last') !!}<b style="color: #FF9696">(*This field
                                                        is required
                                                        )</b></label>
                                                <input type="text" name="primary_contact_last_name"
                                                    value="{{ old('primary_contact_last_name', $employer->primary_contact_last_name) }}"
                                                    class="form-control">
                                                @error('primary_contact_last_name')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryContactJobTitle') !!}<b style="color: #FF9696">(*This field
                                                        is required
                                                        )</b></label>
                                                <input type="text" name="primary_contact_job_title"
                                                    value="{{ old('primary_contact_job_title', $employer->primary_contact_job_title) }}"
                                                    class="form-control">
                                                @error('primary_contact_job_title')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryContactEmail') !!}<b style="color: #FF9696">(*This field
                                                        is required
                                                        )</b></label>
                                                <input type="text" name="primary_contact_email"
                                                    value="{{ old('primary_contact_email', $employer->primary_contact_email) }}"
                                                    class="form-control">
                                                @error('primary_contact_email')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryContactPhone') !!}<b style="color: #FF9696">(*This field
                                                        is required
                                                        )</b></label>
                                                <input type="text" name="primary_contact_phone"
                                                    data-inputmask="'mask': ['(999)999-9999']" data-mask
                                                    value="{{ old('primary_contact_phone', $employer->primary_contact_phone) }}"
                                                    class="form-control">
                                                @error('primary_contact_phone')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryContactCellPhone') !!}<b style="color: #FF9696">(*This field
                                                        is required
                                                        )</b></label>
                                                <input type="text" name="primary_contact_cellphone"
                                                    data-inputmask="'mask': ['(999)999-9999']" data-mask
                                                    value="{{ old('primary_contact_cellphone', $employer->primary_contact_cellphone) }}"
                                                    class="form-control">
                                                @error('primary_contact_cellphone')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>



                                        </div>


                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>{!! trans('employer.State') !!}</label>
                                                <select class="form-control select2" name="contact_state_id" required
                                                    id="contact_state_id">
                                                    <option value="">Select</option>
                                                    @if ($work_sites_contact)
                                                        @foreach ($states as $obj)
                                                            @if ($obj->id == $work_sites_contact->state_id_address)
                                                                <option value="{{ $obj->id }}" selected>
                                                                    {{ $obj->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $obj->id }}">
                                                                    {{ $obj->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        @foreach ($states as $obj)
                                                            <option value="{{ $obj->id }}">
                                                                {{ $obj->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label>{!! trans('employer.County') !!}</label>
                                                <select class="form-control select2" name="contact_county_id" required
                                                    id="contact_county_id">
                                                    @if ($counties_work_sites_contact)
                                                        @foreach ($counties_work_sites_contact as $obj)
                                                            @if ($obj->id == $work_sites_contact->county_id)
                                                                <option value="{{ $obj->id }}" selected>
                                                                    {{ $obj->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $obj->id }}">
                                                                    {{ $obj->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label>{!! trans('employer.City') !!}</label>
                                                <select class="form-control select2" name="contact_city_id" required
                                                    id="contact_city_id">
                                                    @if ($cities_work_site_contact)
                                                        @foreach ($cities_work_site_contact as $obj)
                                                            @if ($obj->id == $work_sites_contact->city_id)
                                                                <option value="{{ $obj->id }}" selected>
                                                                    {{ $obj->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $obj->id }}">
                                                                    {{ $obj->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.ZipCode') !!}</label>
                                                <select class="form-control select2" name="contact_zip_code" required
                                                    id="contact_zip_code">
                                                    @if ($codes_zip_work_site_contact)
                                                        @foreach ($codes_zip_work_site_contact as $obj)
                                                            @if ($obj->czc_zipcode == $work_sites_contact->zip_code_address)
                                                                <option value="{{ $obj->id }}" selected>
                                                                    {{ $obj->czc_zipcode }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $obj->id }}">
                                                                    {{ $obj->czc_zipcode }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label>{!! trans('employer.StreetAddress') !!}</b></label>
                                                @if ($work_sites_contact)
                                                    <input type="text" name="contact_street_address" required
                                                        value="{{ $work_sites_contact->street_address }}"
                                                        class="form-control">
                                                @else
                                                    <input type="text" name="contact_street_address"
                                                        class="form-control">
                                                @endif


                                            </div>


                                        </div>


                                        <div class="col-md-12">&nbsp;</div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>{!! trans('employer.PrimaryContactListed') !!}</strong></label>
                                                <select class="form-control" name="signed_all_documents"
                                                    id="signed_all_documents">

                                                    @if (old('signed_all_documents', $employer->signed_all_documents) == 0)
                                                        <option value="0" selected>
                                                            {!! trans('employer.No') !!}
                                                        </option>
                                                    @else
                                                        <option value="0">
                                                            {!! trans('employer.No') !!}
                                                        </option>
                                                    @endif

                                                    @if (old('signed_all_documents', $employer->signed_all_documents) == 1)
                                                        <option value="1" selected>
                                                            {!! trans('employer.Yes') !!}
                                                        </option>
                                                    @else
                                                        <option value="1">
                                                            {!! trans('employer.Yes') !!}
                                                        </option>
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            &nbsp;
                                        </div>


                                        <div id="DivSignatory" class="col-md-12 row DivSignatory">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{!! trans('employer.SignatoryName') !!}<b style="color: #FF9696">(*This
                                                            field
                                                            is required
                                                            )</b></label>
                                                    <input type="text" name="signatory_name"
                                                        value="{{ old('signatory_name', $employer->signatory_name) }}"
                                                        class="form-control">
                                                    @error('signatory_name')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.SignatoryLastName') !!}<b style="color: #FF9696">(*This
                                                            field
                                                            is required
                                                            )</b></label>
                                                    <input type="text" name="signatory_last_name"
                                                        value="{{ old('signatory_last_name', $employer->signatory_last_name) }}"
                                                        class="form-control">
                                                    @error('signatory_last_name')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.SignatoryJobTitle') !!}<b style="color: #FF9696">(*This
                                                            field
                                                            is required
                                                            )</b></label>
                                                    <input type="text" name="signatory_job_title"
                                                        value="{{ old('signatory_job_title', $employer->signatory_job_title) }}"
                                                        class="form-control">
                                                    @error('signatory_job_title')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{!! trans('employer.SignatoryEmail') !!}<b style="color: #FF9696">(*This
                                                            field
                                                            is required
                                                            )</b></label>
                                                    <input type="mail" name="signatory_email"
                                                        value="{{ old('signatory_email', $employer->signatory_email) }}"
                                                        class="form-control">
                                                    @error('signatory_email')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.SignatoryPhone') !!}<b style="color: #FF9696">(*This
                                                            field
                                                            is required
                                                            )</b></label>
                                                    <input type="text" name="signatory_phone"
                                                        data-inputmask="'mask': ['(999)999-9999']" data-mask
                                                        value="{{ old('signatory_phone', $employer->signatory_phone) }}"
                                                        class="form-control">
                                                    @error('signatory_phone')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                            </div>

                                        </div>
                                        <div class="col-m-12">&nbsp;&nbsp;</div>
















                                        <div class="col-xl-6 col-xxl-6">
                                            <br>
                                            <div class="form-group">
                                                @if (old('is_main_worksite_location', $employer->is_main_worksite_location) == 1)
                                                    <input type="checkbox" name="is_main_worksite_location"
                                                        id="IsMainWorksiteLocation" checked="">
                                                @else
                                                    <input type="checkbox" name="is_main_worksite_location"
                                                        id="IsMainWorksiteLocation"
                                                        {{ old('is_main_worksite_location') ? 'checked' : '' }}>
                                                @endif
                                                &nbsp;{!! trans('employer.SamePlaceBusiness') !!}


                                            </div>

                                        </div>
                                        <div class="col-xl-12 col-xxl-12">
                                            &nbsp;
                                        </div>



                                        <div id="DivSamePlaceBusiness1" class="col-md-12 DivSamePlaceBusiness1">
                                            <div class="row">
                                                <div class="col-xl-6 col-xxl-6">

                                                    <div class="form-group">
                                                        <label>{!! trans('employer.MainWorksiteState') !!}</label>
                                                        <select class="form-control select2" name="main_worksite_state_id"
                                                            id="MainworksiteState" required>
                                                            <option value="">Select</option>
                                                            @if ($work_sites_main)
                                                                @foreach ($states as $obj)
                                                                    @if ($obj->id == $work_sites_main->state_id_address)
                                                                        <option value="{{ $obj->id }}" selected>
                                                                            {{ $obj->name }}
                                                                        </option>
                                                                    @else
                                                                        <option value="{{ $obj->id }}">
                                                                            {{ $obj->name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                @foreach ($states as $obj)
                                                                    <option value="{{ $obj->id }}">
                                                                        {{ $obj->name }}</option>
                                                                @endforeach
                                                            @endif

                                                        </select>
                                                        @error('main_worksite_state_id')
                                                            <div class="alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{!! trans('employer.MainWorksiteCounty') !!}</label>
                                                        <select class="form-control select2"
                                                            name="main_worksite_county_id" id="main_worksite_county_id" required>
                                                            @if ($counties_work_sites)
                                                                @foreach ($counties_work_sites as $obj)
                                                                    @if ($obj->name == $work_sites_main->county->czc_county)
                                                                        <option value="{{ $obj->id }}" selected>
                                                                            {{ $obj->name }}
                                                                        </option>
                                                                    @else
                                                                        <option value="{{ $obj->id }}">
                                                                            {{ $obj->name }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            @endif

                                                        </select>
                                                        @error('main_worksite_county_id')
                                                            <div class="alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>


                                                    <div class="form-group">
                                                        <label>{!! trans('employer.MainWorksiteCity') !!}</label>
                                                        <select class="form-control select2" name="main_worksite_city_id"
                                                            id="main_worksite_city_id" required>
                                                            @if ($cities_work_site)
                                                                @foreach ($cities_work_site as $obj)
                                                                    @if ($obj->name == $work_sites_main->city->czc_city)
                                                                        <option value="{{ $obj->id }}" selected>
                                                                            {{ $obj->name }}
                                                                        </option>
                                                                    @else
                                                                        <option value="{{ $obj->id }}">
                                                                            {{ $obj->name }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('main_worksite_city_id')
                                                            <div class="alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>



                                                </div>

                                                <div class="col-xl-6 col-xxl-6">

                                                    <div class="form-group">
                                                        <label>{!! trans('employer.MainWorksiteZipCode') !!}</label>
                                                        <select class="form-control select2" name="main_worksite_zip_code"
                                                            id="main_worksite_zip_code" required>


                                                            @if ($codes_zip_work_site)
                                                                @foreach ($codes_zip_work_site as $obj)
                                                                    @if ($obj->czc_zipcode == $work_sites_main->zip_code_address)
                                                                        <option value="{{ $obj->id }}" selected>
                                                                            {{ $obj->czc_zipcode }}
                                                                        </option>
                                                                    @else
                                                                        <option value="{{ $obj->id }}">
                                                                            {{ $obj->czc_zipcode }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            @endif

                                                        </select>
                                                        @error('main_worksite_zip_code')
                                                            <div class="alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>



                                                    <div class="form-group">
                                                        <label>{!! trans('employer.MainWorksiteStreetAddress') !!}<b style="color: #FF9696">(*This
                                                                field
                                                                is required
                                                                )</b></label>
                                                        @if ($work_sites_main)
                                                            <input type="text" name="main_worksite_location"
                                                                value="{{ $work_sites_main->street_address }}"
                                                                class="form-control">
                                                        @else
                                                            <input type="text" name="main_worksite_location"
                                                                class="form-control">
                                                        @endif
                                                        @error('main_worksite_location')
                                                            <div class="alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>


                                                </div>

                                            </div>


                                        </div>


                                        <div class="col-md-12">
                                            <button type="submit"
                                                class="btn btn-primary float-right">Submit</button>
                                        </div>

                                    </div>

                                </form>

                                @if ($work_sites_main)
                                    <button type="button" class="btn btn-rounded btn-info btn-lg" data-toggle="modal"
                                        data-target=".bd-example-modal-lg"><strong>Add
                                            Worksite</strong><span class="btn-icon-right">
                                            <i class="fa fa-plus color-info"></i></span>
                                    </button>





                                    @if ($worksites_additional)
                                        <table id="example2" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>State</th>
                                                    <th>County</th>
                                                    <th>City</th>
                                                    <th>Zip Code</th>
                                                    <th>Address</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($worksites_additional as $obj)
                                                    <tr>
                                                        @if ($obj->state_id_address)
                                                            <td>{{ $obj->state->cs_state }}</td>
                                                        @else
                                                            <td></td>
                                                        @endif

                                                        @if ($obj->county_id)
                                                            <td>{{ $obj->county->czc_county }}aa</td>
                                                        @else
                                                            <td></td>
                                                        @endif

                                                        @if ($obj->city_id)
                                                            <td>{{ $obj->city->czc_city }}</td>
                                                        @else
                                                            <td></td>
                                                        @endif



                                                        <td>{{ $obj->zip_code_address }}</td>



                                                        @if ($obj->street_address)
                                                            <td>{{ $obj->street_address }}</td>
                                                        @else
                                                            <td></td>
                                                        @endif



                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif




                                @endif





                            </div>



                        </div>

                        <!-- end tab 3 -->

                    </div>
                </div>




            </div>
        </div>
    </div>
    </div>



    <!-- Large modal -->

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{!! trans('employer.AdditionalEmployerWorksiteAddress') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form method="POST" action="{{ url('employer_additional_location') }}">
                        @csrf
                        <div class="modal-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><strong>{!! trans('employer.AdditionalEmployerworksiteLocation') !!}</strong></h4>
                                </div>
                                <div class="col-md-12">{!! trans('employer.DoIncludeCustomer') !!}</div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="employer_id" value="{{ $employer->id }}">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">


                            <div class="form-group">
                                <label>{!! trans('employer.WorksiteState') !!}</label>
                                <select class="form-control select2" name="state_id_address" id="WorksiteState">
                                    <option value="">Select</option>
                                    @foreach ($states as $obj)
                                        <option value="{{ $obj->id }}">
                                            {{ $obj->name }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="form-group">
                                <label>{!! trans('employer.WorksiteCounty') !!}</label>
                                <select class="form-control select2" name="county_id" id="county_id"
                                    value="{{ old('county_id', $employer->county_id) }}">
                                </select>
                            </div>



                            <div class="form-group">
                                <label>{!! trans('employer.WorksiteCity') !!}</label>
                                <select class="form-control select2" name="city_id" id="city_id"
                                    value="{{ old('city_id', $employer->city_id) }}">
                                </select>
                            </div>


                            <div class="form-group">
                                <label>{!! trans('employer.WorksiteZipCode') !!}</label>
                                <select class="form-control select2" name="zip_code_address" id="zip_code_address"
                                    value="{{ old('zip_code_address', $employer->zip_code_address) }}">
                                </select>
                            </div>


                            <div class="form-group">
                                <input type="hidden" name="id" value="{{ $employer->id }}">
                                <label>{!! trans('employer.WorksiteStreetAddress') !!}</label>
                                <input type="text" name="street_address" class="form-control">
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>

                    </form>







                </div>

            </div>
        </div>
    </div>

    <!-- modal approve -->

    <div class="modal fade " id="modal_approve" tabindex="-1" role="dialog" aria-hidden="true" data-tipo="1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ url('employer/activate') }}">
                    <div class="modal-header">
                        <h5 class="modal-title">approve</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="{{ $employer->id }}">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <h4>Do you want to approve the employer?</h4>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @include('sweetalert::alert')

    <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            if (document.getElementById('ParticipatedH-2B').value == 1) {
                $('#DivYearsCompanyParticipated').show();
            } else {
                $('#DivYearsCompanyParticipated').hide();
                document.getElementById('quantity_year_has_participate_h2b').value = '';
            }

            var action = '<?php echo $action; ?>';
            //alert(action);
            switch (action) {

                case '2':
                    $('.nav-tabs a[href="#tab_content2"]').tab('show');
                    break;
                case '3':
                    $('.nav-tabs a[href="#tab_content3"]').tab('show');
                    break;
                case '4':
                    $('.nav-tabs a[href="#tab_content4"]').tab('show');
                    break;
                case '5':
                    $('.nav-tabs a[href="#tab_content5"]').tab('show');
                    break;
                case '6':
                    $('.nav-tabs a[href="#tab_content6"]').tab('show');
                    break;
                case '7':
                    $('.nav-tabs a[href="#tab_content7"]').tab('show');
                    break;
            }

            $(document).ready(function() {
                $("#Industry").change();
                //$("#SameAsAbove").change();
                $("#signed_all_documents").change();

                // $("#PrincipalState").change();
                //$("#MailingState").change();


            });




            $("#Industry").change(function() {
                var Industry = $(this).val();

                var naics_id = '<?php echo $employer->naics_id; ?>';



                if (Industry != 6) {
                    $('#DivNaicsCodCompany').show();
                    $('#DivNaicsNameCompany').hide();

                    $.get("{{ url('get_naics_code') }}" + '/' + Industry, function(data) {
                        //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
                        console.log(data);
                        var _select = ''
                        for (var i = 0; i < data.length; i++)
                            if (data[i].id == naics_id) {
                                _select += '<option value="' + data[i].id + '" selected >' + data[i]
                                    .cn_code +
                                    ' ' + data[i]
                                    .cn_description +
                                    '</option>';
                            }
                        else {
                            _select += '<option value="' + data[i].id + '"  >' + data[i].cn_code +
                                ' ' + data[i]
                                .cn_description +
                                '</option>';
                        }



                        $("#NaicsCod").html(_select);
                    });
                } else {
                    $('#DivNaicsCodCompany').hide();
                    $('#DivNaicsNameCompany').show();
                }
            });


            $("#SameAsAbove").change(function() {
                if (document.getElementById('SameAsAbove').checked == true) {
                    $('#DivMailin').hide();

                } else {
                    $('#DivMailin').show();
                }
            });


            //principal

            $("#PrincipalState").change(function() {
                var State = $(this).val();
                load_counties(State, "principal_county_id");
            });

            $("#principal_county_id").change(function() {
                var County = $(this).val();
                load_cities(County, "principal_city_id");
            });

            $("#principal_city_id").change(function() {
                var City = $(this).val();
                load_zip_cods(City, "principal_zip_code");
            });




            //Mailing
            $("#MailingState").change(function() {
                var State = $(this).val();
                load_counties(State, "mailing_county_id");
            });


            $("#mailing_county_id").change(function() {
                var County = $(this).val();
                load_cities(County, "mailing_city_id");
            });

            $("#mailing_city_id").change(function() {
                var State = $(this).val();
                load_zip_cods(State, "mailing_zip_code");
            });



            //contact
            $("#contact_state_id").change(function() {
                var State = $(this).val();
                load_counties(State, "contact_county_id");
            });

            $("#contact_county_id").change(function() {
                var State = $(this).val();
                load_cities(State, "contact_city_id");
            });

            $("#contact_city_id").change(function() {
                var State = $(this).val();
                load_zip_cods(State, "contact_zip_code");
            });


            //main_worksite
            $("#MainworksiteState").change(function() {
                var State = $(this).val();
                load_counties(State, "main_worksite_county_id");
            });


            $("#main_worksite_county_id").change(function() {
                var State = $(this).val();
                load_cities(State, "main_worksite_city_id");
            });


            $("#main_worksite_city_id").change(function() {
                var State = $(this).val();
                load_zip_cods(State, "main_worksite_zip_code");
            });


            //modal
            $("#WorksiteState").change(function() {
                var State = $(this).val();
                load_counties(State, "county_id");
            });

            $("#county_id").change(function() {
                var State = $(this).val();
                load_cities(State, "city_id");
            });

            $("#city_id").change(function() {
                var State = $(this).val();
                load_zip_cods(State, "zip_code_address");
            });



            function load_counties(id, control) {
                if (id > 0) {
                    var selector = "#" + control;
                    //console.log(selector);
                    $.get("{{ url('get_counties') }}" + '/' + id, function(data) {
                        var _select = '<option value="">Select</option>'
                        for (var i = 0; i < data.length; i++)
                            _select += '<option value="' + data[i].id + '"  >' + data[i].name +
                            '</option>';
                        $(selector).html(_select);
                    });
                }
            }


            function load_cities(id, control) {
                if (id > 0) {
                    var selector = "#" + control;
                    //console.log(selector);
                    $.get("{{ url('get_cities') }}" + '/' + id, function(data) {
                        var _select = '<option value="">Select</option>'
                        for (var i = 0; i < data.length; i++)
                            _select += '<option value="' + data[i].id + '"  >' + data[i].name +
                            '</option>';
                        $(selector).html(_select);
                    });
                }
            }

            function load_zip_cods(id, control) {
                if (id > 0) {
                    var selector = "#" + control;
                    //console.log(selector);
                    $.get("{{ url('get_zipcodes') }}" + '/' + id, function(data) {
                        var _select = ''
                        for (var i = 0; i < data.length; i++)
                            _select += '<option value="' + data[i].id + '"  >' + data[i]
                            .czc_zipcode + '</option>';
                        $(selector).html(_select);
                    });
                }
            }








            $("#signed_all_documents").change(function() {

                if (document.getElementById('signed_all_documents').value == 1) {
                    $('#DivSignatory').hide();

                } else {
                    $('#DivSignatory').show();
                }

            });



            $("#IsMainWorksiteLocation").change(function() {
                if (document.getElementById('IsMainWorksiteLocation').checked == true) {
                    $('#DivSamePlaceBusiness1').hide();
                    $('#DivSamePlaceBusiness2').hide();
                    $('#DivSamePlaceBusiness3').hide();

                } else {
                    $('#DivSamePlaceBusiness1').show();
                    $('#DivSamePlaceBusiness2').show();
                    $('#DivSamePlaceBusiness3').show();
                }

            });

        });

        // tab one
        $("#ParticipatedH-2B").change(function() {
            if (document.getElementById('ParticipatedH-2B').value == 1) {
                $('#DivYearsCompanyParticipated').show();
            } else {
                $('#DivYearsCompanyParticipated').hide();
                document.getElementById('quantity_year_has_participate_h2b').value = '';
            }
        });
        // end tab one

        function modal() {
            $('#modal_approve').modal('show');
        }
    </script>
@endsection
