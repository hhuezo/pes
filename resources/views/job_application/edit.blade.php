@extends ('dashboard')
@section('contenido')
    <style>
        .nav-tabs-custom>.tab-content {

            padding: 0px;
        }

        .modal-lg,
        .modal-xl {
            max-width: 70%;
        }
    </style>



    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{!! trans('job_application.Title') !!}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('job_application.update', $job->id) }}">
                        @method('PUT')
                        @csrf

                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.start_date') !!}</label>
                                    <input type="date" name="start_date"
                                        value="{{ date('Y-m-d', strtotime($job->start_date)) }}" class="form-control">
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.end_date') !!}</label>
                                    <input type="date" name="end_date"
                                        value="{{ date('Y-m-d', strtotime($job->end_date)) }}" class="form-control">
                                </div>

                            </div>


                        </div>

                        <div class="col-sm-12">{!! trans('job_application.message') !!}</div>

                        <div class="col-sm-12">&nbsp;</div>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.need_workers') !!}</label>
                                    <br>
                                    {!! trans('employer.Yes') !!}
                                    @if ($job->need_h2b_workers == 1)
                                        <input type="radio" value="1" checked name="need_h2b_workers">
                                    @else
                                        <input type="radio" value="1" name="need_h2b_workers">
                                    @endif

                                    &nbsp;&nbsp;
                                    {!! trans('employer.No') !!}
                                    @if ($job->need_h2b_workers == 0)
                                        <input type="radio" value="0" checked name="need_h2b_workers">
                                    @else
                                        <input type="radio" value="0" name="need_h2b_workers">
                                    @endif

                                    <br>{!! trans('job_application.message2') !!}
                                </div>




                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.workers_paid') !!}</label>
                                    <br>
                                    {!! trans('job_application.Weekly') !!}
                                    @if ($job->paid == 1)
                                        <input type="radio" value="1" checked name="paid">
                                    @else
                                        <input type="radio" value="1" name="paid">
                                    @endif


                                    &nbsp;&nbsp;
                                    {!! trans('job_application.Bi-weekly') !!}
                                    @if ($job->paid == 2)
                                        <input type="radio" value="2" checked name="paid">
                                    @else
                                        <input type="radio" value="2" name="paid">
                                    @endif
                                </div>





                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.uniform_pieces') !!}</label>
                                    <input type="text" name="uniform_pieces_required"
                                        value="{{ $job->uniform_pieces_required }}" class="form-control">
                                </div>



                                {!! trans('job_application.message3') !!}


                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.multiple_employment_period') !!}</label>
                                    <input type="text" name="explain_multiple_employment"
                                        value="{{ $job->explain_multiple_employment }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.uniform') !!}</label>
                                    <br>
                                    {!! trans('employer.Yes') !!}

                                    @if ($job->is_uniform_required == 1)
                                        <input type="radio" value="1" checked name="is_uniform_required">
                                    @else
                                        <input type="radio" value="1" name="is_uniform_required">
                                    @endif

                                    &nbsp;&nbsp;
                                    {!! trans('employer.No') !!}
                                    @if ($job->is_uniform_required == 0)
                                        <input type="radio" value="0" checked name="is_uniform_required">
                                    @else
                                        <input type="radio" value="0" name="is_uniform_required">
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('employer.Notes') !!}</label>
                                    <input type="text" name="job_notes" value="{{ $job->job_notes }}"
                                        class="form-control">
                                    <br>
                                    {!! trans('job_application.additional_space') !!}
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                                </div>

                            </div>

                        </div>











                    </form>
                </div>
            </div>
        </div>
    </div>










    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{!! trans('job_application.Title') !!}</h4>
                    <button type="button" class="btn btn-success float-right" data-toggle="modal"
                        data-target=".bd-example-modal-lg">Add</button>
                </div>
                <div class="card-body">

                    <table id="example1" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>Street Address</th>
                                <th>City address</th>
                                <th>Country address</th>
                                <th>Zip code address</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($job_details as $obj)
                                <tr>
                                    <td>{{ $obj->job_title }}</td>
                                    <td>{{ $obj->job_title }}</td>
                                    <td>{{ $obj->job_title }}</td>

                                    <td>{{ $obj->job_title }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>



    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{!! trans('job_application.Title') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{!! trans('job_application.location_listed_above') !!}</label>
                                <br>
                                {!! trans('employer.Yes') !!}

                                <input type="radio" value="1" name="listed_above">

                                &nbsp;&nbsp;
                                {!! trans('employer.No') !!}
                                <input type="radio" value="0" checked name="listed_above">
                            </div>
                        </div>

                        <div class="col-md-12" id="div_address ">
                            <h4>{!! trans('job_application.job_title') !!}</h4>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.Number_of_Workers') !!}</label>
                                        <input type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.Number_of_Workers') !!}</label>
                                        <input type="number" class="form-control" min="1" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.Number_of_Workers') !!}</label>
                                        <input type="number" class="form-control" min="1" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.Number_of_Workers') !!}</label>
                                        <input type="number" class="form-control" min="1" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.Number_of_Workers') !!}</label>
                                        <input type="number" class="form-control" min="1" >
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="exampleInputEmail1">{!! trans('job_application.job_title') !!}</label>
                                <select class="form-control select2">
                                    @foreach ($job_titles as $obj)
                                        <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                    @endforeach
                                </select>
                            </div>






                            <div class="form-group">
                                <label for="exampleInputEmail1">{!! trans('job_application.SpecialRequirements') !!}</label>
                                <br>
                                {!! trans('employer.Yes') !!}

                                <input type="radio" value="1" name="is_uniform_required">

                                &nbsp;&nbsp;
                                {!! trans('employer.No') !!}
                                <input type="radio" value="0" checked name="is_uniform_required">

                            </div>









                            <div class="form-group">
                                <label for="exampleInputEmail1">{!! trans('job_application.workers_paid_position') !!}</label>
                                <select class="form-control">
                                    <option value="1">Hourly</option>
                                    <option value="2">Hourly + Tips</option>
                                    <option value="3">Piece rate</option>
                                </select>
                            </div>




                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="exampleInputEmail1">{!! trans('job_application.Number_of_Workers') !!}</label>
                                <input type="number" class="form-control" min="1" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">{!! trans('job_application.PayRate') !!}</label>
                                <input type="number" class="form-control" step="0.01" min="1" required>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">{!! trans('job_application.tip_credit') !!}</label>
                                <br>
                                {!! trans('employer.Yes') !!}

                                <input type="radio" value="1" checked name="is_uniform_required">

                                &nbsp;&nbsp;
                                {!! trans('employer.No') !!}
                                <input type="radio" value="0" name="is_uniform_required">

                            </div>



                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{!! trans('job_application.position_eligible') !!}</label>
                                <br>
                                {!! trans('employer.Yes') !!}

                                <input type="radio" value="1" name="">

                                &nbsp;&nbsp;
                                {!! trans('employer.No') !!}
                                <input type="radio" value="0" checked name="">

                            </div>
                            {!! trans('job_application.lift50lbs') !!}
                            <div class="form-group">
                                <label for="exampleInputEmail1">{!! trans('job_application.additional_notes') !!}</label>
                                <input type="text" name="start_date" class="form-control">
                            </div>



                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{!! trans('job_application.SpecialRequirements') !!}</label>
                                <br>
                                {!! trans('employer.Yes') !!}

                                <input type="radio" value="1" name="is_uniform_required">

                                &nbsp;&nbsp;
                                {!! trans('employer.No') !!}
                                <input type="radio" value="0" checked name="is_uniform_required">

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">{!! trans('job_application.IsOvertimeAvailable') !!}</label>
                                <select class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                    <option value="3">Only as Approved by Management</option>
                                </select>
                            </div>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{!! trans('job_application.AnticipatedWorkdays') !!}</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="checkbox">&nbsp;{!! trans('job_application.Sunday') !!}
                                            </div>
                                            <div class="col-md-6">
                                                <input type="checkbox">&nbsp;{!! trans('job_application.Monday') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="checkbox">&nbsp;{!! trans('job_application.Tuesday') !!}
                                            </div>
                                            <div class="col-md-6">
                                                <input type="checkbox">&nbsp;{!! trans('job_application.Wednesday') !!}
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="checkbox">&nbsp;{!! trans('job_application.Thursday') !!}
                                            </div>
                                            <div class="col-md-6">
                                                <input type="checkbox">&nbsp;{!! trans('job_application.Friday') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="col-md-6">
                                            <input type="checkbox">&nbsp;{!! trans('job_application.Saturday') !!}
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{!! trans('job_application.AnticipatedWorkdays') !!}</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                {!! trans('job_application.Sunday') !!}
                                                <input type="number" class="form-control" step="1"
                                                    max="24">
                                            </div>

                                            <div class="col-md-6">
                                                {!! trans('job_application.Monday') !!}
                                                <input type="number" class="form-control" step="1"
                                                    max="24">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                {!! trans('job_application.Tuesday') !!}
                                                <input type="number" class="form-control" step="1"
                                                    max="24">
                                            </div>
                                            <div class="col-md-6">
                                                {!! trans('job_application.Wednesday') !!}
                                                <input type="number" class="form-control" step="1"
                                                    max="24">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                {!! trans('job_application.Thursday') !!}
                                                <input type="number" class="form-control" step="1"
                                                    max="24">
                                            </div>
                                            <div class="col-md-6">
                                                {!! trans('job_application.Friday') !!}
                                                <input type="number" class="form-control" step="1"
                                                    max="24">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="col-md-6">
                                            {!! trans('job_application.Saturday') !!}
                                            <input type="number" class="form-control" step="1" max="24">
                                        </div>

                                        <div class="col-md-6">
                                            {!! trans('job_application.Saturday') !!}
                                            <input type="number" class="form-control" step="1" max="24">
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>





    <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            //$('#exampleModal').modal('show');

        });
    </script>




























    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript"></script>
@endsection
