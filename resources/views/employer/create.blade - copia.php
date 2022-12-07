@extends ('dashboard')
@section('contenido')
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
                                        <input type="text" name="legal_business_name" value="{{old('legal_business_name')}}" class="form-control">
                                        @error('legal_business_name')
                                            <div class="alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>{!! trans('employer.TradeName') !!}</label>
                                        <input type="text" name="trade_name" value="{{old('trade_name')}}" class="form-control">
                                        @error('trade_name')
                                            <div class="alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.IdentificationNumber') !!}</label>
                                        <input type="text" name="federal_id_number" value="{{old('federal_id_number')}}" class="form-control"  
                                        data-inputmask="'mask': ['99-9999999']" data-mask class="form-control" maxlength="10">
                                        @error('federal_id_number')
                                            <div class="alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.YearBusinessEstablished') !!}</label>
                                        <input type="text" name="year_business_established" value="{{old('year_business_established')}}" min="1900" max="<?php echo date('Y'); ?>"   
                                        class="form-control" data-inputmask="'mask': ['9999']" data-mask class="form-control" maxlength="4">
                                        @error('year_business_established')
                                            <div class="alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.NumberEmployees') !!}</label>
                                        <input type="text" name="number_employees_full_time" value="{{old('number_employees_full_time')}}" class="form-control">
                                        @error('number_employees_full_time')
                                            <div class="alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.PrimaryBusinessPhone') !!}</label>
                                        <input type="text" name="primary_business_phone" value="{{old('primary_business_phone')}}" class="form-control"
                                        data-inputmask="'mask': ['(999)999-9999']" data-mask class="form-control" maxlength="13">
                                        @error('primary_business_phone')
                                            <div class="alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.PrimaryBusinessFax') !!}</label>
                                        <input type="text" name="primary_business_fax" value="{{old('primary_business_fax')}}" 
                                        data-inputmask="'mask': ['(999)999-9999']" data-mask class="form-control" maxlength="13"
                                        class="form-control">
                                        @error('primary_business_fax')
                                            <div class="alert-danger">{{ $message }}</div>
                                        @enderror
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
                                        <input type="text"  name="company_website" value="{{old('legal_business_name')}}" class="form-control">
                                        @error('company_website')
                                            <div class="alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label>{!! trans('employer.ParticipatedH-2B') !!}</label>
                                        <select class="form-control" name="has_participate_h2b" value="{{old('has_participate_h2b')}}" id="ParticipatedH-2B">
                                            <option value="0">{!! trans('employer.No') !!} </option>
                                            <option value="1">{!! trans('employer.Yes') !!} </option>
                                        </select>
                                    </div>


                                    <div class="form-group" id="DivYearsCompanyParticipated">
                                        <label>{!! trans('employer.YearsCompanyParticipated') !!}</label>
                                        <input type="number" name="quantity_year_has_participate_h2b" value="{{old('quantity_year_has_participate_h2b')}}" 
                                        maxlength="4" class="form-control">
                                        @error('quantity_year_has_participate_h2b')
                                            <div class="alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.PrimaryBusiness') !!}</label>
                                        <select class="form-control" name="primary_business_type_id" value="{{old('primary_business_type_id')}}" id="PrimaryBusinessType">
                                            <option value="">Select</option>
                                            @foreach ($primary_business_types as $obj)
                                                <option value="{{ $obj->id }}">{{ $obj->name_english }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group" id="DivNaicsCodCompany">
                                        <label>{!! trans('employer.NaicsCodCompany') !!}</label>
                                        <select class="form-control" name="naics_id" value="{{old('naics_id')}}" id="NaicsCod">

                                        </select>
                                    </div>

                                    <div class="form-group" id="DivNaicsNameCompany">
                                        <label>{!! trans('employer.NaicsCodCompany') !!}</label>
                                        <input type="text" name="naics_code" value="{{old('naics_code')}}" class="form-control">
                                        @error('naics_code')
                                            <div class="alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.GrossCompanyIncome') !!}</label>
                                        <input type="text" name="year_end_gross_company_income" value="{{old('year_end_gross_company_income')}}" 
                                        data-inputmask="'mask': ['9999']" data-mask class="form-control" maxlength="4" class="form-control">
                                        @error('year_end_gross_company_income')
                                            <div class="alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.NetCompanyIncome') !!}</label>
                                        <input type="text" name="year_end_net_company_income" value="{{old('year_end_net_company_income')}}" 
                                        data-inputmask="'mask': ['9999']" data-mask class="form-control" maxlength="4" class="form-control">
                                        @error('year_end_net_company_income')
                                            <div class="alert-danger">{{ $message }}</div>
                                        @enderror
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
                                <input type="text" name="principal_street_address" value="{{old('principal_street_address')}}" class="form-control">
                                @error('principal_street_address')
                                    <div class="alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{!! trans('employer.PrincipalCity') !!}</label>
                                <input type="text" name="principal_city" value="{{old('principal_city')}}" class="form-control">
                                @error('principal_city')
                                    <div class="alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{!! trans('employer.PrincipalCountry') !!}</label>
                                <input type="text" name="principal_country" value="{{old('principal_country')}}" class="form-control">
                                @error('principal_country')
                                    <div class="alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{!! trans('employer.PrincipalState') !!}</label>
                                <select class="form-control" name="principal_state_id"  value="{{old('principal_state_id')}}">
                                    @foreach ($principal_states as $obj)
                                        <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>{!! trans('employer.PrincipalZipCode') !!}</label>
                                <input type="text" name="principal_zip_code" value="{{old('principal_zip_code')}}" 
                                data-inputmask="'mask': ['99999']" data-mask class="form-control" maxlength="5">
                                @error('principal_zip_code')
                                    <div class="alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>
                        <div class="col-md-6">



                            <br>
                            <div class="form-group">
                                <input type="checkbox" {{ old('mailing_address_same_above') == 'on' ? 'checked' : '' }}  name="mailing_address_same_above" id="SameAsAbove">&nbsp;{!! trans('employer.SameAsAbove') !!}
                            </div>
                            <br>
                            <div id="DivMailin">
                                <div class="form-group">
                                    <label>{!! trans('employer.MailingAddress') !!}</label>
                                    <input type="text"  name="mailing_address" value="{{old('mailing_address')}}" class="form-control">
                                    @error('mailing_address')
                                    <div class="alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.MailingCity') !!}</label>
                                    <input type="text" name="mailing_city" value="{{old('mailing_city')}}" class="form-control">
                                    @error('mailing_city')
                                    <div class="alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.MailingState') !!}</label>
                                    <select class="form-control" name="mailing_state" value="{{old('mailing_state')}}">
                                        @foreach ($principal_states as $obj)
                                            <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.MailingZipCode') !!}</label>
                                    <input type="text" name="mailing_zip_code" value="{{old('mailing_zip_code')}}"
                                    data-inputmask="'mask': ['99999']" data-mask class="form-control" maxlength="5">
                                    @error('mailing_zip_code')
                                    <div class="alert-danger">{{ $message }}</div>
                                    @enderror
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
                                    <input type="text" name="primary_contact_name" value="{{old('primary_contact_name')}}" placeholder="{!! trans('employer.Name') !!}" class="form-control">
                                    @error('primary_contact_name')
                                    <div class="alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.Last') !!}</label>
                                    <input type="text" name="primary_contact_last_name" value="{{old('primary_contact_last_name')}}" placeholder="{!! trans('employer.Last') !!}" class="form-control">
                                    @error('primary_contact_last_name')
                                    <div class="alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.PrimaryContactJobTitle') !!}</label>
                                    <input type="text" name="primary_contact_job_title" value="{{old('primary_contact_job_title')}}" class="form-control">
                                    @error('primary_contact_job_title')
                                    <div class="alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.PrimaryContactEmail') !!}</label>
                                    <input type="text" name="primary_contact_email" value="{{old('primary_contact_email')}}" class="form-control">
                                    @error('primary_contact_email')
                                    <div class="alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.PrimaryContactPhone') !!}</label>
                                    <input type="text" name="primary_contact_phone" value="{{old('primary_contact_phone')}}" 
                                    data-inputmask="'mask': ['(999)999-9999']" data-mask class="form-control" maxlength="13">
                                    @error('primary_contact_phone')
                                    <div class="alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label>{!! trans('employer.PrimaryContactCellPhone') !!}</label>
                                    <input type="text" name="primary_contact_cellphone" value="{{old('primary_contact_cellphone')}}" 
                                    data-inputmask="'mask': ['(999)999-9999']" data-mask class="form-control" maxlength="13">
                                    @error('primary_contact_cellphone')
                                    <div class="alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>
                            <div class="col-md-6">





                                <br>
                            <div class="form-group">
                                <input type="checkbox" {{ old('signed_all_documents') == 'on' ? 'checked' : '' }}  name="signed_all_documents" id="SignedAllDocuments">&nbsp;{!! trans('employer.SignedAllDocuments') !!}
                            </div>
                            
                            <br>
                                <div id="DivSignatory">

                                    <div class="form-group">
                                        <label>{!! trans('employer.SignatoryName') !!}</label>
                                        <input type="text" name="signatory_name" value="{{old('signatory_name')}}" class="form-control" >
                                        @error('signatory_name')
                                        <div class="alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.SignatoryLastName') !!}</label>
                                        <input type="text" name="signatory_last_name" value="{{old('signatory_last_name')}}" class="form-control" >
                                        @error('signatory_last_name')
                                        <div class="alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.SignatoryJobTitle') !!}</label>
                                        <input type="text" name="signatory_job_title" value="{{old('signatory_job_title')}}" class="form-control">
                                        @error('signatory_job_title')
                                        <div class="alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.SignatoryEmail') !!}</label>
                                        <input type="mail" name="signatory_email" value="{{old('signatory_email')}}" class="form-control">
                                        @error('signatory_email')
                                        <div class="alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.SignatoryPhone') !!}</label>
                                        <input type="text"  name="signatory_phone" value="{{old('signatory_phone')}}"  
                                        data-inputmask="'mask': ['(999)999-9999']" data-mask class="form-control" maxlength="13">
                                        @error('signatory_phone')
                                        <div class="alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>


                            </div>
                            <div class="col-md-3">&nbsp;</div>
                        </div>
                        

                        <div class="col-md-12">
                            <br>
                            <div class="col-md-6">

                            <br>
                                <div class="form-group">

                                    <input type="checkbox" {{ old('add_contact_person') == 'on' ? 'checked' : '' }}  name="add_contact_person" id="AddContactPerson">&nbsp;{!! trans('employer.AddContactPerson') !!}
                                </div>
                            
                                <div id="DivContactPerson1">

                                    <div class="form-group">
                                        <label>{!! trans('employer.AdditionalContactName') !!}</label>
                                        <input type="text" name="additional_contact_name" value="{{old('additional_contact_name')}}" class="form-control" >
                                        @error('additional_contact_name')
                                        <div class="alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.AdditionalContactJobTitle') !!}</label>
                                        <input type="text" name="additional_contact_job_title" value="{{old('additional_contact_job_title')}}" class="form-control" >
                                        @error('additional_contact_job_title')
                                        <div class="alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>{!! trans('employer.AdditionalContactPhone') !!}</label>
                                        <input type="text" name="additional_contact_phone" value="{{old('additional_contact_phone')}}" class="form-control" >
                                        @error('additional_contact_phone')
                                        <div class="alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                            </div>
                            <div class="col-md-6">

                            <div id="DivContactPerson2">
                            <div class="form-group">
                                <label></label>
                                <br>
                                <br>
                            </div>

                            <div class="form-group">
                                <label>{!! trans('employer.AdditionalLastName') !!}</label>
                                <input type="text" name="additional_last_name" value="{{old('additional_last_name')}}" class="form-control" >
                                @error('additional_last_name')
                                <div class="alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{!! trans('employer.AdditionalContactEmail') !!}</label>
                                <input type="text" name="additional_contact_email" value="{{old('additional_contact_email')}}" class="form-control" >
                                @error('additional_contact_email')
                                <div class="alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{!! trans('employer.AdditionalContactCellPhone') !!}</label>
                                <input type="text" name="additional_contact_cellphone" value="{{old('additional_contact_cellphone')}}" class="form-control" >
                                @error('additional_contact_cellphone')
                                <div class="alert-danger">{{ $message }}</div>
                                @enderror
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
            <div class="col-md-12">&nbsp;</div>
        </div>
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- mascara de entrada -->
    <!-- <script src="{{ asset('bower_components/input-mask/jquery.inputmask.js') }}"></script> -->

    <!-- <script type='text/javascript' src='http://code.jquery.com/jquery-1.11.0.js'></script> -->
  <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>




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


            $("#SignedAllDocuments").change(function() {
                
                if (document.getElementById('SignedAllDocuments').checked == true) {
                    $('#DivSignatory').hide();

                } else {
                    $('#DivSignatory').show();
                }

            });


            $("#AddContactPerson").change(function() {
                
                if (document.getElementById('AddContactPerson').checked == false) {
                    $('#DivContactPerson1').hide();
                    $('#DivContactPerson2').hide();

                } else {
                    $('#DivContactPerson1').show();
                    $('#DivContactPerson2').show();
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
                //$('#DivSignatory').show();
                $("#PrimaryContactListed").change();

                $('#DivNaicsCodCompany').show();
                $('#DivNaicsNameCompany').hide();

                
                //Inicializar controles para Mailing
                if (document.getElementById('SameAsAbove').checked == true) {
                    $('#DivMailin').hide();

                } else {
                    $('#DivMailin').show();
                }

                //Inicializar controles para firma de todos los documentos
                if (document.getElementById('SignedAllDocuments').checked == true) {
                    $('#DivSignatory').hide();

                } else {
                    $('#DivSignatory').show();
                }

                //Inicializar controles para agregar contacto de persona
                if (document.getElementById('AddContactPerson').checked == false) {
                    $('#DivContactPerson1').hide();
                    $('#DivContactPerson2').hide();

                } else {
                    $('#DivContactPerson1').show();
                    $('#DivContactPerson2').show();
                }

                //Implementando mascara de entrada en inputs
                $('[data-mask]').inputmask()

            });


        </script>
    @endsection