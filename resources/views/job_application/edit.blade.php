@extends ('dashboard')
@section('contenido')
    <style>
        .nav-tabs-custom>.tab-content {

            padding: 0px;
        }
    </style>
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4><strong>{!! trans('job_application.Title') !!}</strong></h4>

                </div>

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Tab 1</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane " id="tab_1">



                            <form method="POST" action="{{ route('job_application.update', $job->id) }}">
                                @method('PUT')
                                @csrf
                                <div class="col-md-12">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <div role="form">
                                            <div class="box-body">

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.start_date') !!}</label>
                                                    <input type="date" name="start_date"
                                                        value="{{ date('Y-m-d', strtotime($job->start_date)) }}"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.end_date') !!}</label>
                                                    <input type="date" name="end_date"
                                                        value="{{ date('Y-m-d', strtotime($job->end_date)) }}"
                                                        class="form-control">
                                                </div>

                                                {!! trans('job_application.message') !!}

                                                <div class="col-sm-12">&nbsp;</div>



                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.need_workers') !!}</label>
                                                    <br>
                                                    {!! trans('employer.Yes') !!}
                                                    @if ($job->need_h2b_workers == 1)
                                                        <input type="radio" value="1" checked
                                                            name="need_h2b_workers">
                                                    @else
                                                        <input type="radio" value="1" name="need_h2b_workers">
                                                    @endif

                                                    &nbsp;&nbsp;
                                                    {!! trans('employer.No') !!}
                                                    @if ($job->need_h2b_workers == 0)
                                                        <input type="radio" value="0" checked
                                                            name="need_h2b_workers">
                                                    @else
                                                        <input type="radio" value="0" name="need_h2b_workers">
                                                    @endif

                                                    <br>{!! trans('job_application.message2') !!}
                                                </div>


                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.multiple_employment_period') !!}</label>
                                                    <input type="text" name="explain_multiple_employment"
                                                        value="{{ $job->explain_multiple_employment }}"
                                                        class="form-control">
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
                                                    <label for="exampleInputEmail1">{!! trans('job_application.uniform') !!}</label>
                                                    <br>
                                                    {!! trans('employer.Yes') !!}

                                                    @if ($job->is_uniform_required == 1)
                                                        <input type="radio" value="1" checked
                                                            name="is_uniform_required">
                                                    @else
                                                        <input type="radio" value="1" name="is_uniform_required">
                                                    @endif

                                                    &nbsp;&nbsp;
                                                    {!! trans('employer.No') !!}
                                                    @if ($job->is_uniform_required == 0)
                                                        <input type="radio" value="0" checked
                                                            name="is_uniform_required">
                                                    @else
                                                        <input type="radio" value="0" name="is_uniform_required">
                                                    @endif
                                                </div>


                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.uniform_pieces') !!}</label>
                                                    <input type="text" name="uniform_pieces_required"
                                                        value="{{ $job->uniform_pieces_required }}" class="form-control">
                                                </div>





                                                {!! trans('job_application.message3') !!}

                                                <div class="col-sm-12">&nbsp;</div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('employer.Notes') !!}</label>
                                                    <input type="text" name="job_notes" value="{{ $job->job_notes }}"
                                                        class="form-control">
                                                    <br>
                                                    {!! trans('job_application.additional_space') !!}
                                                </div>



                                                <div class="form-group">
                                                    <button type="submit"
                                                        class="btn btn-primary float-right">Submit</button>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">&nbsp;</div>
                                </div>



                            </form>
















                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane active" id="tab_2">





                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div role="form">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{!! trans('job_application.job_title') !!}</label>
                                                <select class="form-control">

                                                </select>
                                            </div>



                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div role="form">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{!! trans('job_application.Number_of_Workers') !!}</label>
                                                <select class="form-control">

                                                </select>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>





                        </div>

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->






























            </div>
            <div class="col-md-12">&nbsp;</div>
        </div>
        <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script type="text/javascript"></script>
    @endsection
