@extends ('dashboard')
@section('contenido')
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">EMPLOYER INFORMATION</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('employer') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-xl-6 col-xxl-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('employer.LegalName') !!}</label>
                                    <input type="text" name="legal_business_name" value="{{ $user->name }}" required
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>{!! trans('employer.TradeName') !!}</label>
                                    <input type="text" name="trade_name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.IdentificationNumber') !!}</label>
                                    <input type="text" name="federal_id_number" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.YearBusinessEstablished') !!}</label>
                                    <input type="number" name="year_business_established" min="1900"
                                        max="<?php echo date('Y'); ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.NumberEmployees') !!}</label>
                                    <input type="text" name="number_employees_full_time" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.PrimaryBusinessPhone') !!}</label>
                                    <input type="text" name="primary_business_phone" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.PrimaryBusinessFax') !!}</label>
                                    <input type="text" name="primary_business_fax" class="form-control">
                                </div>



                            </div>
                            <div class="col-xl-6 col-xxl-12">

                                <div class="form-group">
                                    <label>{!! trans('employer.CompanyWebsite') !!}</label>
                                    <input type="text" name="company_website" class="form-control">
                                </div>


                                <div class="form-group">
                                    <label>{!! trans('employer.ParticipatedH-2B') !!}</label>
                                    <select class="form-control" name="has_participate_h2b" id="ParticipatedH-2B">
                                        <option value="0">{!! trans('employer.No') !!} </option>
                                        <option value="1">{!! trans('employer.Yes') !!} </option>
                                    </select>
                                </div>


                                <div class="form-group" id="DivYearsCompanyParticipated">
                                    <label>{!! trans('employer.YearsCompanyParticipated') !!}</label>
                                    <input type="number" name="quantity_year_has_participate_h2b" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.PrimaryBusiness') !!}</label>
                                    <select class="form-control" name="primary_business_type_id" id="PrimaryBusinessType">
                                        <option value="">Select</option>
                                        @foreach ($primary_business_types as $obj)
                                            <option value="{{ $obj->id }}">{{ $obj->name_english }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group" id="DivNaicsCodCompany">
                                    <label>{!! trans('employer.NaicsCodCompany') !!}</label>
                                    <select class="form-control" name="naics_id" id="NaicsCod">

                                    </select>
                                </div>

                                <div class="form-group" id="DivNaicsNameCompany">
                                    <label>{!! trans('employer.NaicsCodCompany') !!}</label>
                                    <input type="text" name="naics_code" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.GrossCompanyIncome') !!}</label>
                                    <input type="number" name="year_end_gross_company_income" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.NetCompanyIncome') !!}</label>
                                    <input type="number" name="year_end_net_company_income" class="form-control">
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
                                    <input type="text" name="principal_street_address" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>{!! trans('employer.PrincipalCity') !!}</label>
                                    <input type="text" name="principal_city" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.PrincipalCountry') !!}</label>
                                    <input type="text" name="principal_country" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.PrincipalState') !!}</label>
                                    <select class="form-control" name="principal_state_id">
                                        @foreach ($states as $obj)
                                            <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.PrincipalZipCode') !!}</label>
                                    <input type="number" name="principal_zip_code" class="form-control">
                                </div>


                            </div>
                            <div class="col-xl-6 col-xxl-12">
                                <div>&nbsp;</div>
                                <div class="form-group">
                                    <input type="checkbox" name="mailing_address_same_above"
                                        id="SameAsAbove">&nbsp;{!! trans('employer.SameAsAbove') !!}
                                </div>
                                <br>
                                <div id="DivMailin">
                                    <div class="form-group">
                                        <label>{!! trans('employer.MailingAddress') !!}</label>
                                        <input type="text" name="mailing_address" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.MailingCity') !!}</label>
                                        <input type="text" name="mailing_city" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.MailingState') !!}</label>
                                        <select class="form-control" name="mailing_state">
                                            @foreach ($states as $obj)
                                                <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.MailingZipCode') !!}</label>
                                        <input type="text" name="mailing_zip_code" class="form-control">
                                    </div>


                                </div>

                            </div>


                            <div class="with-header">
                                <h4 class="card-title">{!! trans('employer.PlaceOfEmployment') !!}</h4>
                            </div>

                        </div>




                        <!-- MainWorksite -->
                        <div class="row">
                            <div class="col-xl-12 col-xxl-12">
                                <div class="form-group">
                                    <br>
                                    <div class="col-md-12">
                                        <label>{!! trans('employer.MainWorksiteState') !!}</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="checkbox" id="SamePlaceBusiness" name="is_there_additional_worksite"> &nbsp;&nbsp;
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
                                        <input type="text" name="main_worksite_location" class="form-control">
                                    </div>


                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label>{!! trans('employer.MainWorksiteCity') !!}</label>
                                                    <input type="text" name="main_worksite_city" class="form-control">
                                                </div>


                                                <div class="form-group">
                                                    <label>{!! trans('employer.MainWorksiteCounty') !!}</label>
                                                    <input type="text" name="main_worksite_country"
                                                        class="form-control">
                                                </div>


                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{!! trans('employer.MainWorksiteState') !!}</label>
                                                    <select class="form-control select2" name="main_worksite_state">
                                                        @foreach ($states as $obj)
                                                            <option value="{{ $obj->id }}">{{ $obj->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.MainWorksiteZipCode') !!}</label>
                                                    <input type="text" name="main_worksite_zip_code"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>


                        </div>


                        <!--<div class="col-md-12">
                                    <h5><strong>{!! trans('employer.AdditionalEmployerWorksite') !!}</strong></h5>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select class="form-control" name="Additional_employer_worksite"
                                                    id="Additional_employer_worksite">
                                                    <option value="0">{!! trans('employer.No') !!} </option>
                                                    <option value="1">{!! trans('employer.Yes') !!} </option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-outline-success"
                                                    id="BtnAddAdditionalWorksite"
                                                    onclick="modal();">{!! trans('employer.AddAdditionalWorksite') !!}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->


                        <div class="col-md-12">&nbsp;</div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{!! trans('employer.NormalBusinessDays') !!}</label>
                                        <select name="normal_business_days_id" id="NormalBusinessDays"
                                            class="form-control">
                                            @foreach ($normal_business_days as $obj)
                                                <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>



                                    <div class="form-group">
                                        <label>{!! trans('employer.TransportationProvided') !!}</label>
                                        <select class="form-control" name="is_transportation_provided">

                                            <option value="1" selected>{!! trans('employer.Yes') !!} </option>

                                            <option value="0">{!! trans('employer.No') !!} </option>


                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{!! trans('employer.Other') !!}</label>
                                        <input type="text" id="Other" name="normal_business_days_other"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.PublicTransportation') !!}</label>
                                        <input type="text" name="how_far_transportation_from_worksite"
                                            class="form-control">
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6">

                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{!! trans('employer.LocalPublicTransportation') !!}</label>
                                        <input type="text" name="local_transportation_website" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{!! trans('employer.Notes') !!}</label>
                                        <input type="text" name="place_employment_notes" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-xl-6 col-xxl-12">
                            </div>
                            <div class="col-xl-6 col-xxl-12">
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>



        </div>

    </div>


    <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        //validar usuario



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

        $("#SamePlaceBusiness").change(function() {
            if (document.getElementById('SamePlaceBusiness').checked) {
                //DivMainWorksite alert('checked')
                $('#DivMainWorksite').hide();

            } else {
                $('#DivMainWorksite').show();
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


        $(document).ready(function() {
            $('#DivYearsCompanyParticipated').hide();
            $('#DivSignatory').hide();

            $('#DivNaicsCodCompany').show();
            $('#DivNaicsNameCompany').hide();
        });
    </script>
@endsection
