@extends ('dashboard')
@section('contenido')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4><strong>{!! trans('employer.Title') !!}</strong></h4>
                </div>
                <form action="{{ url('employer') }}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div role="form">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('employer.LegalName') !!}</label>
                                        <input type="text" name="legal_business_name" required class="form-control">
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
                                        <input type="number" name="year_business_established" min="1900" max="<?php echo date('Y'); ?>"   class="form-control">
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
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div role="form">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label>{!! trans('employer.CompanyWebsite') !!}</label>
                                        <input type="text"  name="company_website" class="form-control">
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
                                                <option value="{{ $obj->id }}">{{ $obj->name_english }}</option>
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
                                    @foreach ($principal_states as $obj)
                                        <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>{!! trans('employer.PrincipalZipCode') !!}</label>
                                <input type="number" name="principal_zip_code" class="form-control">
                            </div>


                        </div>
                        <div class="col-md-6">



                            <br>
                            <div class="form-group">
                                <input type="checkbox" name="mailing_address_same_above" id="SameAsAbove">&nbsp;{!! trans('employer.SameAsAbove') !!}
                            </div>
                            <br>
                            <div id="DivMailin">
                                <div class="form-group">
                                    <label>{!! trans('employer.MailingAddress') !!}</label>
                                    <input type="text"  name="mailing_address" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.MailingCity') !!}</label>
                                    <input type="text" name="mailing_city" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.MailingState') !!}</label>
                                    <select class="form-control" name="mailing_state">
                                        @foreach ($principal_states as $obj)
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
                                    <input type="text" name="primary_contact_name" placeholder="{!! trans('employer.Name') !!}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.Last') !!}</label>
                                    <input type="text" name="primary_contact_last_name" placeholder="{!! trans('employer.Last') !!}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.PrimaryContactJobTitle') !!}</label>
                                    <input type="text" name="primary_contact_job_title" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.PrimaryContactEmail') !!}</label>
                                    <input type="text" name="primary_contact_email" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.PrimaryContactPhone') !!}</label>
                                    <input type="text" name="primary_contact_phone" class="form-control">
                                </div>


                                <div class="form-group">
                                    <label>{!! trans('employer.PrimaryContactCellPhone') !!}</label>
                                    <input type="text" name="primary_contact_cellphone" class="form-control">
                                </div>


                            </div>
                            <div class="col-md-6">



                                <div class="form-group">
                                    <label>{!! trans('employer.PrimaryContactListed') !!}</label>
                                    <select class="form-control" name="signed_all_documents" id="PrimaryContactListed">
                                        <option value="1">{!! trans('employer.Yes') !!} </option>
                                        <option value="0">{!! trans('employer.No') !!} </option>

                                    </select>
                                </div>
                                <div id="DivSignatory">

                                    <div class="form-group">
                                        <label>{!! trans('employer.SignatoryName') !!}</label>
                                        <input type="text" name="signatory_name" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.SignatoryLastName') !!}</label>
                                        <input type="text" name="signatory_last_name" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.SignatoryJobTitle') !!}</label>
                                        <input type="text" name="signatory_job_title" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.SignatoryEmail') !!}</label>
                                        <input type="mail" name="signatory_email" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.SignatoryPhone') !!}</label>
                                        <input type="text"  name="signatory_phone"  class="form-control">
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

                    </div>
                </form>
            </div>
            @include('sweet::alert')
            <div class="col-md-12">&nbsp;</div>
        </div>
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script type="text/javascript">
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
            //


            $(document).ready(function() {
                $('#DivYearsCompanyParticipated').hide();
                $('#DivSignatory').hide();

                $('#DivNaicsCodCompany').show();
                $('#DivNaicsNameCompany').hide();
            });
        </script>
    @endsection
