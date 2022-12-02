@extends ('dashboard')
@section('contenido')
    <style>
        .nav-tabs-custom>.tab-content {

            padding: 0px;
        }
    </style>



    <div class="col-md-12 grid-margin stretch-card">
        <div class="card row">

            <div class="col-md-12">
                <div class="card">




                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
                        </li>

                    </ul>












                    <div class="col-sm-12">&nbsp;</div>
                    <form method="POST" action="{{ route('job_application.update', $job->id) }}">
                        @method('PUT')
                        @csrf

                        <div class="box-header with-border">
                            <h4><strong>{!! trans('job_application.Title') !!}</strong></h4>

                        </div>
                        <div class="row">
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

                        {!! trans('job_application.message') !!}

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

                    <div class="col-sm-12">&nbsp;</div>
                </div>

            </div>
        </div>
    </div>


    <div class="col-md-12 grid-margin stretch-card">
        <div class="card row">

            <div class="col-md-12">
                <div class="card">
                    <div class="col-sm-12">&nbsp;</div>
                    <form method="POST" action="{{ route('job_application.update', $job->id) }}">
                        @method('PUT')
                        @csrf

                        <div class="box-header with-border">
                            <h4><strong>{!! trans('job_application.Title') !!}</strong></h4>

                        </div>



                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.job_title') !!}</label>
                                    <select class="form-control select2">
                                        @foreach ($job_titles as $obj)
                                            <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>&nbsp;</div>
                                <div class="form-group">
                                    <input type="checkbox"> &nbsp;&nbsp;
                                    {!! trans('job_application.collective_bargaining') !!}
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
                                                <input type="number" class="form-control" step="1"
                                                    max="24">
                                            </div>

                                            <div class="col-md-6">
                                                {!! trans('job_application.Saturday') !!}
                                                <input type="number" class="form-control" step="1"
                                                    max="24">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </form>

                    <div class="col-sm-12">&nbsp;</div>
                </div>



                <button type="button" data-toggle="modal" data-target="#myModal">Launch modal</button>
                <div id="myModal" class="modal-dialog modal-xl">...</div>



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
