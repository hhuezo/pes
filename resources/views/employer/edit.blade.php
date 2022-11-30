@extends ('dashboard')
@section('contenido')
    <?php if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 2;
    }
    ?>
    <div class="row">
        <div class="col-md-12 ">

            <div class="box box-primary">

                <br>
                <button class="btn btn-info float-right" onclick="modal_activate();">Activate</button>
                <button class="btn btn-danger float-right" onclick="modal_cancel();">cancel</button>

                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li><a href="#tab_1" data-toggle="tab">{!! trans('employer.Title') !!}</a></li>
                        <li class="active"><a href="#tab_2" data-toggle="tab">{!! trans('employer.PlaceOfEmployment') !!}</a></li>

                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane " id="tab_1">


                            <form method="POST" action="{{ route('employer.update', $employer->id) }}">
                                @method('PUT')
                                @csrf
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div role="form">
                                            <div class="box-body">

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('employer.LegalName') !!}</label>
                                                    <input type="text" name="legal_business_name"
                                                        value="{{ $employer->legal_business_name }}" required
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>{!! trans('employer.TradeName') !!}</label>
                                                    <input type="text" name="trade_name"
                                                        value="{{ $employer->trade_name }}" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.IdentificationNumber') !!}</label>
                                                    <input type="text" name="federal_id_number"
                                                        value="{{ $employer->federal_id_number }}" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.YearBusinessEstablished') !!}</label>
                                                    <input type="number" name="year_business_established"
                                                        value="{{ $employer->year_business_established }}" min="1900"
                                                        max="<?php echo date('Y'); ?>" class="form-control">
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
                                                        value="{{ $employer->primary_business_fax }}" class="form-control">
                                                </div>




                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <div role="form">
                                            <div class="box-body">

                                                <div class="form-group">
                                                    <label>{!! trans('employer.CompanyWebsite') !!}</label>
                                                    <input type="text" name="company_website"
                                                        value="{{ $employer->company_website }}" class="form-control">
                                                </div>


                                                <div class="form-group">
                                                    <label>{!! trans('employer.ParticipatedH-2B') !!}</label>
                                                    <select class="form-control" name="has_participate_h2b"
                                                        id="ParticipatedH-2B">
                                                        @if ($employer->has_participate_h2b == 0)
                                                            <option value="0" selected>{!! trans('employer.No') !!}
                                                            </option>
                                                        @else
                                                            <option value="0">{!! trans('employer.No') !!} </option>
                                                        @endif

                                                        @if ($employer->has_participate_h2b == 1)
                                                            <option value="1" selected>{!! trans('employer.Yes') !!}
                                                            </option>
                                                        @else
                                                            <option value="1">{!! trans('employer.Yes') !!} </option>
                                                        @endif




                                                    </select>
                                                </div>


                                                <div class="form-group" id="DivYearsCompanyParticipated">
                                                    <label>{!! trans('employer.YearsCompanyParticipated') !!}</label>
                                                    <input type="number" name="quantity_year_has_participate_h2b"
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
                                                    <select class="form-control" name="naics_id" id="NaicsCod">
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
                                                        value="{{ $employer->naics_code }}" class="form-control">
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

                                        </div>

                                    </div>
                                    <div class="col-md-3">&nbsp;</div>
                                </div>
                                <div class="with-border">
                                    <h4><strong>{!! trans('employer.PrincipalPlaceBusiness') !!}</strong></h4>
                                </div>

                                <div class="col-md-12">
                                    <br>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>{!! trans('employer.PrincipalStreetAddress') !!}</label>
                                            <input type="text" name="principal_street_address"
                                                value="{{ $employer->principal_street_address }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>{!! trans('employer.PrincipalCity') !!}</label>
                                            <input type="text" name="principal_city"
                                                value="{{ $employer->principal_city }}" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>{!! trans('employer.PrincipalCountry') !!}</label>
                                            <input type="text" name="principal_country"
                                                value="{{ $employer->principal_country }}" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>{!! trans('employer.PrincipalState') !!}</label>
                                            <select class="form-control" name="principal_state_id">
                                                @foreach ($principal_states as $obj)
                                                    @if ($obj->id == $employer->principal_state_id)
                                                        <option value="{{ $obj->id }}" selected>{{ $obj->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>{!! trans('employer.PrincipalZipCode') !!}</label>
                                            <input type="number" name="principal_zip_code"
                                                value="{{ $employer->principal_zip_code }}" class="form-control">
                                        </div>


                                    </div>
                                    <div class="col-md-6">



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
                                                    value="{{ $employer->mailing_address }}" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.MailingCity') !!}</label>
                                                <input type="text" name="mailing_city"
                                                    value="{{ $employer->mailing_city }}" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.MailingState') !!}</label>
                                                <select class="form-control" name="mailing_state">
                                                    @foreach ($principal_states as $obj)
                                                        @if ($obj->id == $employer->mailing_state)
                                                            <option value="{{ $obj->id }}" selected>
                                                                {{ $obj->name }}</option>
                                                        @else
                                                            <option value="{{ $obj->id }}">{{ $obj->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.MailingZipCode') !!}</label>
                                                <input type="text" name="mailing_zip_code"
                                                    value="{{ $employer->mailing_zip_code }}" class="form-control">
                                            </div>



                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <div class="with-border">
                                            <h4><strong>{!! trans('employer.EmployerContactInformation') !!}</strong></h4>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <br>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryContact') !!}</label>
                                                <input type="text" name="primary_contact_name"
                                                    value="{{ $employer->primary_contact_name }}" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.Last') !!}</label>
                                                <input type="text" name="primary_contact_last_name"
                                                    value="{{ $employer->primary_contact_last_name }}"
                                                    class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryContactJobTitle') !!}</label>
                                                <input type="text" name="primary_contact_job_title"
                                                    value="{{ $employer->primary_contact_job_title }}"
                                                    class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryContactEmail') !!}</label>
                                                <input type="text" name="primary_contact_email"
                                                    value="{{ $employer->primary_contact_email }}" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryContactPhone') !!}</label>
                                                <input type="text" name="primary_contact_phone"
                                                    value="{{ $employer->primary_contact_phone }}" class="form-control">
                                            </div>


                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryContactCellPhone') !!}</label>
                                                <input type="text" name="primary_contact_cellphone"
                                                    value="{{ $employer->primary_contact_cellphone }}"
                                                    class="form-control">
                                            </div>


                                        </div>
                                        <div class="col-md-6">



                                            <div class="form-group">
                                                <label>{!! trans('employer.PrimaryContactListed') !!}</label>
                                                <select class="form-control" name="signed_all_documents"
                                                    id="PrimaryContactListed">
                                                    @if ($employer->signed_all_documents == 1)
                                                        <option value="1" selected>{!! trans('employer.Yes') !!} </option>
                                                    @else
                                                        <option value="1">{!! trans('employer.Yes') !!} </option>
                                                    @endif

                                                    @if ($employer->signed_all_documents == 0)
                                                        <option value="0" selected>{!! trans('employer.No') !!} </option>
                                                    @else
                                                        <option value="0">{!! trans('employer.No') !!} </option>
                                                    @endif


                                                </select>
                                            </div>
                                            <div id="DivSignatory">

                                                <div class="form-group">
                                                    <label>{!! trans('employer.SignatoryName') !!}</label>
                                                    <input type="text" name="signatory_name"
                                                        value="{{ $employer->signatory_name }}" class="form-control"
                                                        >
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.SignatoryLastName') !!}</label>
                                                    <input type="text" name="signatory_last_name"
                                                        value="{{ $employer->signatory_last_name }}" class="form-control"
                                                        >
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.SignatoryJobTitle') !!}</label>
                                                    <input type="text" name="signatory_job_title"
                                                        value="{{ $employer->signatory_job_title }}"
                                                        class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.SignatoryEmail') !!}</label>
                                                    <input type="mail" name="signatory_email"
                                                        value="{{ $employer->signatory_email }}" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.SignatoryPhone') !!}</label>
                                                    <input type="text" name="signatory_phone"
                                                        value="{{ $employer->signatory_phone }}" class="form-control">
                                                </div>

                                            </div>


                                        </div>
                                        <div class="col-md-3">&nbsp;</div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary float-right">Submit</button>

                                        </div>
                                    </div>
                                    <div class="col-md-12">&nbsp;</div>
                                </div>
                            </form>

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane active" id="tab_2">








                            <form action="{{ url('employer_place_store') }}" method="POST">
                                <div class="box-header  with-border">
                                    <h4><strong>{!! trans('employer.PlaceOfEmployment') !!}</strong></h4>
                                </div>

                                <input type="hidden" value="{{ $employer->id }}" name="id">

                                @csrf

                                <div class="form-group">
                                    <br>
                                    <div class="col-md-12">
                                        <label>{!! trans('employer.MainWorksiteState') !!}</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="checkbox" id="SamePlaceBusiness"> &nbsp;&nbsp;
                                        {!! trans('employer.SamePlaceBusiness') !!}
                                    </div>
                                </div>
                                <div> &nbsp;</div>
                                <div id="DivMainWorksite">
                                    <div class="col-md-12">

                                        <div class="box-body">


                                            <div class="form-group">
                                                <label>{!! trans('employer.MainWorksiteStreetAddress') !!}</label>
                                                <input type="text" name="main_worksite_location"
                                                    value="{{ $employer->main_worksite_location }}" class="form-control">
                                            </div>

                                        </div>

                                    </div>


                                    <div class="col-md-12">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>{!! trans('employer.MainWorksiteCity') !!}</label>
                                                <input type="text" name="main_worksite_city"
                                                    value="{{ $employer->main_worksite_city }}" class="form-control">
                                            </div>


                                            <div class="form-group">
                                                <label>{!! trans('employer.MainWorksiteCounty') !!}</label>
                                                <input type="text" name="main_worksite_country"
                                                    value="{{ $employer->main_worksite_country }}" class="form-control">
                                            </div>


                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{!! trans('employer.MainWorksiteState') !!}</label>
                                                <select class="form-control" name="main_worksite_state">
                                                    @foreach ($states as $obj)
                                                        @if ($obj->id == $employer->main_worksite_state)
                                                            <option value="{{ $obj->id }}" selected>
                                                                {{ $obj->name }}</option>
                                                        @else
                                                            <option value="{{ $obj->id }}">{{ $obj->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>{!! trans('employer.MainWorksiteZipCode') !!}</label>
                                                <input type="text" name="main_worksite_zip_code"
                                                    value="{{ $employer->main_worksite_zip_code }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                </div>







                                <div class="col-md-12">
                                    <h5><strong>{!! trans('employer.AdditionalEmployerWorksite') !!}</strong></h5>
                                    <div class="col-md-6">
                                        <div class="col-md-9">
                                            <select class="form-control" name="Additional_employer_worksite"
                                                id="Additional_employer_worksite">
                                                <option value="0">{!! trans('employer.No') !!} </option>
                                                <option value="1">{!! trans('employer.Yes') !!} </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-success" id="BtnAddAdditionalWorksite"
                                                onclick="modal();">{!! trans('employer.AddAdditionalWorksite') !!}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">&nbsp;</div>
                                <div class="col-md-1"></div>
                                <div class="col-md-10" id="response">
                                    <table id="datatable" class="table table-striped table-bordered">
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

                                <div class="col-md-12">&nbsp;</div>
                                <div class="col-md-12">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{!! trans('employer.NormalBusinessDays') !!}</label>
                                            <select name="normal_business_days_id" id="NormalBusinessDays"
                                                class="form-control">
                                                @foreach ($normal_business_days as $obj)
                                                    @if ($obj->id == $employer->normal_business_days_id)
                                                        <option value="{{ $obj->id }}" selected>{{ $obj->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                                    @endif
                                                @endforeach

                                            </select>
                                        </div>



                                        <div class="form-group">
                                            <label>{!! trans('employer.TransportationProvided') !!}</label>
                                            <select class="form-control" name="is_transportation_provided">
                                                @if ($employer->is_transportation_provided == 1)
                                                    <option value="1" selected>{!! trans('employer.Yes') !!} </option>
                                                @else
                                                    <option value="1">{!! trans('employer.Yes') !!} </option>
                                                @endif

                                                @if ($employer->is_transportation_provided == 0)
                                                    <option value="0" selected>{!! trans('employer.No') !!} </option>
                                                @else
                                                    <option value="0">{!! trans('employer.No') !!} </option>
                                                @endif

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{!! trans('employer.Other') !!}</label>
                                            <input type="text" id="Other" name="normal_business_days_other"
                                                value="{{ $employer->normal_business_days_other }}" class="form-control">
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{!! trans('employer.PublicTransportation') !!}</label>
                                            <input type="text" name="how_far_transportation_from_worksite"
                                                value="{{ $employer->how_far_transportation_from_worksite }}"
                                                class="form-control">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{!! trans('employer.LocalPublicTransportation') !!}</label>
                                            <input type="text" name="local_transportation_website"
                                                value="{{ $employer->local_transportation_website }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{!! trans('employer.Notes') !!}</label>
                                            <input type="text" name="place_employment_notes"
                                                value="{{ $employer->place_employment_notes }}" class="form-control">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">submit</button>
                                </div>

                                <div class="col-md-12">&nbsp;</div>
                            </form>


















                        </div>

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->








            </div>
            <!-- /.col -->

        </div>

    </div>




    <div class="modal fade" id="modal_employer_additional_location" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true" data-tipo="1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ url('employer_additional_location') }}">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>

                        <div class="col-md-12">{!! trans('employer.AdditionalEmployerWorksiteAddress') !!}</div>
                        <div class="col-md-12">&nbsp;</div>
                        <div class="col-md-12">
                            <h4><strong>{!! trans('employer.AdditionalEmployerworksiteLocation') !!}</strong></h4>
                        </div>
                        <div class="col-md-12">{!! trans('employer.DoIncludeCustomer') !!}</div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="employer_id" value="{{ $employer->id }}">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label>{!! trans('employer.StreetAddress') !!}</label>
                            <input type="text" id="street_address" required class="form-control">
                        </div>



                        <div class="form-group">
                            <label>{!! trans('employer.City') !!}</label>
                            <input type="text" id="city_address" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label>{!! trans('employer.County') !!}</label>
                            <input type="text" id="country_address" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label>{!! trans('employer.State') !!}</label>
                            <select class="form-control" id="state_id_address">
                                @foreach ($states as $obj)
                                    <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label>{!! trans('employer.ZipCode') !!}</label>
                            <input type="text" id="zip_code_address" required class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" onclick="add_employer_additional_location()" class="btn btn-primary">Save
                            changes</button>
                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>




    <div class="modal fade" id="modal_activate" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true" data-tipo="1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ url('employer/activate') }}">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>

                        <div class="col-md-12"> <h2>Activate</h2></div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="{{ $employer->id }}">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <input type="hidden" name="cod" value="1">
                        <h4>Do you want to activate the employer?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <div class="modal fade" id="modal_cancel" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true" data-tipo="1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ url('employer/activate') }}">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>

                        <div class="col-md-12"> <h2>Cancel</h2></div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="{{ $employer->id }}">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <input type="hidden" name="cod" value="0">
                        <h4>Do you want to cancel the employer?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-danger">Save</button>
                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {



            var action = '<?php echo $action; ?>';
            switch (action) {
                case '1':
                    $('.nav-tabs a[href="#tab_1"]').tab('show');
                    break;
            }




            $("#PrimaryBusinessType").change();

            $('#DivYearsCompanyParticipated').hide();
            $('#DivSignatory').hide();
            $('#DivNaicsCodCompany').show();
            $('#DivNaicsNameCompany').hide();





            $('#BtnAddAdditionalWorksite').hide();
            $('#Other').prop("disabled", true);
        });






        $("#ParticipatedH-2B").change(function() {
            if (document.getElementById('ParticipatedH-2B').value == 1) {
                $('#DivYearsCompanyParticipated').show();
            } else {
                $('#DivYearsCompanyParticipated').hide();
            }

        });

        $("#PrimaryContactListed").change(function() {
            if (document.getElementById('PrimaryContactListed').value == 1) {
                $('#DivSignatory').hide();

            } else {
                $('#DivSignatory').show();
            }

        });

        $("#SameAsAbove").change(function() {
            if (document.getElementById('SameAsAbove').checked == true) {
                $('#DivMailin').hide();

            } else {
                $('#DivMailin').show();
            }

        });

        $("#PrimaryBusinessType").change(function() {
            var PrimaryBusinessType = $(this).val();

            if (PrimaryBusinessType != 6) {
                $('#DivNaicsCodCompany').show();
                $('#DivNaicsNameCompany').hide();

                $.get("{{ url('get_naics_code') }}" + '/' + PrimaryBusinessType, function(data) {
                    //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
                    console.log(data);
                    var _select = ''
                    for (var i = 0; i < data.length; i++)
                        _select += '<option value="' + data[i].id + '"  >' + data[i].code + ' ' + data[i]
                        .name +
                        '</option>';
                    $("#NaicsCod").html(_select);
                });
            } else {
                $('#DivNaicsCodCompany').hide();
                $('#DivNaicsNameCompany').show();
            }



        });









        $("#SamePlaceBusiness").change(function() {
            if (document.getElementById('SamePlaceBusiness').checked) {
                //DivMainWorksite alert('checked')
                $('#DivMainWorksite').hide();

            } else {
                $('#DivMainWorksite').show();
            }
        });

        $("#NormalBusinessDays").change(function() {

            if (document.getElementById('NormalBusinessDays').value == 4) {
                $('#Other').prop("disabled", false);
            } else {
                $('#Other').prop("disabled", true);
            }
        });






        function add_employer_additional_location() {
            $('#response').html('<div><img src="../../public/img/ajax-loader.gif"/></div>');

            var parametros = {
                "employer_id": document.getElementById('employer_id').value,
                "street_address": document.getElementById('street_address').value,
                "city_address": document.getElementById('city_address').value,
                "country_address": document.getElementById('country_address').value,
                "state_id_address": document.getElementById('state_id_address').value,
                "zip_code_address": document.getElementById('zip_code_address').value,
                "_token": document.getElementById('token').value
            };
            $.ajax({
                type: "post",
                url: "{{ url('employer_additional_location') }}",
                data: parametros,
                success: function(data) {
                    console.log(data);
                    $('#response').html(data);

                    $('#modal_employer_additional_location').modal('hide');
                }
            });

        }


        $("#Additional_employer_worksite").change(function() {

            if (document.getElementById('Additional_employer_worksite').value == 1) {
                $('#BtnAddAdditionalWorksite').show();
                $('#modal_employer_additional_location').modal('show');
            } else {
                $('#BtnAddAdditionalWorksite').hide();
            }
        });

        function modal() {
            $('#modal_employer_additional_location').modal('show');
        }

        function modal_activate(){
            $('#modal_activate').modal('show');
        }

        function modal_cancel(){
            $('#modal_cancel').modal('show');
        }

    </script>
@endsection
