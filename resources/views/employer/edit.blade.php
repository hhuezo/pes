@extends ('dashboard')
@section('contenido')
    <?php if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 2;
    }
    ?>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">EMPLOYER</h4>
                </div>
                <div class="card-body">
                    <!-- Nav tabs -->
                    <div class="default-tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#home">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#profile">Localitation</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade" id="home" role="tabpanel">


                                <div class="row">
                                    <div class="col-xl-12 col-xxl-12">

                                            <div class="card-header">
                                                <h4 class="card-title">EMPLOYER INFORMATION</h4>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST" action="{{ route('employer.update', $employer->id) }}">
                                                    @method('PUT')
                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-xl-6 col-xxl-12">

                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('employer.LegalName') !!}</label>
                                                                <input type="text" name="legal_business_name"
                                                                    value="{{ $employer->legal_business_name }}" required
                                                                    class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>{!! trans('employer.TradeName') !!}</label>
                                                                <input type="text" name="trade_name"
                                                                    value="{{ $employer->trade_name }}"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>{!! trans('employer.IdentificationNumber') !!}</label>
                                                                <input type="text" name="federal_id_number"
                                                                    value="{{ $employer->federal_id_number }}"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>{!! trans('employer.YearBusinessEstablished') !!}</label>
                                                                <input type="number" name="year_business_established"
                                                                    value="{{ $employer->year_business_established }}"
                                                                    min="1900" max="<?php echo date('Y'); ?>"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>{!! trans('employer.NumberEmployees') !!}</label>
                                                                <input type="text" name="number_employees_full_time"
                                                                    value="{{ $employer->number_employees_full_time }}"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>{!! trans('employer.PrimaryBusinessPhone') !!}</label>
                                                                <input type="text" name="primary_business_phone"
                                                                    value="{{ $employer->primary_business_phone }}"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>{!! trans('employer.PrimaryBusinessFax') !!}</label>
                                                                <input type="text" name="primary_business_fax"
                                                                    value="{{ $employer->primary_business_fax }}"
                                                                    class="form-control">
                                                            </div>



                                                        </div>

                                                        <div class="col-xl-6 col-xxl-12">

                                                            <div class="form-group">
                                                                <label>{!! trans('employer.CompanyWebsite') !!}</label>
                                                                <input type="text" name="company_website"
                                                                    value="{{ $employer->company_website }}"
                                                                    class="form-control">
                                                            </div>


                                                            <div class="form-group">
                                                                <label>{!! trans('employer.ParticipatedH-2B') !!}</label>
                                                                <select class="form-control" name="has_participate_h2b"
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
                                                                    name="quantity_year_has_participate_h2b"
                                                                    value="{{ $employer->quantity_year_has_participate_h2b }}"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>{!! trans('employer.PrimaryBusiness') !!}</label>
                                                                <select class="form-control" name="primary_business_type_id"
                                                                    id="PrimaryBusinessType">
                                                                    <option value="">Select</option>
                                                                    @foreach ($primary_business_types as $obj)
                                                                        @if ($obj->id == $employer->primary_business_type_id)
                                                                            <option value="{{ $obj->id }}" selected>
                                                                                {{ $obj->name_english }}
                                                                            </option>
                                                                        @else
                                                                            <option value="{{ $obj->id }}">
                                                                                {{ $obj->name_english }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group" id="DivNaicsCodCompany">
                                                                <label>{!! trans('employer.NaicsCodCompany') !!}</label>
                                                                <select class="form-control" name="naics_id"
                                                                    id="NaicsCod">
                                                                    @foreach ($naics as $obj)
                                                                        @if ($obj->id == $employer->primary_business_type_id)
                                                                            <option value="{{ $obj->id }}" selected>
                                                                                {{ $obj->name }}
                                                                            </option>
                                                                        @else
                                                                            <option value="{{ $obj->id }}">
                                                                                {{ $obj->name }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group" id="DivNaicsNameCompany">
                                                                <label>{!! trans('employer.NaicsCodCompany') !!}</label>
                                                                <input type="text" name="naics_code"
                                                                    value="{{ $employer->naics_code }}"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>{!! trans('employer.GrossCompanyIncome') !!}</label>
                                                                <input type="number" name="year_end_gross_company_income"
                                                                    value="{{ $employer->year_end_gross_company_income }}"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>{!! trans('employer.NetCompanyIncome') !!}</label>
                                                                <input type="number" name="year_end_net_company_income"
                                                                    value="{{ $employer->year_end_net_company_income }}"
                                                                    class="form-control">
                                                            </div>



                                                        </div>

                                                        <div class="with-header">
                                                            <h4 class="card-title">{!! trans('employer.PrincipalPlaceBusiness') !!}</h4>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-xl-6 col-xxl-12">
                                                            <div class="form-group">
                                                                <label>{!! trans('employer.PrincipalStreetAddress') !!}</label>
                                                                <input type="text" name="principal_street_address"
                                                                    value="{{ $employer->principal_street_address }}"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>{!! trans('employer.PrincipalCity') !!}</label>
                                                                <input type="text" name="principal_city"
                                                                    value="{{ $employer->principal_city }}"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>{!! trans('employer.PrincipalCountry') !!}</label>
                                                                <input type="text" name="principal_country"
                                                                    value="{{ $employer->principal_country }}"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>{!! trans('employer.PrincipalState') !!}</label>
                                                                <select class="form-control" name="principal_state_id">
                                                                    @foreach ($principal_states as $obj)
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
                                                            </div>

                                                            <div class="form-group">
                                                                <label>{!! trans('employer.PrincipalZipCode') !!}</label>
                                                                <input type="number" name="principal_zip_code"
                                                                    value="{{ $employer->principal_zip_code }}"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-xxl-12">
                                                            <br>
                                                            <div class="form-group">
                                                                <input type="checkbox" name="mailing_address_same_above"
                                                                    id="SameAsAbove">&nbsp;{!! trans('employer.SameAsAbove') !!}
                                                            </div>
                                                            <br>
                                                            <div id="DivMailin">
                                                                <div class="form-group">
                                                                    <label>{!! trans('employer.MailingAddress') !!}</label>
                                                                    <input type="text" name="mailing_address"
                                                                        value="{{ $employer->mailing_address }}"
                                                                        class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>{!! trans('employer.MailingCity') !!}</label>
                                                                    <input type="text" name="mailing_city"
                                                                        value="{{ $employer->mailing_city }}"
                                                                        class="form-control">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>{!! trans('employer.MailingState') !!}</label>
                                                                    <select class="form-control" name="mailing_state">
                                                                        @foreach ($principal_states as $obj)
                                                                            @if ($obj->id == $employer->mailing_state)
                                                                                <option value="{{ $obj->id }}"
                                                                                    selected>
                                                                                    {{ $obj->name }}</option>
                                                                            @else
                                                                                <option value="{{ $obj->id }}">
                                                                                    {{ $obj->name }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>{!! trans('employer.MailingZipCode') !!}</label>
                                                                    <input type="text" name="mailing_zip_code"
                                                                        value="{{ $employer->mailing_zip_code }}"
                                                                        class="form-control">
                                                                </div>



                                                            </div>

                                                        </div>


                                                        <div class="with-header">
                                                            <h4 class="card-title">{!! trans('employer.PlaceOfEmployment') !!}</h4>
                                                        </div>
                                                    </div>





                                                    <div class="row">
                                                        <div class="col-xl-12 col-xxl-12">

                                                            <div class="form-group">
                                                                <br>
                                                                <div class="col-md-12">
                                                                    <label>{!! trans('employer.MainWorksiteState') !!}</label>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <input type="checkbox" id="SamePlaceBusiness"
                                                                        name="is_there_additional_worksite"> &nbsp;&nbsp;
                                                                    {!! trans('employer.SamePlaceBusiness') !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row" id="DivMainWorksite">
                                                        <div class="col-md-12">

                                                            <div class="box-body">

                                                                <div class="form-group">
                                                                    <label>{!! trans('employer.MainWorksiteStreetAddress') !!}</label>
                                                                    <input type="text" name="main_worksite_location"
                                                                        class="form-control">
                                                                </div>


                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>{!! trans('employer.PrimaryContact') !!}</label>
                                                                                <input type="text"
                                                                                    name="primary_contact_name"
                                                                                    value="{{ $employer->primary_contact_name }}"
                                                                                    class="form-control">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>{!! trans('employer.Last') !!}</label>
                                                                                <input type="text"
                                                                                    name="primary_contact_last_name"
                                                                                    value="{{ $employer->primary_contact_last_name }}"
                                                                                    class="form-control">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>{!! trans('employer.PrimaryContactJobTitle') !!}</label>
                                                                                <input type="text"
                                                                                    name="primary_contact_job_title"
                                                                                    value="{{ $employer->primary_contact_job_title }}"
                                                                                    class="form-control">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>{!! trans('employer.PrimaryContactEmail') !!}</label>
                                                                                <input type="text"
                                                                                    name="primary_contact_email"
                                                                                    value="{{ $employer->primary_contact_email }}"
                                                                                    class="form-control">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label>{!! trans('employer.PrimaryContactPhone') !!}</label>
                                                                                <input type="text"
                                                                                    name="primary_contact_phone"
                                                                                    value="{{ $employer->primary_contact_phone }}"
                                                                                    class="form-control">
                                                                            </div>


                                                                            <div class="form-group">
                                                                                <label>{!! trans('employer.PrimaryContactCellPhone') !!}</label>
                                                                                <input type="text"
                                                                                    name="primary_contact_cellphone"
                                                                                    value="{{ $employer->primary_contact_cellphone }}"
                                                                                    class="form-control">
                                                                            </div>

                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>{!! trans('employer.PrimaryContactListed') !!}</label>
                                                                                <select class="form-control"
                                                                                    name="signed_all_documents"
                                                                                    id="PrimaryContactListed">
                                                                                    @if ($employer->signed_all_documents == 1)
                                                                                        <option value="1" selected>
                                                                                            {!! trans('employer.Yes') !!}
                                                                                        </option>
                                                                                    @else
                                                                                        <option value="1">
                                                                                            {!! trans('employer.Yes') !!}
                                                                                        </option>
                                                                                    @endif

                                                                                    @if ($employer->signed_all_documents == 0)
                                                                                        <option value="0" selected>
                                                                                            {!! trans('employer.No') !!}
                                                                                        </option>
                                                                                    @else
                                                                                        <option value="0">
                                                                                            {!! trans('employer.No') !!}
                                                                                        </option>
                                                                                    @endif


                                                                                </select>
                                                                            </div>
                                                                            <div id="DivSignatory">

                                                                                <div class="form-group">
                                                                                    <label>{!! trans('employer.SignatoryName') !!}</label>
                                                                                    <input type="text"
                                                                                        name="signatory_name"
                                                                                        value="{{ $employer->signatory_name }}"
                                                                                        class="form-control">
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label>{!! trans('employer.SignatoryLastName') !!}</label>
                                                                                    <input type="text"
                                                                                        name="signatory_last_name"
                                                                                        value="{{ $employer->signatory_last_name }}"
                                                                                        class="form-control">
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label>{!! trans('employer.SignatoryJobTitle') !!}</label>
                                                                                    <input type="text"
                                                                                        name="signatory_job_title"
                                                                                        value="{{ $employer->signatory_job_title }}"
                                                                                        class="form-control">
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label>{!! trans('employer.SignatoryEmail') !!}</label>
                                                                                    <input type="mail"
                                                                                        name="signatory_email"
                                                                                        value="{{ $employer->signatory_email }}"
                                                                                        class="form-control">
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label>{!! trans('employer.SignatoryPhone') !!}</label>
                                                                                    <input type="text"
                                                                                        name="signatory_phone"
                                                                                        value="{{ $employer->signatory_phone }}"
                                                                                        class="form-control">
                                                                                </div>

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>





                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6"></div>
                                                            <div class="col-md-6">
                                                                <button type="submit"
                                                                    class="btn btn-primary float-right">Submit</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">&nbsp;</div>


                                                </form>
                                            </div>

                                    </div>
                                </div>



                            </div>
                            <div class="tab-pane fade show active" id="profile">


                                <div class="col-xl-12 col-xxl-12">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="card-header">
                                                    <h4 class="card-title">{!! trans('employer.AdditionalEmployerWorksite') !!}</h4>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="card-header">
                                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                                        data-target=".bd-example-modal-lg">{!! trans('employer.AddAdditionalWorksite') !!}</button>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-body">





                                            <div class="col-xl-12 col-xxl-12 col-lg-12 col-sm-12">
                                                <div class="card">

                                                    <div class="card-body">



                                                        <table id="example2" class="display" style="min-width: 845px">
                                                            <thead>
                                                                <tr>
                                                                    <th>Street Address</th>
                                                                    <th>City address</th>
                                                                    <th>Country address</th>
                                                                    <th>State</th>
                                                                    <th>Zip code address</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($worksites as $obj)
                                                                    <tr>
                                                                        <td>{{ $obj->street_address }}</td>
                                                                        <td>{{ $obj->city_address }}</td>
                                                                        <td>{{ $obj->country_address }}</td>
                                                                        @if ($obj->state_id_address)
                                                                            <td>{{ $obj->state->name }}</td>
                                                                        @else
                                                                            <td></td>
                                                                        @endif

                                                                        <td>{{ $obj->zip_code_address }}</td>
                                                                    </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>


                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>





                                </div>
                            </div>

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
                                <input type="text" name="street_address" required class="form-control">
                            </div>



                            <div class="form-group">
                                <label>{!! trans('employer.City') !!}</label>
                                <input type="text" name="city_address" required class="form-control">
                            </div>

                            <div class="form-group">
                                <label>{!! trans('employer.County') !!}</label>
                                <input type="text" name="country_address" required class="form-control">
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
                                <input type="text" name="zip_code_address" required class="form-control">
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



    <div class="modal fade" id="modal_employer_additional_location" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true" data-tipo="1">
        <div class="modal-dialog">
            <div class="modal-content">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>





    <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {



        });
    </script>
@endsection
