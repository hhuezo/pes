@extends ('dashboard')
@section('contenido')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4><strong>{!! trans('job_application.Title') !!}</strong></h4>
                    {!! trans('job_application.maximun') !!}

                </div>
                <form action="{{ url('job_application') }}" method="POST" class="form-horizontal">
                    @csrf
                    <div class="col-md-12">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div role="form">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.start_date') !!}</label>
                                        <input type="date" name="start_date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.end_date') !!}</label>
                                        <input type="date" name="end_date" class="form-control">
                                    </div>

                                    {!! trans('job_application.message') !!}

                                    <div class="col-sm-12">&nbsp;</div>



                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.need_workers') !!}</label>
                                        <br>
                                        {!! trans('employer.Yes') !!}
                                        <input type="radio" name="need_h2b_workers">
                                        &nbsp;&nbsp;
                                        {!! trans('employer.No') !!}
                                        <input type="radio" name="need_h2b_workers">
                                        <br>{!! trans('job_application.message2') !!}
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.multiple_employment_period') !!}</label>
                                        <input type="text" name="explain_multiple_employment" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.workers_paid') !!}</label>
                                        <br>
                                        {!! trans('job_application.Weekly') !!}
                                        <input type="radio" value="1" name="paid" checked>
                                        &nbsp;&nbsp;
                                        {!! trans('job_application.Bi-weekly') !!}
                                        <input type="radio" value="2" name="paid">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.uniform') !!}</label>
                                        <br>
                                        {!! trans('employer.Yes') !!}
                                        <input type="radio" value="1" checked name="is_uniform_required">
                                        &nbsp;&nbsp;
                                        {!! trans('employer.No') !!}
                                        <input type="radio" value="0" name="is_uniform_required">
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.uniform_pieces') !!}</label>
                                        <input type="text" name="uniform_pieces_required" class="form-control">
                                    </div>





                                    {!! trans('job_application.message3') !!}

                                    <div class="col-sm-12">&nbsp;</div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('employer.Notes') !!}</label>
                                        <input type="text" name="job_notes" class="form-control">
                                        <br>
                                        {!! trans('job_application.additional_space') !!}
                                    </div>



                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">&nbsp;</div>
                    </div>



                </form>
            </div>
            <div class="col-md-12">&nbsp;</div>
        </div>
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script type="text/javascript"></script>
    @endsection
