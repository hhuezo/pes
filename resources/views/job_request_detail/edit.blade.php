@extends ('dashboard')
@section('contenido')
    @if ($detail->minimum_education_id != 7)
        <style>
            .div_diploma_degree {
                display: none;
            }
        </style>
    @endif
    @if ($detail->has_second_us_degree != 1)
        <style>
            .div_has_second_us_degree {
                display: none;
            }
        </style>
    @endif

    @if ($detail->is_training_required != 1)
        <style>
            .div_training {
                display: none;
            }
        </style>
    @endif

    @if ($detail->is_employement_experience_required != 1)
        <style>
            .div_experience {
                display: none;
            }
        </style>
    @endif

    @if ($detail->has_special_skills_required != 1)
        <style>
            .div_skill {
                display: none;
            }
        </style>
    @endif

    @if ($detail->has_to_supervise_others != 1)
        <style>
            .div_supervise_others {
                display: none;
            }
        </style>
    @endif

    @if ($detail->alternate_experience_accepted != 1)
        <style>
            .div_alternative_job {
                display: none;
            }
        </style>
    @endif


    @if ($detail->alternate_education_level_id != 7)
        <style>
            .div_diploma_degree2 {
                display: none;
            }
        </style>
    @endif

    @if ($detail->alternate_training_accepted != 1)
        <style>
            .div_training2 {
                display: none;
            }
        </style>
    @endif

    @if ($detail->alternate_employment_exp_required != 1)
        <style>
            .div_experience2 {
                display: none;
            }
        </style>
    @endif

    @if ($detail->alternate_especial_skills_accepted != 1)
        <style>
            .div_skill2 {
                display: none;
            }
        </style>
    @endif

    @if ($detail->is_travel_required != 1)
        <style>
            .div_geographic_location {
                display: none;
            }
        </style>
    @endif

    @if (session()->has('tab_detail'))
        @php($tab_detail = session('tab_detail'))
    @else
        @php($tab_detail = 1)
    @endif



    <div class="row">
        <div class="col-xl-12 col-xxl-12">




            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">REQUEST </h4>
                    </div>
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <div class="default-tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab1">General</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab2">Supervise</a>
                                </li>
                                <li class="nav-item">
                                    @if (is_null($detail->has_to_supervise_others))
                                        <a class="nav-link" data-toggle="tab">Job requirements</a>
                                    @else
                                        <a class="nav-link" data-toggle="tab" href="#tab3">Job requirements</a>
                                    @endif
                                </li>
                                <li class="nav-item">
                                    @if (is_null($detail->minimum_education_id))
                                        <a class="nav-link" data-toggle="tab4">Alternative job requirements</a>
                                    @else
                                        <a class="nav-link" data-toggle="tab" href="#tab4">Alternative job
                                            requirements</a>
                                    @endif
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                    <div class="col-md-12">&nbsp;</div>
                                    <form method="POST" action="{{ route('job_request_detail.update', $detail->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <div class="col-md-12 row">


                                            @csrf

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.job_title') !!}</label>
                                                    <select class="form-control select2" name="job_title">
                                                        @foreach ($job_titles as $obj)
                                                            @if ($obj->id == $detail->job_title_id)
                                                                <option value="{{ $obj->id }}" selected>
                                                                    {{ $obj->title }}</option>
                                                            @else
                                                                <option value="{{ $obj->id }}">
                                                                    {{ $obj->title }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.Number_of_Workers') !!}</label>
                                                    <input type="number" name="number_workers"
                                                        value="{{ $detail->number_workers }}" class="form-control"
                                                        min="1">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.PlaceEmploymentInformation') !!}</label>
                                                    <select name="employer_worksite_id" class="form-control select2">
                                                        @foreach ($worksites as $obj)
                                                            @if ($obj->id == $detail->employer_worksite_id)
                                                                <option value="{{ $obj->id }}" selected>
                                                                    {{ $obj->id }} {{ $obj->street_address }},
                                                                    {{ $obj->city->czc_city }},
                                                                    {{ $obj->county->czc_county }}
                                                                    , {{ $obj->state->cs_state }}</option>
                                                            @else
                                                                <option value="{{ $obj->id }}">{{ $obj->id }}
                                                                    {{ $obj->street_address }},
                                                                    {{ $obj->city->czc_city }},
                                                                    {{ $obj->county->czc_county }}
                                                                    , {{ $obj->state->cs_state }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>




                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.JobTitleOfficial') !!}</label>
                                                    <input type="text" value="{{ $detail->official_job_title }}"
                                                        name="official_job_title" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.will_work_be_performed') !!}</label>
                                                    <br>
                                                    {!! trans('employer.Yes') !!}

                                                    @if ($detail->is_located_multiple_pwd_msa == 1)
                                                        <input type="radio" value="1" checked
                                                            name="is_located_multiple_pwd_msa">
                                                    @else
                                                        <input type="radio" value="1"
                                                            name="is_located_multiple_pwd_msa">
                                                    @endif


                                                    &nbsp;&nbsp;
                                                    {!! trans('employer.No') !!}

                                                    @if ($detail->is_located_multiple_pwd_msa == 0)
                                                        <input type="radio" value="0" checked
                                                            name="is_located_multiple_pwd_msa">
                                                    @else
                                                        <input type="radio" value="0"
                                                            name="is_located_multiple_pwd_msa">
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.WillTravel') !!}</label><br>
                                                    {!! trans('job_application.Yes') !!}
                                                    @if ($detail->is_travel_required == 1)
                                                        <input type="radio" value="1" checked
                                                            name="is_travel_required"
                                                            onclick="show_div_geographic_location(1);">
                                                    @else
                                                        <input type="radio" value="1" name="is_travel_required"
                                                            onclick="show_div_geographic_location(1);">
                                                    @endif

                                                    &nbsp;&nbsp;
                                                    {!! trans('job_application.No') !!}
                                                    @if ($detail->is_travel_required == 0)
                                                        <input type="radio" value="0" checked
                                                            name="is_travel_required"
                                                            onclick="show_div_geographic_location(0);">
                                                    @else
                                                        <input type="radio" value="0" name="is_travel_required"
                                                            onclick="show_div_geographic_location(0);">
                                                    @endif

                                                </div>
                                            </div>

                                            <div class="col-md-6 div_geographic_location" id="div_geographic_location">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.provide_geographic_location') !!}</label>
                                                    <input type="text" name="geographic_location_frecuency"
                                                        value="{{ $detail->geographic_location_frecuency }}"
                                                        class="form-control">
                                                </div>
                                            </div>




                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    @if ($detail->it_has_cba == 1)
                                                        <input type="checkbox" checked name="it_has_cba">
                                                    @else
                                                        <input type="checkbox" name="it_has_cba">
                                                    @endif
                                                    &nbsp;&nbsp;<label
                                                        for="exampleInputEmail1">{!! trans('job_application.CollectiveBargaining') !!}</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.JobDuties') !!}</label>
                                                    <textarea class="form-control" name="desc_job_duties" placeholder="{!! trans('job_application.JobDutiesDescription') !!}">
                                                    {{ $detail->desc_job_duties }}
                                                    </textarea>
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.workers_paid_position') !!}</label>
                                                    <select class="form-control" name="how_paid">
                                                        @if ($detail->how_paid == 1)
                                                            <option value="1" selected>Hourly</option>
                                                        @else
                                                            <option value="1">Hourly</option>
                                                        @endif

                                                        @if ($detail->how_paid == 2)
                                                            <option value="2" selected>Hourly + Tips
                                                            </option>
                                                        @else
                                                            <option value="2">Hourly + Tips
                                                            </option>
                                                        @endif

                                                        @if ($detail->how_paid == 3)
                                                            <option value="3" selected>Piece rate
                                                            </option>
                                                        @else
                                                            <option value="3">Piece rate
                                                            </option>
                                                        @endif

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.PayRate') !!}</label>
                                                    <input type="number" name="pay_rate"
                                                        value="{{ $detail->pay_rate }}" class="form-control"
                                                        step="0.01" min="1" required>
                                                </div>
                                            </div>




                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.tip_credit') !!}</label>
                                                    <br>
                                                    {!! trans('employer.Yes') !!}
                                                    @if ($detail->use_tip_credit == 1)
                                                        <input type="radio" value="1" checked
                                                            name="use_tip_credit">
                                                    @else
                                                        <input type="radio" value="1" name="use_tip_credit">
                                                    @endif


                                                    &nbsp;&nbsp;
                                                    {!! trans('employer.No') !!}
                                                    @if ($detail->use_tip_credit == 0)
                                                        <input type="radio" value="0" checked
                                                            name="use_tip_credit">
                                                    @else
                                                        <input type="radio" value="0" name="use_tip_credit">
                                                    @endif


                                                </div>

                                            </div>

                                            <div class="col-md-12 row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{!! trans('job_application.position_eligible') !!}</label>
                                                        <br>
                                                        {!! trans('employer.Yes') !!}

                                                        @if ($detail->is_there_benefits == 1)
                                                            <input type="radio" value="1" checked
                                                                name="is_there_benefits"
                                                                onclick="show_div_explain_benefits(1)">
                                                        @else
                                                            <input type="radio" value="1" name="is_there_benefits"
                                                                onclick="show_div_explain_benefits(1)">
                                                        @endif


                                                        &nbsp;&nbsp;
                                                        {!! trans('employer.No') !!}

                                                        @if ($detail->is_there_benefits == 0)
                                                            <input type="radio" value="0" checked
                                                                name="is_there_benefits"
                                                                onclick="show_div_explain_benefits(0)">
                                                        @else
                                                            <input type="radio" value="0" name="is_there_benefits"
                                                                onclick="show_div_explain_benefits(0)">
                                                        @endif



                                                    </div>
                                                </div>
                                                @if ($detail->is_there_benefits == 1)
                                                    <div class="col-md-6" id="div_explain_benefits">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.explain_bonus') !!}</label>
                                                            <input type="text" name="explain_benefits"
                                                                value="{{ $detail->explain_benefits }}"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-md-6" style="display: none;"
                                                        id="div_explain_benefits">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.explain_bonus') !!}</label>
                                                            <input type="text" name="explain_benefits"
                                                                value="{{ $detail->explain_benefits }}"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>

                                            <div class="col-md-12 row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{!! trans('job_application.SpecialRequirements') !!}</label>
                                                        <br>
                                                        {!! trans('employer.Yes') !!}

                                                        @if ($detail->are_there_any_requeriments == 1)
                                                            <input type="radio" value="1" checked
                                                                name="are_there_any_requeriments"
                                                                onclick="show_div_requeriments(1);">
                                                        @else
                                                            <input type="radio" value="1"
                                                                name="are_there_any_requeriments"
                                                                onclick="show_div_requeriments(1);">
                                                        @endif


                                                        &nbsp;&nbsp;
                                                        {!! trans('employer.No') !!}
                                                        @if ($detail->are_there_any_requeriments == 0)
                                                            <input type="radio" value="0" checked
                                                                name="are_there_any_requeriments"
                                                                onclick="show_div_requeriments(0);">
                                                        @else
                                                            <input type="radio" value="0"
                                                                name="are_there_any_requeriments"
                                                                onclick="show_div_requeriments(0);">
                                                        @endif



                                                        <br>{!! trans('job_application.lift50lbs') !!}
                                                    </div>

                                                </div>
                                                @if ($detail->are_there_any_requeriments == 1)
                                                    <div class="col-md-6" id="div_requeriments">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.special_requirements_position') !!}</label>
                                                            <input type="text" name="requeriments"
                                                                class="form-control" value="{{ $detail->requeriments }}"
                                                                min="1">
                                                        </div>

                                                    </div>
                                                @else
                                                    <div class="col-md-6" id="div_requeriments" style="display: none;">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.special_requirements_position') !!}</label>
                                                            <input type="text" name="requeriments"
                                                                class="form-control" value="{{ $detail->requeriments }}"
                                                                min="1">
                                                        </div>

                                                    </div>
                                                @endif


                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.additional_notes') !!}</label>
                                                    <input type="text" name="any_additional_wage_notes"
                                                        value="{{ $detail->any_additional_wage_notes }}"
                                                        class="form-control">
                                                </div>
                                            </div>


                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.IsOvertimeAvailable') !!}</label>
                                                    <select name="is_overtime_available" class="form-control">

                                                        @if ($detail->is_overtime_available == 1)
                                                            <option value="1" selected>Yes</option>
                                                        @else
                                                            <option value="1">Yes</option>
                                                        @endif

                                                        @if ($detail->is_overtime_available == 2)
                                                            <option value="2" selected>No</option>
                                                        @else
                                                            <option value="2">No</option>
                                                        @endif

                                                        @if ($detail->is_overtime_available == 3)
                                                            <option value="3" selected>Only as Approved by Management
                                                            </option>
                                                        @else
                                                            <option value="3">Only as Approved by Management </option>
                                                        @endif

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
                                                        value="{{ $detail->ant_workday_sun_hour }}"
                                                        id="ant_workday_sun_hour" onchange="total_horas();"
                                                        class="form-control" step="1" max="24"
                                                        min="1">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.Monday') !!}</label>
                                                    <input type="number" name="ant_workday_mon_hour"
                                                        value="{{ $detail->ant_workday_mon_hour }}"
                                                        id="ant_workday_mon_hour" onchange="total_horas();"
                                                        class="form-control" step="1" max="24"
                                                        min="1">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.Tuesday') !!}</label>
                                                    <input type="number" name="ant_workday_tue_hour"
                                                        value="{{ $detail->ant_workday_tue_hour }}"
                                                        id="ant_workday_tue_hour" onchange="total_horas();"
                                                        class="form-control" step="1" max="24"
                                                        min="1">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.Wednesday') !!}</label>
                                                    <input type="number" name="ant_workday_wed_hour"
                                                        value="{{ $detail->ant_workday_wed_hour }}"
                                                        id="ant_workday_wed_hour" onchange="total_horas();"
                                                        class="form-control" step="1" max="24"
                                                        min="1">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.Thursday') !!}</label>
                                                    <input type="number" name="ant_workday_thu_hour"
                                                        value="{{ $detail->ant_workday_thu_hour }}"
                                                        id="ant_workday_thu_hour" onchange="total_horas();"
                                                        class="form-control" step="1" max="24"
                                                        min="1">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.Friday') !!}</label>
                                                    <input type="number" name="ant_workday_fri_hour"
                                                        value="{{ $detail->ant_workday_fri_hour }}"
                                                        id="ant_workday_fri_hour" onchange="total_horas();"
                                                        class="form-control" step="1" max="24"
                                                        min="1">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.Saturday') !!}</label>
                                                    <input type="number" name="ant_workday_sat_hour"
                                                        value="{{ $detail->ant_workday_sat_hour }}"
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
                                                        value="{{ $detail->ant_workday_total_hours }}"
                                                        id="ant_workday_total_hours" class="form-control" min="35"
                                                        max="55">
                                                </div>
                                                {!! trans('job_application.reminder') !!}
                                            </div>


                                            <div class="col-md-6">

                                                <label for="exampleInputEmail1">{!! trans('job_application.shift_times_position') !!}</label>
                                                <br>
                                                {!! trans('employer.Yes') !!}

                                                @if ($detail->are_there_additional_shift_times == 1)
                                                    <input type="radio" value="1" checked
                                                        name="are_there_additional_shift_times"
                                                        id="are_there_additional_shift_times"
                                                        onclick="show_div_shift_times(1)">
                                                @else
                                                    <input type="radio" value="1"
                                                        name="are_there_additional_shift_times"
                                                        id="are_there_additional_shift_times"
                                                        onclick="show_div_shift_times(1)">
                                                @endif



                                                &nbsp;&nbsp;
                                                {!! trans('employer.No') !!}

                                                @if ($detail->are_there_additional_shift_times == 0)
                                                    <input type="radio" value="0" checked
                                                        name="are_there_additional_shift_times"
                                                        id="are_there_additional_shift_times"
                                                        onclick="show_div_shift_times(0)">
                                                @else
                                                    <input type="radio" value="0"
                                                        name="are_there_additional_shift_times"
                                                        id="are_there_additional_shift_times"
                                                        onclick="show_div_shift_times(0)">
                                                @endif

                                                <br>


                                                <div id="div_shift_times1">

                                                    @if ($shift_times->count() > 0)
                                                        @php($i = 1)
                                                        @foreach ($shift_times as $obj)
                                                            @if ($i == 1)
                                                                <div class="form-group">
                                                                    <label
                                                                        for="exampleInputEmail1">{!! trans('job_application.primary_shift_start_time') !!}</label>
                                                                    <input type="time" name="primary_shift_start_time"
                                                                        value="{{ $obj->start_time }}"
                                                                        class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="exampleInputEmail1">{!! trans('job_application.primary_shift_end_time') !!}</label>
                                                                    <input type="time" name="primary_shift_end_time"
                                                                        value="{{ $obj->end_time }}"
                                                                        class="form-control">
                                                                </div>
                                                            @endif

                                                            @php($i++)
                                                        @endforeach
                                                    @else
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.primary_shift_start_time') !!}</label>
                                                            <input type="text" name="primary_shift_start_time"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.primary_shift_end_time') !!}</label>
                                                            <input type="text" name="primary_shift_end_time"
                                                                class="form-control">
                                                        </div>
                                                    @endif


                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <br>
                                                    <br>

                                                    <div id="div_shift_times2">
                                                        @if ($shift_times->count() > 0)
                                                            @php($i = 1)
                                                            @foreach ($shift_times as $obj)
                                                                @if ($i == 2)
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="exampleInputEmail1">{!! trans('job_application.secondary_shift_start_time') !!}</label>
                                                                        <input type="time"
                                                                            name="secondary_shift_start_time"
                                                                            value="{{ $obj->start_time }}"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="exampleInputEmail1">{!! trans('job_application.secondary_shift_end_time') !!}</label>
                                                                        <input type="time"
                                                                            name="secondary_shift_end_time"
                                                                            value="{{ $obj->end_time }}"
                                                                            class="form-control">
                                                                    </div>
                                                                @endif
                                                                @php($i++)
                                                            @endforeach
                                                        @else
                                                            <div class="form-group">
                                                                <br>


                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.secondary_shift_start_time') !!}</label>
                                                                <input type="text" name="secondary_shift_start_time"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.secondary_shift_end_time') !!}</label>
                                                                <input type="text" name="secondary_shift_end_time"
                                                                    class="form-control">
                                                            </div>
                                                        @endif
                                                    </div>


                                                </div>
                                            </div>





                                            <div class="col-md-12">
                                                <center>
                                                    <a href="{{ url('job_request') }}/{{ $job_request->id }}/edit">
                                                        <button type="button" class="btn btn-danger btn-rounded"
                                                            style="background-color: #F77883">&nbsp;&nbsp;&nbsp;Back&nbsp;&nbsp;&nbsp;</button>
                                                    </a>
                                                    &nbsp;&nbsp;
                                                    <button type="submit" class="btn btn-primary btn-rounded"
                                                        style="background-color: #2763FF">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</button>
                                                    <center>

                                            </div>


                                        </div>

                                    </form>




                                </div>
                                <div class="tab-pane fade" id="tab2">
                                    <div class="col-md-12 row">

                                        <div class="col-md-2 row">&nbsp;</div>

                                        <div class="col-md-8">
                                            <br>&nbsp;

                                            <form action="{{ url('job_request_detail/job_offer_supervise') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $detail->id }}">
                                                <div class="form-group">
                                                    <label>{!! trans('job_application.position_supervise') !!}</label>
                                                    <br>&nbsp;
                                                    {!! trans('employer.Yes') !!}

                                                    @if ($detail->has_to_supervise_others == 1)
                                                        <input type="radio" value="1" checked
                                                            name="has_to_supervise_others"
                                                            onclick="show_div_supervise_others(1);">
                                                    @else
                                                        <input type="radio" value="1"
                                                            name="has_to_supervise_others"
                                                            onclick="show_div_supervise_others(1);">
                                                    @endif

                                                    &nbsp;&nbsp;
                                                    {!! trans('employer.No') !!}
                                                    @if ($detail->has_to_supervise_others != 1)
                                                        <input type="radio" value="0" checked
                                                            name="has_to_supervise_others"
                                                            onclick="show_div_supervise_others(0);">
                                                    @else
                                                        <input type="radio" value="0"
                                                            name="has_to_supervise_others"
                                                            onclick="show_div_supervise_others(0);">
                                                    @endif

                                                </div>

                                                <div class="div_supervise_others" id="div_supervise_others">

                                                    <div class="form-group">
                                                        <label
                                                            class="col-sm-12 col-form-label">{!! trans('job_application.title_occupation') !!}</label>

                                                        <select name="catalog_job_title_id" class="form-control select2">
                                                            @foreach ($job_titles as $obj)
                                                                <option value="{{ $obj->id }}">
                                                                    {{ $obj->onetsoc_code }} - {{ $obj->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>


                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{!! trans('job_application.training_required') !!}</label>
                                                        <input type="number" name="number_to_be_supervised"
                                                            class="form-control">
                                                    </div>
                                                </div>



                                                <div class="col-md-12">
                                                    <center>
                                                        <a href="{{ url('job_request') }}/{{ $job_request->id }}/edit">
                                                            <button type="button" class="btn btn-danger btn-rounded"
                                                                style="background-color: #F77883">&nbsp;&nbsp;&nbsp;Back&nbsp;&nbsp;&nbsp;</button>
                                                        </a>
                                                        &nbsp;&nbsp;
                                                        <button type="submit" class="btn btn-primary btn-rounded"
                                                            style="background-color: #2763FF">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</button>
                                                        <center>

                                                </div>



                                                <!-- <div class="modal-footer">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <button type="button" class="btn btn-danger"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        data-dismiss="modal">Close</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <button type="submit" class="btn btn-primary">Save
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        changes</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>-->


                                            </form>


                                            <br>



                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">Positions</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            @if ($job_offerts->count() > 0)
                                                                <table class="table table-hover table-responsive-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Job title</th>
                                                                            <th>Number</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($job_offerts as $obj)
                                                                            <tr>
                                                                                <td>{{ $obj->title->title }}</td>
                                                                                <td><span class="badge badge-primary"
                                                                                        style="background-color: #2763FF">{{ $obj->number_to_be_supervised }}</span>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /# card -->
                                            </div>
                                        </div>

                                        <div class="col-md-2 row">&nbsp;</div>


                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab3">


                                    <div class="col-md-12">&nbsp;</div>
                                    <div class="col-md-12 row">
                                        <div class="col-md-2">&nbsp;</div>

                                        <div class="col-md-8">
                                            <form action="{{ url('job_request_detail/job_requirements') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $detail->id }}">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{!! trans('job_application.Education') !!}</label>
                                                        <select class="form-control" name="minimum_education_id"
                                                            onchange="show_div_diploma_degree(this.value);">
                                                            @foreach ($degree_codes as $obj)
                                                                @if ($detail->minimum_education_id == $obj->id)
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
                                                </div>


                                                <div class="div_diploma_degree" id="div_diploma_degree">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.diploma_degree') !!}</label>
                                                            <input type="text" name="other_us_degree"
                                                                value="{{ $detail->other_us_degree }}"
                                                                class="form-control">
                                                        </div>
                                                    </div>



                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.study_required') !!}</label>
                                                            <input type="text" name="majors_or_field_of_study"
                                                                value="{{ $detail->majors_or_field_of_study }}"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{!! trans('job_application.second_diploma') !!}</label>
                                                        <br>&nbsp;
                                                        {!! trans('employer.Yes') !!}
                                                        @if ($detail->has_second_us_degree == 1)
                                                            <input type="radio" value="1" checked
                                                                name="has_second_us_degree"
                                                                onclick="show_div_has_second_us_degree(1);">
                                                        @else
                                                            <input type="radio" value="1"
                                                                name="has_second_us_degree"
                                                                onclick="show_div_has_second_us_degree(1);">
                                                        @endif

                                                        &nbsp;&nbsp;
                                                        {!! trans('employer.No') !!}

                                                        @if ($detail->has_second_us_degree != 1)
                                                            <input type="radio" value="0" checked
                                                                name="has_second_us_degree"
                                                                onclick="show_div_has_second_us_degree(0);">
                                                        @else
                                                            <input type="radio" value="0"
                                                                name="has_second_us_degree"
                                                                onclick="show_div_has_second_us_degree(0);">
                                                        @endif

                                                    </div>
                                                </div>

                                                <div class="col-md-12 div_has_second_us_degree"
                                                    id="div_has_second_us_degree">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{!! trans('job_application.indicate_second_diploma') !!}</label>
                                                        <input type="text" name="majors_or_field_of_study_2"
                                                            value="{{ $detail->majors_or_field_of_study_2 }}"
                                                            class="form-control">
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{!! trans('job_application.opportunity_required') !!}</label>
                                                        <br>&nbsp;
                                                        {!! trans('employer.Yes') !!}
                                                        @if ($detail->is_training_required == 1)
                                                            <input type="radio" value="1" checked
                                                                name="is_training_required"
                                                                onclick="show_div_training(1)">
                                                        @else
                                                            <input type="radio" value="1"
                                                                name="is_training_required"
                                                                onclick="show_div_training(1)">
                                                        @endif


                                                        &nbsp;&nbsp;
                                                        {!! trans('employer.No') !!}
                                                        @if ($detail->is_training_required != 1)
                                                            <input type="radio" value="0" checked
                                                                name="is_training_required"
                                                                onclick="show_div_training(0)">
                                                        @else
                                                            <input type="radio" value="0"
                                                                name="is_training_required"
                                                                onclick="show_div_training(0)">
                                                        @endif

                                                    </div>
                                                </div>

                                                <div class="div_training" id="div_training">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <br>&nbsp;
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.specify_number_months') !!}</label>

                                                            <input type="number" min="1"
                                                                name="months_of_training_required"
                                                                value="{{ $detail->months_of_training_required }}"
                                                                class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.training_required') !!}</label>
                                                            <input type="text" name="field_training_required"
                                                                value="{{ $detail->field_training_required }}"
                                                                class="form-control">
                                                        </div>
                                                    </div>

                                                </div>


                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{!! trans('job_application.experience_required') !!}</label>
                                                        <br>&nbsp;
                                                        {!! trans('employer.Yes') !!}

                                                        @if ($detail->is_employement_experience_required == 1)
                                                            <input type="radio" value="1" checked
                                                                name="is_employement_experience_required"
                                                                onclick="show_div_experience(1)">
                                                        @else
                                                            <input type="radio" value="1"
                                                                name="is_employement_experience_required"
                                                                onclick="show_div_experience(1)">
                                                        @endif


                                                        &nbsp;&nbsp;
                                                        {!! trans('employer.No') !!}

                                                        @if ($detail->is_employement_experience_required != 1)
                                                            <input type="radio" value="0" checked
                                                                name="is_employement_experience_required"
                                                                onclick="show_div_experience(0)">
                                                        @else
                                                            <input type="radio" value="0"
                                                                name="is_employement_experience_required"
                                                                onclick="show_div_experience(0)">
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="div_experience" id="div_experience">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.months_experience') !!}</label>
                                                            <input type="number" min="1"
                                                                name="months_of_experience_required"
                                                                value="{{ $detail->months_of_experience_required }}"
                                                                class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.indicate_occupation_required') !!}</label>
                                                            <select name="occupation_experience_id"
                                                                class="form-control select2">
                                                                @foreach ($job_titles as $obj)
                                                                    @if ($detail->occupation_experience_id == $obj->id)
                                                                        <option value="{{ $obj->id }}" selected>
                                                                            {{ $obj->title }}
                                                                        </option>
                                                                    @else
                                                                        <option value="{{ $obj->id }}">
                                                                            {{ $obj->title }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{!! trans('job_application.other_requirements') !!}</label>
                                                        <br>
                                                        {!! trans('employer.Yes') !!}

                                                        @if ($detail->has_special_skills_required == 1)
                                                            <input type="radio" value="1" checked
                                                                name="has_special_skills_required"
                                                                onclick="show_div_skill(1);">
                                                        @else
                                                            <input type="radio" value="1"
                                                                name="has_special_skills_required"
                                                                onclick="show_div_skill(1);">
                                                        @endif


                                                        &nbsp;&nbsp;
                                                        {!! trans('employer.No') !!}
                                                        @if ($detail->has_special_skills_required != 1)
                                                            <input type="radio" value="0"
                                                                name="has_special_skills_required" checked
                                                                onclick="show_div_skill(0);">
                                                        @else
                                                            <input type="radio" value="0"
                                                                name="has_special_skills_required"
                                                                onclick="show_div_skill(0);">
                                                        @endif

                                                    </div>
                                                </div>

                                                <div class="div_skill" id="div_skill">
                                                    <div class="form-group">

                                                        @if ($special_skills->count() > 0)
                                                            @foreach ($special_skills as $obj)
                                                                @php($var_skill = 'special_skills_' . $obj->special_skill_id)
                                                                {{ $obj->special_skill->name }}
                                                                <input type="text" name="{{ $var_skill }}"
                                                                    value="{{ $obj->detail }}" class="form-control">
                                                                <br>
                                                            @endforeach
                                                        @else
                                                            @foreach ($skills as $obj)
                                                                @php($var_skill = 'special_skills_' . $obj->id)
                                                                {{ $obj->name }}
                                                                <input type="text" name="{{ $var_skill }}"
                                                                    class="form-control">
                                                                <br>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <center>
                                                        <a href="{{ url('job_request') }}/{{ $job_request->id }}/edit">
                                                            <button type="button" class="btn btn-danger btn-rounded"
                                                                style="background-color: #F77883">&nbsp;&nbsp;&nbsp;Back&nbsp;&nbsp;&nbsp;</button>
                                                        </a>
                                                        &nbsp;&nbsp;
                                                        <button type="submit" class="btn btn-primary btn-rounded"
                                                            style="background-color: #2763FF">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</button>
                                                        <center>

                                                </div>

                                                <!-- <div class="modal-footer">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <button type="button" class="btn btn-danger"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        data-dismiss="modal">Close</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <button type="submit" class="btn btn-primary">Save
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        changes</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>-->


                                            </form>
                                        </div>

                                    </div>

                                    <br>

                                    <div class="col-md-12 row">
                                        <div class="col-md-12">
                                            <div class="form-group" align='center'>
                                                <button class="btn btn-primary btn-rounded"
                                                    style="background-color: #2763FF"
                                                    onclick="modal_add_english_level()">&nbsp;&nbsp;&nbsp;Add English level
                                                    to Position&nbsp;&nbsp;&nbsp;</button>

                                            </div>
                                        </div>



                                        <!-- modal add english level -->
                                        <div class="modal fade" id="modal-add-english-level" tabindex="-1"
                                            role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Engish Level</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ url('job_request_detail/english_levels') }}"
                                                        method="POST">
                                                        @csrf

                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h5>Add english level</h5>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <input type="hidden" id="id_detail"
                                                                        name="request_detail_id" id="request_detail_id"
                                                                        value="{{ $detail->id }}">

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>English Level</label>
                                                                        <select class="form-control "
                                                                            name="catalog_english_level_id"
                                                                            id="catalog_english_level_id">
                                                                            <option value="">Select</option>
                                                                            @foreach ($english_levels as $obj)
                                                                                <option value="{{ $obj->id }}">
                                                                                    {{ $obj->description_level_en }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Quantity</label>

                                                                        <input type="number" name="number_of_workers"
                                                                            min="1"
                                                                            max="{{ $detail->number_workers - $total_workers }}"
                                                                            id="number_of_workers" class="form-control">

                                                                    </div>
                                                                </div>
                                                            </div>



                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger btn-rounded"
                                                                style="background-color: #F77883"
                                                                data-dismiss="modal">&nbsp;&nbsp;&nbsp;Close&nbsp;&nbsp;&nbsp;</button>
                                                            <button type="submit" class="btn btn-primary btn-rounded"
                                                                style="background-color: #2763FF">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal add english level -->
                                    </div>


                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Position</th>
                                                        <th>Workers</th>
                                                        <th>English Level</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($positions as $position)
                                                        <tr>
                                                            <td>{{ $position->request_detail->position->title }}</td>
                                                            <td>{{ $position->number_of_workers }}</td>
                                                            <td>

                                                                @if ($position->english_level->id == '1')
                                                                    <span class="badge badge-danger"
                                                                        style="background-color: #F77883">{{ $position->english_level->description_level_en }}</span>
                                                                @elseif ($position->english_level->id == '2')
                                                                    <span class="badge badge-primary"
                                                                        style="background-color: #2763FF">{{ $position->english_level->description_level_en }}</span>
                                                                @elseif ($position->english_level->id == '3')
                                                                    <span
                                                                        class="badge badge-success">{{ $position->english_level->description_level_en }}</span>
                                                                @elseif ($position->english_level->id == '4')
                                                                    <span
                                                                        class="badge badge-info">{{ $position->english_level->description_level_en }}</span>
                                                                @endif


                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                </div>
                                <div class="tab-pane fade" id="tab4">
                                    <div class="pt-4">


                                        <div class="col-md-12">&nbsp;</div>
                                        <div class="col-md-12 row">
                                            <div class="col-md-2">&nbsp;</div>

                                            <div class="col-md-8">
                                                <p><strong>{!! trans('job_application.specify_alternative_requirements') !!}</strong></p>
                                                <form
                                                    action="{{ url('job_request_detail/job_requirements_alternative') }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $detail->id }}">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.alternate_education') !!}</label>
                                                            <br>&nbsp;
                                                            {!! trans('employer.Yes') !!}
                                                            @if ($detail->alternate_experience_accepted == 1)
                                                                <input type="radio" value="1" checked
                                                                    name="alternate_experience_accepted"
                                                                    onclick="show_div_alternative_job(1);">
                                                            @else
                                                                <input type="radio" value="1"
                                                                    name="alternate_experience_accepted"
                                                                    onclick="show_div_alternative_job(1);">
                                                            @endif

                                                            &nbsp;&nbsp;
                                                            {!! trans('employer.No') !!}

                                                            @if ($detail->alternate_experience_accepted != 1)
                                                                <input type="radio" value="0" checked
                                                                    name="alternate_experience_accepted"
                                                                    onclick="show_div_alternative_job(0);">
                                                            @else
                                                                <input type="radio" value="0"
                                                                    name="alternate_experience_accepted"
                                                                    onclick="show_div_alternative_job(0);">
                                                            @endif

                                                        </div>


                                                        <div class="div_alternative_job" id="div_alternative_job">
                                                            <p><strong>{!! trans('job_application.ifc1') !!}</strong></p>

                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.alternate_level_education') !!}</label>
                                                                <select name="alternate_education_level_id"
                                                                    onchange="show_div_diploma_degree2(this.value);"
                                                                    class="form-control">
                                                                    @foreach ($degree_codes as $obj)
                                                                        <option value="{{ $obj->id }}">
                                                                            {{ $obj->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="div_diploma_degree2" id="div_diploma_degree2">
                                                                <div class="col-md-12">

                                                                    <div class="form-group">
                                                                        <label
                                                                            for="exampleInputEmail1">{!! trans('job_application.alternate_diploma_degree') !!}</label>
                                                                        <input type="text"
                                                                            name="if_other_specify_degree"
                                                                            value="{{ $detail->if_other_specify_degree }}"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="exampleInputEmail1">{!! trans('job_application.alternate_study_required') !!}</label>
                                                                        <input type="text" name="alternate_major"
                                                                            value="{{ $detail->alternate_major }}"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="exampleInputEmail1">{!! trans('job_application.alternate_training') !!}</label>
                                                                    <br>&nbsp;
                                                                    {!! trans('employer.Yes') !!}
                                                                    @if ($detail->alternate_training_accepted == 1)
                                                                        <input type="radio" value="1" checked
                                                                            name="alternate_training_accepted"
                                                                            onclick="show_div_training2(1)">
                                                                    @else
                                                                        <input type="radio" value="1"
                                                                            name="alternate_training_accepted"
                                                                            onclick="show_div_training2(1)">
                                                                    @endif


                                                                    &nbsp;&nbsp;
                                                                    {!! trans('employer.No') !!}
                                                                    @if ($detail->alternate_training_accepted != 1)
                                                                        <input type="radio" value="0" checked
                                                                            name="alternate_training_accepted"
                                                                            onclick="show_div_training2(0)">
                                                                    @else
                                                                        <input type="radio" value="0"
                                                                            name="alternate_training_accepted"
                                                                            onclick="show_div_training2(0)">
                                                                    @endif

                                                                </div>
                                                            </div>

                                                            <div class="div_training2" id="div_training2">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <br>&nbsp;
                                                                        <label
                                                                            for="exampleInputEmail1">{!! trans('job_application.alternate_specify_number_months') !!}</label>

                                                                        <input type="number" min="1"
                                                                            name="alternate_training_number_months"
                                                                            value="{{ $detail->alternate_training_number_months }}"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="exampleInputEmail1">{!! trans('job_application.alternate_training_required') !!}</label>
                                                                        <input type="text"
                                                                            name="alternate_field_of_training"
                                                                            value="{{ $detail->alternate_field_of_training }}"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>

                                                            </div>





                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="exampleInputEmail1">{!! trans('job_application.alternate_experience_required') !!}</label>
                                                                    <br>&nbsp;
                                                                    {!! trans('employer.Yes') !!}

                                                                    @if ($detail->alternate_employment_exp_required == 1)
                                                                        <input type="radio" value="1" checked
                                                                            name="alternate_employment_exp_required"
                                                                            onclick="show_div_experience2(1)">
                                                                    @else
                                                                        <input type="radio" value="1"
                                                                            name="alternate_employment_exp_required"
                                                                            onclick="show_div_experience2(1)">
                                                                    @endif


                                                                    &nbsp;&nbsp;
                                                                    {!! trans('employer.No') !!}

                                                                    @if ($detail->is_employement_experience_required != 1)
                                                                        <input type="radio" value="0" checked
                                                                            name="alternate_employment_exp_required"
                                                                            onclick="show_div_experience2(0)">
                                                                    @else
                                                                        <input type="radio" value="0"
                                                                            name="alternate_employment_exp_required"
                                                                            onclick="show_div_experience2(0)">
                                                                    @endif

                                                                </div>
                                                            </div>
                                                            <div class="div_experience2" id="div_experience2">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="exampleInputEmail1">{!! trans('job_application.alternate_months_experience') !!}</label>
                                                                        <input type="number" min="1"
                                                                            name="altername_months_number_exp"
                                                                            value="{{ $detail->altername_months_number_exp }}"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>

                                                            </div>





                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="exampleInputEmail1">{!! trans('job_application.alternate_other_requirements') !!}</label>
                                                                    <br>
                                                                    {!! trans('employer.Yes') !!}

                                                                    @if ($detail->alternate_especial_skills_accepted == 1)
                                                                        <input type="radio" value="1" checked
                                                                            name="alternate_especial_skills_accepted"
                                                                            onclick="show_div_skill2(1);">
                                                                    @else
                                                                        <input type="radio" value="1"
                                                                            name="alternate_especial_skills_accepted"
                                                                            onclick="show_div_skill2(1);">
                                                                    @endif


                                                                    &nbsp;&nbsp;
                                                                    {!! trans('employer.No') !!}
                                                                    @if ($detail->alternate_especial_skills_accepted != 1)
                                                                        <input type="radio" value="0"
                                                                            name="alternate_especial_skills_accepted"
                                                                            checked onclick="show_div_skill2(0);">
                                                                    @else
                                                                        <input type="radio" value="0"
                                                                            name="alternate_especial_skills_accepted"
                                                                            onclick="show_div_skill2(0);">
                                                                    @endif

                                                                </div>
                                                            </div>

                                                            <div class="div_skill2" id="div_skill2">
                                                                <div class="form-group">

                                                                    @if ($special_skills_alternative->count() > 0)
                                                                        @foreach ($special_skills_alternative as $obj)
                                                                            @php($var_skill = 'special_skills_' . $obj->special_skill_id)
                                                                            {{ $obj->special_skill->name }}
                                                                            <input type="text"
                                                                                name="{{ $var_skill }}"
                                                                                value="{{ $obj->detail }}"
                                                                                class="form-control">
                                                                            <br>
                                                                        @endforeach
                                                                    @else
                                                                        @foreach ($skills as $obj)
                                                                            @php($var_skill = 'special_skills_' . $obj->id)
                                                                            {{ $obj->name }}
                                                                            <input type="text"
                                                                                name="{{ $var_skill }}"
                                                                                class="form-control">
                                                                            <br>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>



                                                        </div>


                                                        <div class="col-md-12">
                                                            <center>
                                                                <a
                                                                    href="{{ url('job_request') }}/{{ $job_request->id }}/edit">
                                                                    <button type="button"
                                                                        class="btn btn-danger btn-rounded"
                                                                        style="background-color: #F77883">&nbsp;&nbsp;&nbsp;Back&nbsp;&nbsp;&nbsp;</button>
                                                                </a>
                                                                &nbsp;&nbsp;
                                                                <button type="submit" class="btn btn-primary btn-rounded"
                                                                    style="background-color: #2763FF">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</button>
                                                                <center>

                                                        </div>

                                                        <!--<div class="modal-footer">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <button type="button" class="btn btn-danger"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                data-dismiss="modal">Close</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <button type="submit" class="btn btn-primary">Save
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                changes</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>-->
                                                    </div>


                                                </form>
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
    @include('sweetalert::alert')


    <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            var tab_request = '<?php echo $tab_detail; ?>';
            //alert(tab_request);
            switch (tab_request) {
                case '1':
                    $('.nav-tabs a[href="#tab1"]').tab('show');
                    break;
                case '2':
                    $('.nav-tabs a[href="#tab2"]').tab('show');
                    break;
                case '3':
                    $('.nav-tabs a[href="#tab3"]').tab('show');
                    break;
                case '4':
                    $('.nav-tabs a[href="#tab4"]').tab('show');
                    break;
                case '5':
                    $('.nav-tabs a[href="#tab5"]').tab('show');
                    break;
                case '6':
                    $('.nav-tabs a[href="#tab6"]').tab('show');
                    break;
                case '7':
                    $('.nav-tabs a[href="#tab7"]').tab('show');
                    break;
            }


            if (document.getElementById('are_there_additional_shift_times').checked == true)
                show_div_shift_times(1);
            else
                show_div_shift_times(0);

        });


        function modal_add_english_level() {
            $('#modal-add-english-level').modal('show');
        }


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

        function show_div_shift_times(id) {
            if (id == 1) {
                $('#div_shift_times1').show();
                $('#div_shift_times2').show();
            } else {
                $('#div_shift_times1').hide();
                $('#div_shift_times2').hide();
            }
        }

        function show_div_diploma_degree(id) {
            if (id == 7) {
                $('#div_diploma_degree').show();
            } else {
                $('#div_diploma_degree').hide();
            }
        }

        function show_div_has_second_us_degree(id) {
            if (id == 1) {
                $('#div_has_second_us_degree').show();
            } else {
                $('#div_has_second_us_degree').hide();
            }
        }

        function show_div_training(id) {
            if (id == 1) {
                $('#div_training').show();
            } else {
                $('#div_training').hide();
            }
        }

        function show_div_experience(id) {
            if (id == 1) {
                $('#div_experience').show();
            } else {
                $('#div_experience').hide();
            }
        }

        function show_div_skill(id) {
            if (id == 1) {
                $('#div_skill').show();
            } else {
                $('#div_skill').hide();
            }
        }

        function show_div_supervise_others(id) {

            if (id == 1) {
                $('#div_supervise_others').show();
            } else {
                $('#div_supervise_others').hide();
            }
        }


        //alternative job
        function show_div_alternative_job(id) {

            if (id == 1) {
                $('#div_alternative_job').show();
            } else {
                $('#div_alternative_job').hide();
            }
        }

        function show_div_diploma_degree2(id) {

            if (id == 7) {
                $('#div_diploma_degree2').show();
            } else {
                $('#div_diploma_degree2').hide();
            }
        }

        function show_div_training2(id) {
            if (id == 1) {
                $('#div_training2').show();
            } else {
                $('#div_training2').hide();
            }
        }

        function show_div_experience2(id) {
            if (id == 1) {
                $('#div_experience2').show();
            } else {
                $('#div_experience2').hide();
            }
        }

        function show_div_skill2(id) {
            if (id == 1) {
                $('#div_skill2').show();
            } else {
                $('#div_skill2').hide();
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
