@extends ('dashboard')
@section('contenido')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-xl-12 col-xxl-12">
                        <h4 class="card-title">{!! trans('job_application.Title') !!}</h4>
                        <p class="card-description">
                            {!! trans('job_application.maximun') !!}
                        </p>
                    </div>
                </div>
                <div class="card-body">


                    <form action="{{ url('request') }}" method="POST" class="forms-sample">
                        @csrf
                        <div class="col-xl-12 col-xxl-12 row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputUsername1">{!! trans('job_application.start_date') !!}</label>
                                    <input type="date" min="{{ date('Y-m-d') }}" name="start_date" id="start_date"
                                        required class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.end_date') !!}</label>
                                    <input type="date" name="end_date" id="end_date" required class="form-control">
                                </div>

                            </div>

                            <div class="col-sm-12">{!! trans('job_application.message') !!}</div>

                            <div class="col-sm-12">&nbsp;</div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.need_workers') !!}</label>
                                    <br>
                                    {!! trans('employer.Yes') !!}
                                    <input type="radio" value="1" onclick="show_multiple_employment_period();"
                                        id="need_h2b_workers" name="need_h2b_workers">
                                    &nbsp;&nbsp;
                                    {!! trans('employer.No') !!}
                                    <input type="radio" value="0" onclick="hide_multiple_employment_period();"
                                        checked id="need_h2b_workers2" name="need_h2b_workers">
                                    <br>

                                    {!! trans('job_application.message2') !!}


                                </div>
                            </div>

                            <div class="col-md-6" id="div_multiple_employment_period">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.multiple_employment_period') !!}</label>
                                    <input type="text" name="explain_multiple_employment"
                                        id="explain_multiple_employment" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">&nbsp;</div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.ACWIA') !!}</label>
                                    <br>
                                    {!! trans('employer.Yes') !!}
                                    <input type="radio" value="1" id="need_h2b_workers" name="need_h2b_workers">
                                    &nbsp;&nbsp;
                                    {!! trans('employer.No') !!}
                                    <input type="radio" value="0" checked id="need_h2b_workers2"
                                        name="need_h2b_workers">
                                    &nbsp;&nbsp;
                                    N/A
                                    <input type="radio" value="2" id="need_h2b_workers2" name="need_h2b_workers">
                                </div>
                            </div>



                            <div class="col-sm-6" id="div_ifACWIA">
                                <label for="exampleInputEmail1">{!! trans('job_application.ifACWIA') !!}</label>
                                <label for="exampleInputEmail1"><input type="checkbox"> &nbsp;
                                    {!! trans('job_application.i') !!}</label>
                                <label for="exampleInputEmail1"><input type="checkbox"> &nbsp;
                                    {!! trans('job_application.ii') !!}</label>
                                <label for="exampleInputEmail1"><input type="checkbox"> &nbsp;
                                    {!! trans('job_application.iii') !!}</label>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.noACWIA') !!}</label>
                                    <br>
                                    {!! trans('employer.Yes') !!}
                                    <input type="radio" value="1" id="need_h2b_workers" name="need_h2b_workers">
                                    &nbsp;&nbsp;
                                    {!! trans('employer.No') !!}
                                    <input type="radio" value="0" checked id="need_h2b_workers2"
                                        name="need_h2b_workers">
                                    &nbsp;&nbsp;
                                    N/A
                                    <input type="radio" value="2" id="need_h2b_workers2" name="need_h2b_workers">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.SportsLeagueRules') !!}</label>
                                    <br>
                                    {!! trans('employer.Yes') !!}
                                    <input type="radio" value="1" id="need_h2b_workers" name="need_h2b_workers">
                                    &nbsp;&nbsp;
                                    {!! trans('employer.No') !!}
                                    <input type="radio" value="0" checked id="need_h2b_workers2"
                                        name="need_h2b_workers">

                                </div>
                            </div>
                            <div class="col-sm-12">&nbsp;</div>
                            <div class="col-sm-12">
                                <input type="checkbox"> &nbsp;<label
                                    for="exampleInputEmail1">{!! trans('job_application.Attorney_applicable') !!}</label>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.type_representation') !!}</label>
                                    <br>
                                    {!! trans('job_application.Attorney') !!}
                                    <input type="radio" value="1" id="need_h2b_workers" name="need_h2b_workers">
                                    &nbsp;&nbsp;
                                    {!! trans('job_application.Agent') !!}
                                    <input type="radio" value="2" checked id="need_h2b_workers2"
                                        name="need_h2b_workers">
                                    &nbsp;&nbsp;
                                    {!! trans('job_application.None') !!}
                                    <input type="radio" value="2" checked id="need_h2b_workers2"
                                        name="need_h2b_workers">
                                </div>
                            </div>
                            <div class="col-sm-12">&nbsp;</div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.attorney_last_name') !!}</label>
                                    <input type="text" name="explain_multiple_employment" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.attorney_first_name') !!}</label>
                                    <input type="text" name="explain_multiple_employment" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.attorney_middle_name') !!}</label>
                                    <input type="text" name="explain_multiple_employment" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.address') !!} 1</label>
                                    <input type="text" name="explain_multiple_employment" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.address') !!} 2</label>
                                    <input type="text" name="explain_multiple_employment" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-12 form-group">
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>

                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')





    <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#div_ifACWIA').hide();
        });
    </script>
@endsection
