@extends ('dashboard')
@section('contenido')
    <link rel="stylesheet" href="{{ asset('job_application/style.css') }}">


    <div class="row">


        <div class="card col-md-12">
            <div class="card-header">
                <h4 class="card-title">Default Tab</h4>
            </div>
            <div class="card-body">
                <!-- Nav tabs -->
                <div class="default-tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab1">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab2">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab3">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab4">Message</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab5">tab5</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="tab1" role="tabpanel">
                            <form method="POST" action="{{ route('job_request.update', $job_request->id) }}">
                                @method('PUT')
                                @csrf


                                <div class="col-xl-12 col-xxl-12 row">
                                    <div class="col-sm-12">&nbsp;</div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">{!! trans('job_application.start_date') !!}</label>
                                            <input type="date" name="start_date" value="{{ $job_request->start_date }}"
                                                required class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.end_date') !!}</label>
                                            <input type="date" name="end_date" value="{{ $job_request->end_date }}"
                                                required class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">{!! trans('job_application.message') !!}</div>

                                    <div class="col-sm-12">&nbsp;</div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.need_workers') !!}</label>
                                            <br>
                                            {!! trans('job_application.Yes') !!}
                                            @if ($job_request->need_h2b_workers == 1)
                                                <input type="radio" checked value="1" id="need_h2b_workers_yes"
                                                    onclick="show_multiple_employment_period();" name="need_h2b_workers">
                                            @else
                                                <input type="radio" value="1" id="need_h2b_workers_yes"
                                                    onclick="show_multiple_employment_period();" name="need_h2b_workers">
                                            @endif
                                            &nbsp;&nbsp;
                                            {!! trans('job_application.No') !!}
                                            @if ($job_request->need_h2b_workers == 0)
                                                <input type="radio" value="0" checked
                                                    onclick="show_multiple_employment_period();" name="need_h2b_workers">
                                            @else
                                                <input type="radio" value="0"
                                                    onclick="show_multiple_employment_period();" name="need_h2b_workers">
                                            @endif
                                            <br>

                                            {!! trans('job_application.message2') !!}


                                        </div>
                                    </div>

                                    <div class="col-md-6" id="div_multiple_employment_period">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.multiple_employment_period') !!}</label>
                                            <input type="text" name="explain_multiple_employment"
                                                value="{{ $job_request->explain_multiple_employment }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">&nbsp;</div>

                                    <!-- paid -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.workers_paid') !!}</label>
                                            <br>
                                            {!! trans('job_application.Weekly') !!}
                                            @if ($job_request->paid == 1)
                                                <input type="radio" value="1" checked name="workers_paid">
                                            @else
                                                <input type="radio" value="1" name="workers_paid">
                                            @endif
                                            &nbsp;&nbsp;
                                            {!! trans('job_application.Bi-weekly') !!}
                                            @if ($job_request->paid == 2)
                                                <input type="radio" value="2" checked name="workers_paid">
                                            @else
                                                <input type="radio" value="2" name="workers_paid">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.uniform') !!}</label>
                                            <br>
                                            {!! trans('job_application.Yes') !!}
                                            @if ($job_request->is_uniform_required == 1)
                                                <input type="radio" value="1" checked name="is_uniform_required"
                                                    id="is_uniform_required" onclick="show_div_uniform();">
                                            @else
                                                <input type="radio" value="1" name="is_uniform_required"
                                                    id="is_uniform_required" onclick="show_div_uniform();">
                                            @endif
                                            &nbsp;&nbsp;
                                            {!! trans('job_application.No') !!}
                                            @if ($job_request->is_uniform_required == 0)
                                                <input type="radio" value="0" checked name="is_uniform_required"
                                                    onclick="show_div_uniform();">
                                            @else
                                                <input type="radio" value="0" name="is_uniform_required"
                                                    onclick="show_div_uniform();">
                                            @endif
                                        </div>
                                        <label for="exampleInputEmail1">{!! trans('job_application.message3') !!}</label>
                                    </div>

                                    <div class="col-md-6" id="div_uniform">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.uniform_pieces') !!}</label>
                                            <input type="text" name="uniform_pieces_required"
                                                value="{{ $job_request->uniform_pieces_required }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                                            <input type="text" name="job_notes" value="{{ $job_request->job_notes }}"
                                                class="form-control">
                                        </div>
                                        <label for="exampleInputEmail1">{!! trans('job_application.additional_space') !!}</label>
                                    </div>





                                    <div class="col-sm-12 form-group">
                                        <button type="submit" class="btn btn-primary float-right">Next</button>
                                    </div>

                                </div>

                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab2">
                            <div class="col-md-12">&nbsp;</div>
                            <div class="col-sm-12 form-group">
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                    data-target=".bd-example-modal-lg">Add Position</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>Job Title</th>
                                            <th>Number of Workers</th>
                                            <th>{!! trans('job_application.total_hours') !!}</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details as $obj)
                                            <tr>
                                                <td>{{ $obj->title->name }}</td>
                                                <td>{{ $obj->number_workers }}</td>
                                                <td>{{ $obj->ant_workday_total_hours }}</td>
                                                <td align="center">
                                                    &nbsp;&nbsp;
                                                    <i class="fa fa-trash fa-lg"
                                                        onclick="modal_delete({{ $obj->id }})"></i>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>



                            <!-- modal add detail -->
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{!! trans('job_application.Position') !!}</h5>
                                            <button type="button" class="close"
                                                data-dismiss="modal"><span>&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ url('job_request_detail') }}" method="POST"
                                            class="forms-sample">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="job_request_id"
                                                                        value="{{ $job_request->id }}">
                                                                    <label
                                                                        for="exampleInputEmail1">{!! trans('job_application.job_title') !!}</label>
                                                                    <select class="form-control select2" name="job_title">
                                                                        @foreach ($job_titles as $obj)
                                                                            <option value="{{ $obj->id }}">
                                                                                {{ $obj->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="exampleInputEmail1">{!! trans('job_application.Number_of_Workers') !!}</label>
                                                                    <input type="number" name="number_workers"
                                                                        class="form-control" min="1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="checkbox" name="it_has_cba">&nbsp;&nbsp;<label
                                                                for="exampleInputEmail1">{!! trans('job_application.CollectiveBargaining') !!}</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.workers_paid_position') !!}</label>
                                                                <select class="form-control" name="how_paid">
                                                                    <option value="1">Hourly</option>
                                                                    <option value="2">Hourly + Tips</option>
                                                                    <option value="3">Piece rate</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.PayRate') !!}</label>
                                                                <input type="number" name="pay_rate"
                                                                    class="form-control" step="0.01" min="1"
                                                                    required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.tip_credit') !!}</label>
                                                                <br>
                                                                {!! trans('employer.Yes') !!}

                                                                <input type="radio" value="1" checked
                                                                    name="use_tip_credit">

                                                                &nbsp;&nbsp;
                                                                {!! trans('employer.No') !!}
                                                                <input type="radio" value="0"
                                                                    name="use_tip_credit">

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="col-md-12 row">

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.position_eligible') !!}</label>
                                                                <br>
                                                                {!! trans('employer.Yes') !!}

                                                                <input type="radio" value="1"
                                                                    name="is_there_benefits" id="is_there_benefits"
                                                                    onclick="show_div_explain_benefits()">

                                                                &nbsp;&nbsp;
                                                                {!! trans('employer.No') !!}
                                                                <input type="radio" value="0" checked
                                                                    name="is_there_benefits"
                                                                    onclick="show_div_explain_benefits()">

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6" id="div_explain_benefits">
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.explain_bonus') !!}</label>
                                                                <input type="text" name="explain_benefits"
                                                                    class="form-control">
                                                            </div>
                                                        </div>


                                                    </div>


                                                    <div class="col-md-12 row">

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.SpecialRequirements') !!}</label>
                                                                <br>
                                                                {!! trans('employer.Yes') !!}

                                                                <input type="radio" value="1"
                                                                    name="are_there_any_requeriments"
                                                                    id="are_there_any_requeriments"
                                                                    onclick="show_div_requeriments();">

                                                                &nbsp;&nbsp;
                                                                {!! trans('employer.No') !!}
                                                                <input type="radio" value="0" checked
                                                                    name="are_there_any_requeriments"
                                                                    onclick="show_div_requeriments();">
                                                                <br>{!! trans('job_application.lift50lbs') !!}
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6" id="div_requeriments">
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.special_requirements_position') !!}</label>
                                                                <input type="text" name="requeriments"
                                                                    class="form-control" min="1">
                                                            </div>

                                                        </div>


                                                    </div>


                                                    <div class="col-md-12 row">
                                                        <div class="col-md-6">

                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.additional_notes') !!}</label>
                                                                <input type="text" name="any_additional_wage_notes"
                                                                    class="form-control">
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.IsOvertimeAvailable') !!}</label>
                                                                <select name="is_overtime_available" class="form-control">
                                                                    <option value="1">Yes</option>
                                                                    <option value="2">No</option>
                                                                    <option value="3">Only as Approved by Management
                                                                    </option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        {!! trans('job_application.anticipated_number_hours') !!}
                                                    </div>

                                                    <div class="col-md-12 row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.Sunday') !!}</label>
                                                                <input type="number" name="ant_workday_sun_hour"
                                                                    id="ant_workday_sun_hour" onclick="total_horas();"
                                                                    class="form-control" step="1" max="24"
                                                                    min="1">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.Monday') !!}</label>
                                                                <input type="number" name="ant_workday_mon_hour"
                                                                    id="ant_workday_mon_hour" onchange="total_horas();"
                                                                    class="form-control" step="1" max="24"
                                                                    min="1">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.Tuesday') !!}</label>
                                                                <input type="number" name="ant_workday_tue_hour"
                                                                    id="ant_workday_tue_hour" onchange="total_horas();"
                                                                    class="form-control" step="1" max="24"
                                                                    min="1">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.Wednesday') !!}</label>
                                                                <input type="number" name="ant_workday_wed_hour"
                                                                    id="ant_workday_wed_hour" onchange="total_horas();"
                                                                    class="form-control" step="1" max="24"
                                                                    min="1">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.Thursday') !!}</label>
                                                                <input type="number" name="ant_workday_thu_hour"
                                                                    id="ant_workday_thu_hour" onchange="total_horas();"
                                                                    class="form-control" step="1" max="24"
                                                                    min="1">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.Friday') !!}</label>
                                                                <input type="number" name="ant_workday_fri_hour"
                                                                    id="ant_workday_fri_hour" onchange="total_horas();"
                                                                    class="form-control" step="1" max="24"
                                                                    min="1">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.Saturday') !!}</label>
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
                                                                    id="ant_workday_total_hours" class="form-control"
                                                                    min="35" max="55">
                                                            </div>
                                                            {!! trans('job_application.reminder') !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.time_this_position') !!}</label>
                                                                <input type="text" name="primary_shift_time"
                                                                    class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label
                                                                    for="exampleInputEmail1">{!! trans('job_application.shift_times_position') !!}</label>
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
                                                    </div>

                                                </div>








                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end add modal -->


                            <!-- modal delete detail -->
                            <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{!! trans('job_application.Position') !!}</h5>
                                            <button type="button" class="close"
                                                data-dismiss="modal"><span>&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ url('job_request_detail/delete') }}">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="hidden" id="id_detail" name="id">
                                                        <h5>Do you want to delete the record?</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end delete modal -->

                        </div>
                        <div class="tab-pane fade" id="tab3">

                            <div class="col-xl-12 col-xxl-12 row">
                                <div class="col-sm-12">&nbsp;</div>
                                <div class="col-md-12">
                                    <h3>{!! trans('job_application.tab3_title') !!}</h3>
                                    <p>{!! trans('job_application.tab3_title2') !!}</p>
                                    <h5>{!! trans('job_application.tab3_title3') !!}</h5>
                                    <div class="form-group">
                                        <input type="hidden" id="request_id" value="{{ $job_request->id }}">
                                        <label for="exampleInputUsername1">{!! trans('job_application.select_deductions') !!}</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="checkbox" id="Housing" name="Housing"
                                                    onclick="get_div_tab3();"> <label
                                                    for="exampleInputUsername1">{!! trans('job_application.Housing') !!}</label><br>
                                                <input type="checkbox" id="Medical" name="Medical"
                                                    onclick="get_div_tab3();"> <label
                                                    for="exampleInputUsername1">{!! trans('job_application.Medical') !!}</label><br>
                                                <input type="checkbox" id="DailyTransportation"name="DailyTransportation"
                                                    onclick="get_div_tab3();"> <label
                                                    for="exampleInputUsername1">{!! trans('job_application.DailyTransportation') !!}</label>
                                            </div>

                                            <div class="col-md-6">
                                                <input type="checkbox" id="Other" name="Other"
                                                    onclick="get_div_tab3();"> <label
                                                    for="exampleInputUsername1">{!! trans('job_application.Other') !!}</label><br>
                                                <input type="checkbox" id="Meals" name="Meals"
                                                    onclick="get_div_tab3();"> <label
                                                    for="exampleInputUsername1">{!! trans('job_application.Meals') !!}</label><br>
                                                <input type="checkbox" id="NoDeductions" name="NoDeductions"
                                                    onclick="get_div_tab3();"> <label
                                                    for="exampleInputUsername1">{!! trans('job_application.NoDeductions') !!}</label>
                                            </div>

                                            <div class="col-sm-12">&nbsp;</div>
                                            <div class="col-sm-12">&nbsp;</div>

                                            <div id="content" class="col-sm-12 row">

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="tab4">

                            <h3>JOB REQUIREMENTS / CONDITIONS OF EMPLOYMENT</h3>
                            <p>Background checks, drug testing and/or other job requirements and conditions of employment must not favor either U.S. or H-2B workers, they must be applied on an equal basis for all employees.</p>
                            <h5>All job requirements and conditions of employment must be disclosed in the Job Order. </h5>
                            <h5>{!! trans('job_application.BackgroundChecks') !!} </h5>

                            <div class="col-xl-12 col-xxl-12">
                                <div class="col-sm-12">&nbsp;</div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.IsBackgroundChecks') !!}</label>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;{!! trans('job_application.Yes') !!}
                                        @if ($job_request->is_uniform_required == 1)
                                            <input type="radio" value="1" checked name="is_uniform_required">
                                        @else
                                            <input type="radio" value="1" name="is_uniform_required">
                                        @endif
                                        &nbsp;&nbsp;
                                        {!! trans('job_application.No') !!}
                                        @if ($job_request->is_uniform_required == 0)
                                            <input type="radio" value="0" checked >
                                        @else
                                            <input type="radio" value="0" >
                                        @endif
                                        <br>
                                        <label for="exampleInputEmail1">{!! trans('job_application.AppliesAllApplicants') !!}</label>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.CheckCriminalHistory') !!}</label>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;{!! trans('job_application.Yes') !!}
                                        @if ($job_request->is_uniform_required == 1)
                                            <input type="radio" value="1" checked name="is_uniform_required">
                                        @else
                                            <input type="radio" value="1" name="is_uniform_required">
                                        @endif
                                        &nbsp;&nbsp;
                                        {!! trans('job_application.No') !!}
                                        @if ($job_request->is_uniform_required == 0)
                                            <input type="radio" value="0" checked >
                                        @else
                                            <input type="radio" value="0" >
                                        @endif
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.BackgroundChecksConducted') !!}</label>
                                        <br>
                                        &nbsp;&nbsp;
                                        <input type="checkbox">&nbsp;&nbsp;
                                        {!! trans('job_application.Pre-employment') !!}

                                        &nbsp;&nbsp;
                                        <input type="checkbox">&nbsp;&nbsp;
                                        {!! trans('job_application.Post-employment') !!}

                                        &nbsp;&nbsp;
                                        <input type="checkbox">&nbsp;&nbsp;
                                        {!! trans('job_application.Other') !!}

                                        <br>
                                        <label for="exampleInputEmail1">{!! trans('job_application.SelectApply') !!}</label>
                                    </div>

                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.DrugTesting') !!}</label>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;{!! trans('job_application.Yes') !!}
                                        @if ($job_request->is_uniform_required == 1)
                                            <input type="radio" value="1" checked name="is_uniform_required">
                                        @else
                                            <input type="radio" value="1" name="is_uniform_required">
                                        @endif
                                        &nbsp;&nbsp;
                                        {!! trans('job_application.No') !!}
                                        @if ($job_request->is_uniform_required == 0)
                                            <input type="radio" value="0" checked >
                                        @else
                                            <input type="radio" value="0" >
                                        @endif
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.DrugTestingConducted') !!}</label>
                                        <br>
                                        &nbsp;&nbsp;
                                        <input type="checkbox">&nbsp;&nbsp;
                                        {!! trans('job_application.Pre-employment') !!}

                                        &nbsp;&nbsp;
                                        <input type="checkbox">&nbsp;&nbsp;
                                        {!! trans('job_application.Post-employment') !!}

                                        &nbsp;&nbsp;
                                        <input type="checkbox">&nbsp;&nbsp;
                                        {!! trans('job_application.PostInjury') !!}


                                        &nbsp;&nbsp;
                                        <input type="checkbox">&nbsp;&nbsp;
                                        {!! trans('job_application.Other') !!}
                                        <br>
                                        <label for="exampleInputEmail1">{!! trans('job_application.SelectApply') !!}</label>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.JobRequirements') !!}</label>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;{!! trans('job_application.Yes') !!}
                                        @if ($job_request->is_uniform_required == 1)
                                            <input type="radio" value="1" checked name="is_uniform_required">
                                        @else
                                            <input type="radio" value="1" name="is_uniform_required">
                                        @endif
                                        &nbsp;&nbsp;
                                        {!! trans('job_application.No') !!}
                                        @if ($job_request->is_uniform_required == 0)
                                            <input type="radio" value="0" checked >
                                        @else
                                            <input type="radio" value="0" >
                                        @endif
                                        <br>
                                        {!! trans('job_application.AppliesUS') !!}
                                    </div>

                                </div>


                            </div>






                            <div class="col-sm-12">&nbsp;</div>

                            <h3>{!! trans('job_application.Transportation&Daily') !!}</h3>
                            <h5>{!! trans('job_application.InboundTransportation') !!}</h5>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><strong>{!! trans('job_application.PleaseTransportation') !!}</strong></label>
                                    <br>
                                    <input type="radio">  &nbsp;&nbsp;Arrange and pay directly for transportation and subsistence (recommended)
                                    <br>
                                    <input type="radio">  &nbsp;&nbsp;Reimburse the worker for transportation and subsistence
                                    <br>
                                    <input type="radio">  &nbsp;&nbsp;Provide advance payment (to the worker) for transportation and subsistence
                                    <br>
                                </div>

                            </div>
                            <p>{!! trans('job_application.message6') !!}</p>
                        </div>

                        <div class="tab-pane fade  show active" id="tab5">
                            <div class="col-xl-12 col-xxl-12 row">
                                <div class="col-sm-12">&nbsp;</div>
                                <div class="col-sm-12">
                                    <h3>{!! trans('job_application.USWorker') !!}</h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">{!! trans('job_application.StateWorkforce') !!}</label>
                                        <input type="date" name="start_date" value="{{ $job_request->start_date }}"
                                            required class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.end_date') !!}</label>
                                        <input type="date" name="end_date" value="{{ $job_request->end_date }}"
                                            required class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">{!! trans('job_application.start_date') !!}</label>
                                        <input type="date" name="start_date" value="{{ $job_request->start_date }}"
                                            required class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.end_date') !!}</label>
                                        <input type="date" name="end_date" value="{{ $job_request->end_date }}"
                                            required class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">{!! trans('job_application.start_date') !!}</label>
                                        <input type="date" name="start_date" value="{{ $job_request->start_date }}"
                                            required class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-12">&nbsp;</div>



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
                show_multiple_employment_period();
                show_div_uniform();

                show_div_explain_benefits();
                show_div_requeriments();





            });

            function show_multiple_employment_period() {
                if (document.getElementById('need_h2b_workers_yes').checked == true) {
                    $('#div_multiple_employment_period').show();
                } else {
                    $('#div_multiple_employment_period').hide();
                }
            }

            function show_div_uniform() {
                if (document.getElementById('is_uniform_required').checked == true) {
                    $('#div_uniform').show();
                } else {
                    $('#div_uniform').hide();
                }
            }



            function show_div_explain_benefits() {
                if (document.getElementById('is_there_benefits').checked == true) {
                    $('#div_explain_benefits').show();
                } else {
                    $('#div_explain_benefits').hide();
                }
            }

            function show_div_requeriments() {
                if (document.getElementById('are_there_any_requeriments').checked == true) {
                    $('#div_requeriments').show();
                } else {
                    $('#div_requeriments').hide();
                }
            }
        </script>




        <script>
            function modal_delete(id) {
                document.getElementById('id_detail').value = id;
                $('#modal-delete').modal('show');
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

        <script>
            function get_div_deductions_medical() {
                var ChkMedical = 0;
                var ChkDental = 0;
                var ChkVision = 0;
                var ChkOther = 0;

                if (document.getElementById('ChkMedical').checked == true) {
                    var ChkMedical = 1;
                }
                if (document.getElementById('ChkDental').checked == true) {
                    var ChkDental = 1;
                }
                if (document.getElementById('ChkVision').checked == true) {
                    var ChkVision = 1;
                }
                if (document.getElementById('ChkOther').checked == true) {
                    var ChkOther = 1;
                }


                var parametros = {
                    "ChkMedical": ChkMedical,
                    "ChkDental": ChkDental,
                    "ChkVision": ChkVision,
                    "ChkOther": ChkOther,
                };
                $.ajax({
                    type: "get",
                    url: "{{ url('job_request/get_div_deductions_medical') }}",
                    data: parametros,
                    success: function(data) {
                        console.log(data);
                        $('#div_deductions').html(data);
                    }
                })


            }

            function get_div_tab3() {
                var Housing = 0;
                var Medical = 0;
                var DailyTransportation = 0;
                var Other = 0;
                var Meals = 0;
                var NoDeductions = 0;

                if (document.getElementById('Housing').checked == true) {
                    var Housing = 1;
                }

                if (document.getElementById('Medical').checked == true) {
                    var Medical = 1;
                }

                if (document.getElementById('DailyTransportation').checked == true) {
                    var DailyTransportation = 1;
                }

                if (document.getElementById('Other').checked == true) {
                    var Other = 1;
                }

                if (document.getElementById('Meals').checked == true) {
                    var Meals = 1;
                }

                if (document.getElementById('NoDeductions').checked == true) {
                    var NoDeductions = 1;
                }


                var parametros = {
                    "Housing": Housing,
                    "Medical": Medical,
                    "DailyTransportation": DailyTransportation,
                    "Other": Other,
                    "Meals": Meals,
                    "NoDeductions": NoDeductions,
                    'request_id': document.getElementById('request_id').value,
                };
                $.ajax({
                    type: "get",
                    url: "{{ url('job_request/get_div_deductions') }}",
                    data: parametros,
                    success: function(data) {
                        console.log(data);
                        $('#content').html(data);
                    }
                })
            }
        </script>
    @endsection
