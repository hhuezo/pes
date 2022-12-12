@extends ('dashboard')
@section('contenido')
    @if (session()->has('action'))
        @php($action = session('action'))
    @else
        @php($action = 1)
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
                                <a class="nav-link active" data-toggle="tab"
                                    href="#tab_content1">{!! trans('employer.Title') !!}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab_content2">{!! trans('employer.PrincipalPlaceBusiness') !!}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab_content3">{!! trans('employer.EmployerContactInformation') !!}</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <!-- tab 1 -->
                            <div class="tab-pane fade show active" id="tab_content1" role="tabpanel">
                                <form method="POST" action="{{ route('employer.update', $employer->id) }}">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">


                                        <div class="col-xl-12 col-xxl-12">&nbsp;</div>
                                        <div class="col-xl-6 col-xxl-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{!! trans('employer.LegalName') !!}</label>
                                                <input type="text" name="legal_business_name"
                                                    value="{{ old('legal_business_name', $employer->legal_business_name) }}"
                                                    required class="form-control">
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
                                                <label>{!! trans('employer.IdentificationNumber') !!}</label>
                                                <input type="text" name="federal_id_number"
                                                    value="{{ old('federal_id_number', $employer->federal_id_number) }}"
                                                    class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.YearBusinessEstablished') !!}</label>
                                                <input type="text" name="year_business_established"
                                                    value="{{ old('year_business_established', $employer->year_business_established) }}"
                                                    min="1900" max="<?php echo date('Y'); ?>" class="form-control" required
                                                    data-inputmask="'mask': ['9999']" data-mask class="form-control"
                                                    maxlength="4">
                                                @error('year_business_established')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.NumberEmployees') !!}</label>
                                                <input type="text" name="number_employees_full_time"
                                                    value="{{ old('number_employees_full_time', $employer->number_employees_full_time) }}"
                                                    class="form-control">
                                                @error('number_employees_full_time')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryBusinessPhone') !!}</label>
                                                <input type="text" name="primary_business_phone"
                                                    value="{{ old('primary_business_phone', $employer->primary_business_phone) }}"
                                                    class="form-control">
                                                @error('primary_business_phone')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryBusinessFax') !!}</label>
                                                <input type="text" name="primary_business_fax"
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
                                                <select class="form-control" required name="has_participate_h2b"
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
                                                <input type="number"
                                                    value="{{ old('quantity_year_has_participate_h2b', $employer->quantity_year_has_participate_h2b) }}"
                                                    id="quantity_year_has_participate_h2b"
                                                    value="{{ $employer->quantity_year_has_participate_h2b }}"
                                                    min="1" maxlength="4" class="form-control">
                                                @error('quantity_year_has_participate_h2b')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryBusiness') !!}</label>
                                                <select class="form-control" name="primary_business_type_id" required
                                                    value="{{ old('primary_business_type_id') }}"
                                                    id="PrimaryBusinessType">
                                                    <option value="">Select</option>
                                                    @foreach ($primary_business_types as $obj)
                                                        <option value="{{ $obj->id }}"
                                                            {{ $employer->primary_business_type_id == $obj->id ? 'selected' : '' }}>
                                                            {{ $obj->name_english }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>

                                            <div class="form-group" id="DivNaicsCodCompany">
                                                <label>{!! trans('employer.NaicsCodCompany') !!}</label>
                                                <select class="form-control" name="naics_id"
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
                                                <label>{!! trans('employer.GrossCompanyIncome') !!}</label>
                                                <input type="number" step="0.01" name="year_end_gross_company_income"
                                                    value="{{ old('year_end_gross_company_income', $employer->year_end_gross_company_income) }}"
                                                    class="form-control" required class="form-control">
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
                            <div class="tab-pane fade" id="tab_content2">
                                <form action="{{ url('employer_place_of_business') }}" method="POST">
                                    @csrf
                                    <div class="row">

                                        <div class="col-xl-12 col-xxl-12">&nbsp;</div>
                                        <div class="col-xl-6 col-xxl-6">
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="{{ $employer->id }}">
                                                <label>{!! trans('employer.PrincipalStreetAddress') !!}</label>
                                                <input type="text" name="principal_street_address"
                                                    value="{{ old('principal_street_address', $employer->principal_street_address) }}"
                                                    class="form-control">
                                                @error('principal_street_address')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>{!! trans('employer.PrincipalCity') !!}</label>
                                                <input type="text" name="principal_city"
                                                    value="{{ old('principal_city', $employer->principal_city) }}"
                                                    class="form-control">
                                                @error('principal_city')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.PrincipalCountry') !!}</label>
                                                <input type="text" name="principal_country"
                                                    value="{{ old('principal_country', $employer->principal_country) }}"
                                                    class="form-control">
                                                @error('principal_country')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.PrincipalState') !!}</label>
                                                <select class="form-control select2" name="principal_state_id">
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
                                                <label>{!! trans('employer.PrincipalZipCode') !!}</label>
                                                <input type="text" name="principal_zip_code"
                                                    value="{{ old('principal_zip_code', $employer->principal_zip_code) }}"
                                                    minlength="5" maxlength="5" data-inputmask="'mask': ['99999']"
                                                    data-mask class="form-control">
                                                @error('principal_zip_code')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                        </div>


                                        <div class="col-xl-6 col-xxl-6">
                                            <br>
                                            <div class="form-group">
                                                @if ($employer->mailing_address_same_above == 1)
                                                    <input type="checkbox" checked name="mailing_address_same_above"
                                                        id="SameAsAbove">&nbsp;{!! trans('employer.SameAsAbove') !!}
                                                @else
                                                    <input type="checkbox" name="mailing_address_same_above"
                                                        id="SameAsAbove">&nbsp;{!! trans('employer.SameAsAbove') !!}
                                                @endif

                                            </div>
                                            <br>
                                            <div id="DivMailin">
                                                <div class="form-group">
                                                    <label>{!! trans('employer.MailingAddress') !!}</label>
                                                    <input type="text" name="mailing_address"
                                                        value="{{ old('mailing_address', $employer->mailing_address) }}"
                                                        class="form-control">
                                                    @error('mailing_address')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.MailingCity') !!}</label>
                                                    <input type="text" name="mailing_city"
                                                        value="{{ old('mailing_city', $employer->mailing_city) }}"
                                                        class="form-control">
                                                    @error('mailing_city')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.MailingState') !!}</label>
                                                    <select class="form-control select2" name="mailing_state_id">
                                                        @foreach ($states as $obj)
                                                            @if ($obj->id == $employer->mailing_state_id)
                                                                <option value="{{ $obj->id }}" selected>
                                                                    {{ $obj->name }}</option>
                                                            @else
                                                                <option value="{{ $obj->id }}">
                                                                    {{ $obj->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('mailing_state_id')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.MailingZipCode') !!}</label>
                                                    <input type="text" name="mailing_zip_code"
                                                        value="{{ old('mailing_zip_code', $employer->mailing_zip_code) }}"
                                                        minlength="5" maxlength="5" class="form-control"
                                                        data-inputmask="'mask': ['99999']" data-mask>
                                                    @error('mailing_zip_code')
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
                            <div class="tab-pane fade" id="tab_content3">
                                <form action="{{ url('employer_contact_information') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="id" value="{{ $employer->id }}">
                                        <div class="col-xl-12 col-xxl-12">&nbsp;</div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryContact') !!}</label>
                                                <input type="text" name="primary_contact_name"
                                                    value="{{ old('primary_contact_name', $employer->primary_contact_name) }}"
                                                    class="form-control">
                                                @error('primary_contact_name')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.Last') !!}</label>
                                                <input type="text" name="primary_contact_last_name"
                                                    value="{{ old('primary_contact_last_name', $employer->primary_contact_last_name) }}"
                                                    class="form-control">
                                                @error('primary_contact_last_name')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryContactJobTitle') !!}</label>
                                                <input type="text" name="primary_contact_job_title"
                                                    value="{{ old('primary_contact_job_title', $employer->primary_contact_job_title) }}"
                                                    class="form-control">
                                                @error('primary_contact_job_title')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryContactEmail') !!}</label>
                                                <input type="text" name="primary_contact_email"
                                                    value="{{ old('primary_contact_email', $employer->primary_contact_email) }}"
                                                    class="form-control">
                                                @error('primary_contact_email')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryContactPhone') !!}</label>
                                                <input type="text" name="primary_contact_phone"
                                                    value="{{ old('primary_contact_phone', $employer->primary_contact_phone) }}"
                                                    class="form-control">
                                                @error('primary_contact_phone')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryContactCellPhone') !!}</label>
                                                <input type="text" name="primary_contact_cellphone"
                                                    value="{{ old('primary_contact_cellphone', $employer->primary_contact_cellphone) }}"
                                                    class="form-control">
                                                @error('primary_contact_cellphone')
                                                    <div class="alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>



                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryContactListed') !!}</label>
                                                <select class="form-control" name="signed_all_documents"
                                                    id="signed_all_documents">

                                                    @if ($employer->signed_all_documents == 0)
                                                        <option value="0" selected>
                                                            {!! trans('employer.No') !!}
                                                        </option>
                                                    @else
                                                        <option value="0">
                                                            {!! trans('employer.No') !!}
                                                        </option>
                                                    @endif

                                                    @if ($employer->signed_all_documents == 1)
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
                                            <div id="DivSignatory">

                                                <div class="form-group">
                                                    <label>{!! trans('employer.SignatoryName') !!}</label>
                                                    <input type="text" name="signatory_name"
                                                        value="{{ old('signatory_name', $employer->signatory_name) }}"
                                                        class="form-control">
                                                    @error('signatory_name')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.SignatoryLastName') !!}</label>
                                                    <input type="text" name="signatory_last_name"
                                                        value="{{ old('signatory_last_name', $employer->signatory_last_name) }}"
                                                        class="form-control">
                                                    @error('signatory_last_name')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.SignatoryJobTitle') !!}</label>
                                                    <input type="text" name="signatory_job_title"
                                                        value="{{ old('signatory_job_title', $employer->signatory_job_title) }}"
                                                        class="form-control">
                                                    @error('signatory_job_title')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.SignatoryEmail') !!}</label>
                                                    <input type="mail" name="signatory_email"
                                                        value="{{ old('signatory_email', $employer->signatory_email) }}"
                                                        class="form-control">
                                                    @error('signatory_email')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.SignatoryPhone') !!}</label>
                                                    <input type="text" name="signatory_phone"
                                                        value="{{ old('signatory_phone', $employer->signatory_phone) }}"
                                                        class="form-control">
                                                    @error('signatory_phone')
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
                                <label>{!! trans('employer.StreetAddress') !!}</label>
                                <input type="text" name="street_address" class="form-control">
                            </div>



                            <div class="form-group">
                                <label>{!! trans('employer.City') !!}</label>
                                <input type="text" name="city_address" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>{!! trans('employer.County') !!}</label>
                                <input type="text" name="country_address" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>{!! trans('employer.State') !!}</label>
                                <select class="form-control" name="state_id_address">
                                    @foreach ($states as $obj)
                                        <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label>{!! trans('employer.ZipCode') !!}</label>
                                <input type="text" name="zip_code_address" class="form-control">
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
                $("#PrimaryBusinessType").change();
                $("#SameAsAbove").change();
                $("#signed_all_documents").change();

            });

            // tab one
            $("#PrimaryBusinessType").change(function() {
                var PrimaryBusinessType = $(this).val();
                var naics_code = <?php echo $employer->naics_id; ?>;

                console.log("codigo: " + naics_code);

                if (PrimaryBusinessType != 6) {
                    $('#DivNaicsCodCompany').show();
                    $('#DivNaicsNameCompany').hide();

                    $.get("{{ url('get_naics_code') }}" + '/' + PrimaryBusinessType, function(data) {
                        //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
                        console.log(data);
                        var _select = ''
                        for (var i = 0; i < data.length; i++)
                            if (data[i].id == naics_code) {
                                _select += '<option value="' + data[i].id + '" selected >' + data[i]
                                    .code +
                                    ' ' + data[i]
                                    .name +
                                    '</option>';
                            }
                        else {
                            _select += '<option value="' + data[i].id + '"  >' + data[i].code +
                                ' ' + data[i]
                                .name +
                                '</option>';
                        }

                        $("#NaicsCod").html(_select);
                    });
                } else {
                    $('#DivNaicsCodCompany').hide();
                    $('#DivNaicsNameCompany').show();
                }
            });


            // end tab one



            $("#SameAsAbove").change(function() {
                if (document.getElementById('SameAsAbove').checked == true) {
                    $('#DivMailin').hide();

                } else {
                    $('#DivMailin').show();
                }

            });

            $("#signed_all_documents").change(function() {

                if (document.getElementById('signed_all_documents').value == 1) {
                    $('#DivSignatory').hide();

                } else {
                    $('#DivSignatory').show();
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
