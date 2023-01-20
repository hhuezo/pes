@extends ('dashboard')
@section('contenido')
    <div class="row">
        <div class="col-xl-12 col-xxl-12">




            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">EMPLOYER INFORMATION </h4>
                    </div>
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <div class="default-tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab">General</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab">Job requirements</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab">Message</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="general" role="tabpanel">
                                    <div class="col-md-12">&nbsp;</div>
                                    <form action="{{ url('job_request_detail') }}" method="POST">
                                        <div class="col-md-12 row">


                                            @csrf

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <input type="hidden" name="job_request_id"
                                                        value="{{ $job_request->id }}">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.job_title') !!}</label>
                                                    <select class="form-control select2" name="job_title">
                                                        @foreach ($job_titles as $obj)
                                                            <option value="{{ $obj->id }}">
                                                                {{ $obj->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.Number_of_Workers') !!}</label>
                                                    <input type="number" name="number_workers" class="form-control"
                                                        min="1">
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.PlaceEmploymentInformation') !!}</label>
                                                    <select name="employer_worksite_id" class="form-control select2">
                                                        @foreach ($worksites as $obj)
                                                            <option value="{{ $obj->id }}">{{ $obj->street_address }},
                                                                {{ $obj->city->czc_city }}, {{ $obj->county->czc_county }}
                                                                , {{ $obj->state->cs_state }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.will_work_be_performed') !!}</label>
                                                    <br>
                                                    {!! trans('employer.Yes') !!}

                                                    <input type="radio" value="1" name="is_located_multiple_pwd_msa">

                                                    &nbsp;&nbsp;
                                                    {!! trans('employer.No') !!}
                                                    <input type="radio" value="0" checked
                                                        name="is_located_multiple_pwd_msa">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.JobTitleOfficial') !!}</label>
                                                    <input type="text" name="official_job_title" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.WillTravel') !!}</label><br>
                                                    {!! trans('job_application.Yes') !!}
                                                    <input type="radio" value="1"
                                                        onclick="show_div_geographic_location(1);"
                                                        name="is_travel_required">
                                                    &nbsp;&nbsp;
                                                    {!! trans('job_application.No') !!}
                                                    <input type="radio" value="0"
                                                        onclick="show_div_geographic_location(0);" checked
                                                        name="is_travel_required">

                                                </div>
                                            </div>

                                            <div class="col-md-6" style="display: none;" id="div_geographic_location">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.provide_geographic_location') !!}</label>
                                                    <input type="text" name="geographic_location_frecuency"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.JobDuties') !!}</label>
                                                    <textarea rows="4" class="form-control" name="desc_job_duties" placeholder="{!! trans('job_application.JobDutiesDescription') !!}"></textarea>
                                                </div>

                                            </div>





                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.workers_paid_position') !!}</label>
                                                    <select class="form-control" name="how_paid">
                                                        <option value="1">Hourly</option>
                                                        <option value="2">Hourly + Tips
                                                        </option>
                                                        <option value="3">Piece rate
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.PayRate') !!}</label>
                                                    <input type="number" name="pay_rate" class="form-control"
                                                        step="0.01" min="1" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="checkbox" name="it_has_cba">&nbsp;&nbsp;<label
                                                        for="exampleInputEmail1">{!! trans('job_application.CollectiveBargaining') !!}</label>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.tip_credit') !!}</label>
                                                    {!! trans('employer.Yes') !!}

                                                    <input type="radio" value="1" checked name="use_tip_credit">

                                                    &nbsp;&nbsp;
                                                    {!! trans('employer.No') !!}
                                                    <input type="radio" value="0" name="use_tip_credit">

                                                </div>

                                            </div>

                                            <div class="col-md-12 row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{!! trans('job_application.position_eligible') !!}</label>
                                                        <br>
                                                        {!! trans('employer.Yes') !!}

                                                        <input type="radio" value="1" name="is_there_benefits"
                                                            onclick="show_div_explain_benefits(1)">

                                                        &nbsp;&nbsp;
                                                        {!! trans('employer.No') !!}
                                                        <input type="radio" value="0" checked
                                                            name="is_there_benefits"
                                                            onclick="show_div_explain_benefits(0)">

                                                    </div>
                                                </div>
                                                <div class="col-md-6" id="div_explain_benefits">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{!! trans('job_application.explain_bonus') !!}</label>
                                                        <input type="text" name="explain_benefits"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{!! trans('job_application.SpecialRequirements') !!}</label>
                                                        <br>
                                                        {!! trans('employer.Yes') !!}

                                                        <input type="radio" value="1"
                                                            name="are_there_any_requeriments"
                                                            onclick="show_div_requeriments(1);">

                                                        &nbsp;&nbsp;
                                                        {!! trans('employer.No') !!}
                                                        <input type="radio" value="0" checked
                                                            name="are_there_any_requeriments"
                                                            onclick="show_div_requeriments(0);">
                                                        <br>{!! trans('job_application.lift50lbs') !!}
                                                    </div>

                                                </div>
                                                <div class="col-md-6" id="div_requeriments">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{!! trans('job_application.special_requirements_position') !!}</label>
                                                        <input type="text" name="requeriments" class="form-control"
                                                            min="1">
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.additional_notes') !!}</label>
                                                    <input type="text" name="any_additional_wage_notes"
                                                        class="form-control">
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.IsOvertimeAvailable') !!}</label>
                                                    <select name="is_overtime_available" class="form-control">
                                                        <option value="1">Yes</option>
                                                        <option value="2">No</option>
                                                        <option value="3">Only as Approved
                                                            by
                                                            Management
                                                        </option>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-md-12">
                                                {!! trans('job_application.anticipated_number_hours') !!}
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.Sunday') !!}</label>
                                                    <input type="number" name="ant_workday_sun_hour"
                                                        id="ant_workday_sun_hour" onchange="total_horas();"
                                                        class="form-control" step="1" max="24"
                                                        min="1">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.Monday') !!}</label>
                                                    <input type="number" name="ant_workday_mon_hour"
                                                        id="ant_workday_mon_hour" onchange="total_horas();"
                                                        class="form-control" step="1" max="24"
                                                        min="1">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.Tuesday') !!}</label>
                                                    <input type="number" name="ant_workday_tue_hour"
                                                        id="ant_workday_tue_hour" onchange="total_horas();"
                                                        class="form-control" step="1" max="24"
                                                        min="1">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.Wednesday') !!}</label>
                                                    <input type="number" name="ant_workday_wed_hour"
                                                        id="ant_workday_wed_hour" onchange="total_horas();"
                                                        class="form-control" step="1" max="24"
                                                        min="1">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.Thursday') !!}</label>
                                                    <input type="number" name="ant_workday_thu_hour"
                                                        id="ant_workday_thu_hour" onchange="total_horas();"
                                                        class="form-control" step="1" max="24"
                                                        min="1">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.Friday') !!}</label>
                                                    <input type="number" name="ant_workday_fri_hour"
                                                        id="ant_workday_fri_hour" onchange="total_horas();"
                                                        class="form-control" step="1" max="24"
                                                        min="1">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.Saturday') !!}</label>
                                                    <input type="number" name="ant_workday_sat_hour"
                                                        id="ant_workday_sat_hour" onchange="total_horas();"
                                                        class="form-control" step="1" max="24"
                                                        min="1">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label
                                                        for="exampleInputEmail1"><strong>{!! trans('job_application.total_hours') !!}</strong></label>
                                                    <input type="number" name="ant_workday_total_hours"
                                                        id="ant_workday_total_hours" class="form-control" min="35"
                                                        max="55">
                                                </div>
                                                {!! trans('job_application.reminder') !!}
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.time_this_position') !!}</label>
                                                    <input type="number" name="primary_shift_time" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.shift_times_position') !!}</label>
                                                    <br>
                                                    {!! trans('employer.Yes') !!}

                                                    <input type="radio" value="1"
                                                        name="are_there_additional_shift_times"
                                                        id="are_there_additional_shift_times">

                                                    &nbsp;&nbsp;
                                                    {!! trans('employer.No') !!}
                                                    <input type="radio" value="0" checked
                                                        name="are_there_additional_shift_times"
                                                        id="are_there_additional_shift_times2">
                                                </div>
                                            </div>





                                            <div class="modal-footer">
                                                <a href="{{ url('job_request') }}/{{ $job_request->id }}/edit"> <button
                                                        type="button" class="btn btn-danger btn-rounded"
                                                        data-dismiss="modal"
                                                        style="background-color: #F77883">&nbsp;&nbsp;&nbsp;Close&nbsp;&nbsp;&nbsp;</button></a>
                                                <button type="submit" class="btn btn-primary btn-rounded"
                                                    style="background-color: #2763FF">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</button>
                                            </div>

                                        </div>

                                    </form>




                                </div>
                                <div class="tab-pane fade" id="profile">

                                </div>
                                <div class="tab-pane fade" id="requirements">

                                </div>
                                <div class="tab-pane fade" id="message">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#div_explain_benefits').hide();
            $('#div_requeriments').hide();
        });

        function show_div_explain_benefits(id) {
            if (id == 1) {
                $('#div_explain_benefits').show();
            } else {
                $('#div_explain_benefits').hide();
            }
        }

        function show_div_requeriments(id) {
            if (id == 1) {
                $('#div_requeriments').show();
            } else {
                $('#div_requeriments').hide();
            }
        }

        function show_div_geographic_location(id) {
            if (id == 1) {
                $('#div_geographic_location').show();
            } else {
                $('#div_geographic_location').hide();
            }
        }


        function total_horas() {
            var horas = 0;

            if (document.getElementById('ant_workday_sun_hour').value != "") {
                horas += parseInt(document.getElementById('ant_workday_sun_hour').value);
            }

            if (document.getElementById('ant_workday_mon_hour').value != "") {
                horas += parseInt(document.getElementById('ant_workday_mon_hour').value);
            }

            if (document.getElementById('ant_workday_tue_hour').value != "") {
                horas += parseInt(document.getElementById('ant_workday_tue_hour').value);
            }

            if (document.getElementById('ant_workday_wed_hour').value != "") {
                horas += parseInt(document.getElementById('ant_workday_wed_hour').value);
            }

            if (document.getElementById('ant_workday_thu_hour').value != "") {
                horas += parseInt(document.getElementById('ant_workday_thu_hour').value);
            }

            if (document.getElementById('ant_workday_fri_hour').value != "") {
                horas += parseInt(document.getElementById('ant_workday_fri_hour').value);
            }

            if (document.getElementById('ant_workday_sat_hour').value != "") {
                horas += parseInt(document.getElementById('ant_workday_sat_hour').value);
            }

            document.getElementById('ant_workday_total_hours').value = horas;
        }
    </script>
@endsection
