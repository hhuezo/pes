@extends ('dashboard')
@section('contenido')
    <link rel="stylesheet" href="{{ asset('job_application/style.css') }}">
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{!! trans('job_application.Title') !!}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('job_request.update', $job_request->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.start_date') !!}</label>
                                    <input type="date" name="start_date"
                                        value="{{ date('Y-m-d', strtotime($job_request->start_date)) }}"
                                        class="form-control">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.end_date') !!}</label>
                                    <input type="date" name="end_date"
                                        value="{{ date('Y-m-d', strtotime($job_request->end_date)) }}" class="form-control">
                                </div>

                            </div>

                            <div class="col-sm-12">{!! trans('job_application.message') !!}</div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.need_workers') !!}</label>
                                    <br>
                                    {!! trans('employer.Yes') !!}
                                    @if ($job_request->need_h2b_workers == 1)
                                        <input type="radio" value="1" checked name="need_h2b_workers">
                                    @else
                                        <input type="radio" value="1" name="need_h2b_workers">
                                    @endif

                                    &nbsp;&nbsp;
                                    {!! trans('employer.No') !!}
                                    @if ($job_request->need_h2b_workers == 0)
                                        <input type="radio" value="0" checked name="need_h2b_workers">
                                    @else
                                        <input type="radio" value="0" name="need_h2b_workers">
                                    @endif

                                    <br>{!! trans('job_application.message2') !!}
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.multiple_employment_period') !!}</label>
                                    <input type="text" name="explain_multiple_employment"
                                        value="{{ $job_request->explain_multiple_employment }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-12" style="text-align: center;">

                                <button type="button" class="btn btn-rounded btn-info btn-lg" data-toggle="modal"
                                    data-target=".bd-example-modal-lg"><strong>Add
                                        position</strong><span class="btn-icon-right">
                                        <i class="fa fa-plus color-info"></i></span>
                                </button>

                            </div>

                            <div class="col-md-12">&nbsp;</div>
                            <div class="col-sm-12" style="text-align: center;">
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
                            </div>
                            <div class="col-sm-12">&nbsp;</div>
                            <div class="col-sm-12">
                                <h4>{!! trans('job_application.EmployeeRights') !!}</h4>
                            </div>
                            <div class="col-sm-12">{!! trans('job_application.message4') !!}</div>
                            <div class="col-sm-12">
                                <h5><input type="checkbox">&nbsp;&nbsp;{!! trans('job_application.Agree') !!}</h5>
                            </div>
                            <div class="col-sm-12">{!! trans('job_application.message5') !!}</div>
                            <div class="col-sm-12">
                                <h5><input type="checkbox">&nbsp;&nbsp;{!! trans('employer.Yes') !!}</h5>
                            </div>
                            <div class="col-sm-12">&nbsp;</div>
                            <div class="col-sm-12">{!! trans('job_application.PleasSign') !!}</div>
                            <div class="col-sm-12">
                                <canvas id="draw-canvas" width="300" height="200">
                                </canvas>
                                <textarea id="draw-dataUrl" name="sign" class="form-control" rows="5"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <input type="button" class="button" id="draw-clearBtn" value="Clear"></input>
                                    <input type="button" class="button" id="draw-submitBtn" value="Crear Imagen"></input>
                                    <input type="color" id="color">
                                    <input type="range" id="puntero" min="1" default="1" max="5"
                                        width="10%">
                                </div>
                            </div>

                            <div class="col-md-12">&nbsp;</div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.printed_name') !!}</label>
                                    <div class="col-md-6">
                                        <input type="text" id="printed_name" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{!! trans('job_application.Position') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{!! trans('job_application.Position') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{ url('job_request_detail') }}" method="POST" class="forms-sample">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="job_request_id" value="{{ $job_request->id }}">
                                            <label for="exampleInputEmail1">{!! trans('job_application.job_title') !!}</label>
                                            <select class="form-control select2" name="job_title">
                                                @foreach ($job_titles as $obj)
                                                    <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.Number_of_Workers') !!}</label>
                                            <input type="number" name="number_workers" class="form-control"
                                                min="1">
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
                                        <label for="exampleInputEmail1">{!! trans('job_application.workers_paid_position') !!}</label>
                                        <select class="form-control" name="how_paid">
                                            <option value="1">Hourly</option>
                                            <option value="2">Hourly + Tips</option>
                                            <option value="3">Piece rate</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.PayRate') !!}</label>
                                        <input type="number" name="pay_rate" class="form-control" step="0.01"
                                            min="1" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.tip_credit') !!}</label>
                                        <br>
                                        {!! trans('employer.Yes') !!}

                                        <input type="radio" value="1" checked name="use_tip_credit">

                                        &nbsp;&nbsp;
                                        {!! trans('employer.No') !!}
                                        <input type="radio" value="0" name="use_tip_credit">

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-12 row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.position_eligible') !!}</label>
                                        <br>
                                        {!! trans('employer.Yes') !!}

                                        <input type="radio" value="1" name="is_there_benefits"
                                            id="is_there_benefits">

                                        &nbsp;&nbsp;
                                        {!! trans('employer.No') !!}
                                        <input type="radio" value="0" checked name="is_there_benefits"
                                            id="is_there_benefits2">

                                    </div>
                                </div>
                                <div class="col-md-6" id="div_explain_benefits">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.explain_bonus') !!}</label>
                                        <input type="text" name="explain_benefits" class="form-control">
                                    </div>
                                </div>


                            </div>


                            <div class="col-md-12 row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.SpecialRequirements') !!}</label>
                                        <br>
                                        {!! trans('employer.Yes') !!}

                                        <input type="radio" value="1" name="are_there_any_requeriments"
                                            id="are_there_any_requeriments">

                                        &nbsp;&nbsp;
                                        {!! trans('employer.No') !!}
                                        <input type="radio" value="0" checked name="are_there_any_requeriments"
                                            id="are_there_any_requeriments2">
                                        <br>{!! trans('job_application.lift50lbs') !!}
                                    </div>

                                </div>
                                <div class="col-md-6" id="div_requeriments">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.special_requirements_position') !!}</label>
                                        <input type="text" name="requeriments" class="form-control" min="1">
                                    </div>

                                </div>


                            </div>


                            <div class="col-md-12 row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.additional_notes') !!}</label>
                                        <input type="text" name="any_additional_wage_notes" class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.IsOvertimeAvailable') !!}</label>
                                        <select name="is_overtime_available" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                            <option value="3">Only as Approved by Management</option>
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
                                        <label for="exampleInputEmail1">{!! trans('job_application.Sunday') !!}</label>
                                        <input type="number" name="ant_workday_sun_hour" id="ant_workday_sun_hour"
                                            class="form-control" step="1" max="24" min="1">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.Monday') !!}</label>
                                        <input type="number" name="ant_workday_mon_hour" id="ant_workday_mon_hour"
                                            class="form-control" step="1" max="24" min="1">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.Tuesday') !!}</label>
                                        <input type="number" name="ant_workday_tue_hour" id="ant_workday_tue_hour"
                                            class="form-control" step="1" max="24" min="1">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.Wednesday') !!}</label>
                                        <input type="number" name="ant_workday_wed_hour" id="ant_workday_wed_hour"
                                            class="form-control" step="1" max="24" min="1">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.Thursday') !!}</label>
                                        <input type="number" name="ant_workday_thu_hour" id="ant_workday_thu_hour"
                                            class="form-control" step="1" max="24" min="1">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.Friday') !!}</label>
                                        <input type="number" name="ant_workday_fri_hour" id="ant_workday_fri_hour"
                                            class="form-control" step="1" max="24" min="1">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.Saturday') !!}</label>
                                        <input type="number" name="ant_workday_sat_hour" id="ant_workday_sat_hour"
                                            class="form-control" step="1" max="24" min="1">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><strong>{!! trans('job_application.total_hours') !!}</strong></label>
                                        <input type="number" readonly name="ant_workday_total_hours"
                                            id="ant_workday_total_hours" class="form-control" step="1"
                                            min="1" required>
                                    </div>
                                    {!! trans('job_application.reminder') !!}
                                </div>
                            </div>
                            <div class="col-md-12 row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.time_this_position') !!}</label>
                                        <input type="text" name="primary_shift_time" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.shift_times_position') !!}</label>
                                        <br>
                                        {!! trans('employer.Yes') !!}

                                        <input type="radio" value="1" name="are_there_additional_shift_times"
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @include('sweetalert::alert')















    <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            //   hide_div_explain_benefits();
            //hide_div_requeriments();

            $('#draw-submitBtn').hide();
            $('#color').hide();
            $('#puntero').hide();
            $('#draw-dataUrl').hide();
        });


        function modal_delete(id) {
            document.getElementById('id_detail').value = id;
            $('#modal-delete').modal('show');
        }

        //captura de firma
        $("#draw-canvas").click(function() {
            $('#draw-submitBtn').click();
        });


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

        $("#ant_workday_sun_hour").change(function() {
            total_horas();
        })

        $("#ant_workday_mon_hour").change(function() {
            total_horas();
        })

        $("#ant_workday_tue_hour").change(function() {
            total_horas();
        })

        $("#ant_workday_wed_hour").change(function() {
            total_horas();
        })

        $("#ant_workday_thu_hour").change(function() {
            total_horas();
        })

        $("#ant_workday_fri_hour").change(function() {
            total_horas();
        })

        $("#ant_workday_sat_hour").change(function() {
            total_horas();
        })
    </script>

    <script src="{{ asset('job_application/sign.js') }}"></script>
@endsection
