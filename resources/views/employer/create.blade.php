@extends ('dashboard2')
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
                                    <a class="nav-link" data-toggle="tab">{!! trans('employer.GeneralData') !!}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab"
                                        href="#tab_content1">{!! trans('employer.EmployerInformation') !!}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab">{!! trans('employer.EmployerData') !!}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab">{!! trans('employer.Contact') !!}</a>
                                </li>

                            </ul>


                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab_content1" role="tabpanel">
                                    <form action="{{ url('employer') }}" method="POST">
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
                                                        value="{{ $user->name }}" class="form-control">
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
                                                    <label>{!! trans('employer.IdentificationNumber') !!}<b style="color: #FF9696">(*This field
                                                            is required
                                                            )</b></label>
                                                    <input type="text" name="federal_id_number"
                                                        value="{{ old('federal_id_number') }}" class="form-control"
                                                        data-inputmask="'mask': ['99-9999999']" data-mask
                                                        class="form-control" maxlength="10">
                                                    @error('federal_id_number')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label>{!! trans('employer.YearBusinessEstablished') !!}<b style="color: #FF9696">(*This field
                                                            is required
                                                            )</b></label>
                                                    <input type="text" name="year_business_established"
                                                        value="{{ old('year_business_established') }}" min="1900"
                                                        max="<?php echo date('Y'); ?>" class="form-control"
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
                                                    <input type="number" min="1" name="number_employees_full_time"
                                                        value="{{ old('number_employees_full_time') }}"
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
                                                        value="{{ old('primary_business_phone') }}" class="form-control"
                                                        data-inputmask="'mask': ['(999)999-9999']" data-mask
                                                        class="form-control" maxlength="13">
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
                                                    <label>{!! trans('employer.PrimaryBusiness') !!}<b style="color: #FF9696">(*This field
                                                            is required
                                                            )</b></label>
                                                    <select class="form-control select2" name="industry_id"
                                                        value="{{ old('industry_id') }}" id="Industry">
                                                        <option value="">Select</option>
                                                        @foreach ($industries as $obj)
                                                            <option value="{{ $obj->id }}">
                                                                {{ $obj->id_code . ' ' . $obj->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('primary_business_type_id')
                                                        <div class="alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group" id="DivNaicsCodCompany">
                                                    <label>{!! trans('employer.NaicsCodCompany') !!}</label>
                                                    <select class="form-control select2" name="naics_id"
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
                                                    <label>{!! trans('employer.GrossCompanyIncome') !!}<b style="color: #FF9696">(*This field
                                                            is required
                                                            )</b></label>
                                                    <input type="number" step="0.01"
                                                        name="year_end_gross_company_income"
                                                        value="{{ old('year_end_gross_company_income') }}"
                                                        class="form-control" class="form-control">
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
            $('#DivYearsCompanyParticipated').hide();
            $('#DivNaicsCodCompany').hide();



            $("#Industry").change(function() {
                var Industry = $(this).val();

                if (Industry != 6) {
                    $('#DivNaicsCodCompany').show();
                    $('#DivNaicsNameCompany').hide();

                    $.get("{{ url('get_naics_code') }}" + '/' + Industry, function(data) {
                        //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
                        console.log(data);
                        var _select = ''
                        for (var i = 0; i < data.length; i++)
                            _select += '<option value="' + data[i].id + '"  >' + data[i]
                            .cn_code + " " + data[i]
                            .cn_description +
                            '</option>';
                        $("#NaicsCod").html(_select);
                    });
                } else {
                    $('#DivNaicsCodCompany').hide();
                    $('#DivNaicsNameCompany').show();
                }
            });


        });


        // tab one



        $("#ParticipatedH-2B").change(function() {
            if (document.getElementById('ParticipatedH-2B').value == 1) {
                $('#DivYearsCompanyParticipated').show();
            } else {
                $('#DivYearsCompanyParticipated').hide();
            }

        });
        // end tab one
    </script>
@endsection
