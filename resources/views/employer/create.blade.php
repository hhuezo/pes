@extends ('dashboard')
@section('contenido')
    <div class="row">
        <div class="col-xl-12 col-xxl-12">




            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">EMPLOYER INFORMATION</h4>
                    </div>
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <div class="default-tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#profile">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#contact">Contact</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#message">Message</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="home" role="tabpanel">
                                    <form action="{{ url('employer') }}" method="POST">
                                        @csrf
                                        <div class="row">


                                            <div class="col-xl-12 col-xxl-12">&nbsp;</div>
                                            <div class="col-xl-6 col-xxl-6">

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('employer.LegalName') !!}</label>
                                                    <input type="text" name="legal_business_name"
                                                        value="{{ $user->name }}" required class="form-control">
                                                    @error('legal_business_name')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>{!! trans('employer.TradeName') !!}</label>
                                                    <input type="text" name="trade_name" value="{{ old('trade_name') }}"
                                                        class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.IdentificationNumber') !!}</label>
                                                    <input type="text" name="federal_id_number"
                                                        value="{{ old('federal_id_number') }}" required class="form-control"
                                                        data-inputmask="'mask': ['99-9999999']" data-mask
                                                        class="form-control" maxlength="10">
                                                    @error('federal_id_number')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.YearBusinessEstablished') !!}</label>
                                                    <input type="text" name="year_business_established"
                                                        value="{{ old('year_business_established') }}" min="1900"
                                                        max="<?php echo date('Y'); ?>" class="form-control" required
                                                        data-inputmask="'mask': ['9999']" data-mask class="form-control"
                                                        maxlength="4">
                                                    @error('year_business_established')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.NumberEmployees') !!}</label>
                                                    <input type="number" min="1" name="number_employees_full_time"
                                                        value="{{ old('number_employees_full_time') }}" required
                                                        class="form-control">
                                                    @error('number_employees_full_time')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.PrimaryBusinessPhone') !!}</label>
                                                    <input type="text" name="primary_business_phone"
                                                        value="{{ old('primary_business_phone') }}" required
                                                        class="form-control" data-inputmask="'mask': ['(999)999-9999']"
                                                        data-mask class="form-control" maxlength="13">
                                                    @error('primary_business_phone')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.PrimaryBusinessFax') !!}</label>
                                                    <input type="text" name="primary_business_fax"
                                                        value="{{ old('primary_business_fax') }}"
                                                        data-inputmask="'mask': ['(999)999-9999']" data-mask
                                                        class="form-control" maxlength="13" class="form-control">

                                                </div>


                                            </div>


                                            <div class="col-xl-6 col-xxl-6">

                                                <div class="form-group">
                                                    <label>{!! trans('employer.CompanyWebsite') !!}</label>
                                                    <input type="text" name="company_website"
                                                        value="{{ old('legal_business_name') }}" class="form-control">
                                                    @error('company_website')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label>{!! trans('employer.ParticipatedH-2B') !!}</label>
                                                    <select class="form-control" name="has_participate_h2b"
                                                        value="{{ old('has_participate_h2b') }}" id="ParticipatedH-2B">
                                                        <option value="0">{!! trans('employer.No') !!} </option>
                                                        <option value="1">{!! trans('employer.Yes') !!} </option>
                                                    </select>
                                                </div>


                                                <div class="form-group" id="DivYearsCompanyParticipated">
                                                    <label>{!! trans('employer.YearsCompanyParticipated') !!}</label>
                                                    <input type="number" name="quantity_year_has_participate_h2b"
                                                        value="{{ old('quantity_year_has_participate_h2b') }}"
                                                        maxlength="4" class="form-control">
                                                    @error('quantity_year_has_participate_h2b')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.PrimaryBusiness') !!}</label>
                                                    <select class="form-control" name="primary_business_type_id"
                                                        value="{{ old('primary_business_type_id') }}" required
                                                        id="PrimaryBusinessType">
                                                        <option value="">Select</option>
                                                        @foreach ($primary_business_types as $obj)
                                                            <option value="{{ $obj->id }}">{{ $obj->name_english }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group" id="DivNaicsCodCompany">
                                                    <label>{!! trans('employer.NaicsCodCompany') !!}</label>
                                                    <select class="form-control" name="naics_id"
                                                        value="{{ old('naics_id') }}" id="NaicsCod">

                                                    </select>
                                                </div>

                                                <div class="form-group" id="DivNaicsNameCompany">
                                                    <label>{!! trans('employer.NaicsCodCompany') !!}</label>
                                                    <input type="text" name="naics_code"
                                                        value="{{ old('naics_code') }}" class="form-control">
                                                    @error('naics_code')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.GrossCompanyIncome') !!}</label>
                                                    <input type="number" step="0.01"
                                                        name="year_end_gross_company_income"
                                                        value="{{ old('year_end_gross_company_income') }}"
                                                        class="form-control" required class="form-control">
                                                    @error('year_end_gross_company_income')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.NetCompanyIncome') !!}</label>
                                                    <input type="number" step="0.01"
                                                        name="year_end_net_company_income"
                                                        value="{{ old('year_end_net_company_income') }}"
                                                        class="form-control" class="form-control">
                                                    @error('year_end_net_company_income')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                                            </div>

                                        </div>

                                    </form>



                                </div>
                                <div class="tab-pane fade" id="profile">
                                    <div class="pt-4">
                                        <h4>This is profile title</h4>
                                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu
                                            stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                        </p>
                                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu
                                            stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                        </p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact">
                                    <div class="pt-4">
                                        <h4>This is contact title</h4>
                                        <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                            Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                                        </p>
                                        <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                            Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                                        </p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="message">
                                    <div class="pt-4">
                                        <h4>This is message title</h4>
                                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu
                                            stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                        </p>
                                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu
                                            stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

























            </form>

        </div>
    </div>

    <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#DivYearsCompanyParticipated').hide(); <<
            << << < HEAD
            $('#DivSignatory').hide();

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

            //Add contact person
            if (document.getElementById('AddContactPerson').checked == false) {
                $('#DivContactPerson1').hide();
                $('#DivContactPerson2').hide();

            } else {
                $('#DivContactPerson1').show();
                $('#DivContactPerson2').show();
            }

            ===
            === =
            $('#DivNaicsCodCompany').hide(); >>>
            >>> > 8429 a4adddb3feb18647819d57c2866e32e59eef

        });


        <<
        << << < HEAD

        function selectBusiness() {
            //alert('select Business Type');
            document.getElementById('primary_business_type_id_selected').value = document.getElementById(
                'PrimaryBusinessType').value;

            document.getElementById('primary_business_type_txt_selected').value = $("#PrimaryBusinessType option:selected")
                .text();



        }

        ===
        === =
        // tab one
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
                        _select += '<option value="' + data[i].id + '"  >' + data[i].code +
                        ' ' + data[i]
                        .name +
                        '</option>';
                    $("#NaicsCod").html(_select);
                });
            } else {
                $('#DivNaicsCodCompany').hide();
                $('#DivNaicsNameCompany').show();
            }
        });


        >>>
        >>> > 8429 a4adddb3feb18647819d57c2866e32e59eef
        $("#ParticipatedH-2B").change(function() {
            if (document.getElementById('ParticipatedH-2B').value == 1) {
                $('#DivYearsCompanyParticipated').show();
            } else {
                $('#DivYearsCompanyParticipated').hide();
            }

            <<
            << << < HEAD
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
                        _select += '<option value="' + data[i].id + '"  >' + data[i].code +
                        ' ' + data[i]
                        .name +
                        '</option>';
                    $("#NaicsCod").html(_select);
                });
            } else {
                $('#DivNaicsCodCompany').hide();
                $('#DivNaicsNameCompany').show();
            } ===
            === = >>>
            >>> > 8429 a4adddb3feb18647819d57c2866e32e59eef
        });
        // end tab one
    </script>
@endsection
