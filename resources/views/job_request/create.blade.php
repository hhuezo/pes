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


                    <form action="{{ url('job_request') }}" method="POST" class="forms-sample">
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
                                    {!! trans('job_application.Yes') !!}
                                    <input type="radio" value="1" id="need_h2b_workers_yes"
                                        onclick="show_multiple_employment_period();" name="need_h2b_workers">
                                    &nbsp;&nbsp;
                                    {!! trans('job_application.No') !!}
                                    <input type="radio" value="0" checked
                                        onclick="show_multiple_employment_period();" name="need_h2b_workers">
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

                            <!-- paid -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.workers_paid') !!}</label>
                                    <br>
                                    {!! trans('job_application.Weekly') !!}
                                    <input type="radio" value="1" name="workers_paid">
                                    &nbsp;&nbsp;
                                    {!! trans('job_application.Bi-weekly') !!}
                                    <input type="radio" value="2" checked name="workers_paid">
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.uniform') !!}</label>
                                    <br>
                                    {!! trans('job_application.Yes') !!}
                                    <input type="radio" value="1" name="is_uniform_required"
                                        id="is_uniform_required" onclick="show_div_uniform();">
                                    &nbsp;&nbsp;
                                    {!! trans('job_application.No') !!}
                                    <input type="radio" value="0" checked name="is_uniform_required" onclick="show_div_uniform();">
                                </div>
                                <label for="exampleInputEmail1">{!! trans('job_application.message3') !!}</label>
                            </div>

                            <div class="col-md-6" id="div_uniform">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.uniform_pieces') !!}</label>
                                    <input type="text" name="uniform_pieces_required" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                                    <input type="text" name="job_notes" class="form-control">
                                </div>
                                <label for="exampleInputEmail1">{!! trans('job_application.additional_space') !!}</label>
                            </div>

                            <!-- end paid -->

                            <!--     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.ACWIA') !!}</label>
                                            <br>
                                            {!! trans('employer.Yes') !!}
                                            <input type="radio" value="1" onclick="acwia();" id="has_acwia_yes"
                                                name="has_acwia">
                                            &nbsp;&nbsp;
                                            {!! trans('employer.No') !!}
                                            <input type="radio" value="0" checked onclick="acwia();" id="has_acwia_no"
                                                name="has_acwia">
                                            &nbsp;&nbsp;
                                            N/A
                                            <input type="radio" value="2" onclick="acwia();" id="has_acwia_na"
                                                name="has_acwia">
                                        </div>
                                    </div>



                                    <div class="col-sm-6">
                                        <div id="div_acwia">
                                            <label for="exampleInputEmail1">{!! trans('job_application.ifACWIA') !!}</label>
                                            <label for="exampleInputEmail1"><input type="checkbox"> &nbsp;
                                                {!! trans('job_application.i') !!}</label>
                                            <label for="exampleInputEmail1"><input type="checkbox"> &nbsp;
                                                {!! trans('job_application.ii') !!}</label>
                                            <label for="exampleInputEmail1"><input type="checkbox"> &nbsp;
                                                {!! trans('job_application.iii') !!}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.noACWIA') !!}</label>
                                            <br>
                                            {!! trans('employer.Yes') !!}
                                            <input type="radio" value="1" name="has_reason_no_acwia">
                                            &nbsp;&nbsp;
                                            {!! trans('employer.No') !!}
                                            <input type="radio" value="0" checked name="has_reason_no_acwia">
                                            &nbsp;&nbsp;
                                            N/A
                                            <input type="radio" value="2" name="has_reason_no_acwia">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.SportsLeagueRules') !!}</label>
                                            <br>
                                            {!! trans('employer.Yes') !!}
                                            <input type="radio" value="1" name="has_sports_league_regs">
                                            &nbsp;&nbsp;
                                            {!! trans('employer.No') !!}
                                            <input type="radio" value="0" checked name="has_sports_league_regs">

                                        </div>
                                    </div>
                                    <div class="col-sm-12">&nbsp;</div>

                                    <div class="col-sm-12">
                                        <div id="accordion-one" class="accordion">
                                            <div class="accordion__item">
                                                <div class="accordion__header collapsed" data-toggle="collapse"
                                                    data-target="#default_collapseTwo">
                                                    <span class="accordion__header--text">{!! trans('job_application.Attorney_applicable') !!}</span>
                                                    <span class="accordion__header--indicator"></span>
                                                </div>
                                                <div id="default_collapseTwo" class="collapse accordion__body"
                                                    data-parent="#accordion-one">
                                                    <div class="accordion__body--text row">


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">{!! trans('job_application.type_representation') !!}</label>
                                                                <br>
                                                                {!! trans('job_application.Attorney') !!}
                                                                <input type="radio" value="1" checked>
                                                                &nbsp;&nbsp;
                                                                {!! trans('job_application.Agent') !!}
                                                                <input type="radio" value="2">

                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">{!! trans('job_application.attorney_last_name') !!}</label>
                                                                <input type="text" name="explain_multiple_employment"
                                                                    class="form-control">
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">{!! trans('job_application.attorney_first_name') !!}</label>
                                                                <input type="text" name="explain_multiple_employment"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">{!! trans('job_application.attorney_middle_name') !!}</label>
                                                                <input type="text" name="explain_multiple_employment"
                                                                    class="form-control">
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">{!! trans('employer.State') !!}</label>
                                                                <select name="state_id" id="state_id"
                                                                    class="form-control select2">
                                                                    <option value="">Select</option>
                                                                    @foreach ($states as $obj)
    <option value="{{ $obj->id }}">{{ $obj->name }}
                                                                        </option>
    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">{!! trans('employer.County') !!}</label>
                                                                <select name="county_id" id="county_id"
                                                                    class="form-control select2">
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">{!! trans('employer.City') !!}</label>
                                                                <select name="city_id" id="city_id"
                                                                    class="form-control select2">
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">{!! trans('employer.PostalCode') !!}</label>
                                                                <select name="zip_code" id="zip_code" class="form-control">
                                                                </select>
                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">{!! trans('job_application.address') !!} 1</label>
                                                                <input type="text" name="explain_multiple_employment"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">{!! trans('job_application.address') !!} 2</label>
                                                                <input type="text" name="explain_multiple_employment"
                                                                    class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">{!! trans('job_application.province') !!}</label>
                                                                <input type="text" name="explain_multiple_employment"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">{!! trans('job_application.telephone_number') !!}</label>
                                                                <input type="text" name="explain_multiple_employment"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">{!! trans('job_application.extension') !!}</label>
                                                                <input type="text" name="explain_multiple_employment"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">{!! trans('job_application.business_email') !!}</label>
                                                                <input type="text" name="explain_multiple_employment"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">{!! trans('job_application.business_name') !!}</label>
                                                                <input type="text" name="explain_multiple_employment"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">{!! trans('job_application.business_fein') !!}</label>
                                                                <input type="text" name="explain_multiple_employment"
                                                                    class="form-control">
                                                            </div>


                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                -->

                            <div class="col-sm-12 form-group">
                                <button type="submit" class="btn btn-primary float-right">Next</button>
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
            //$('#div_acwia').hide();
            $('#div_multiple_employment_period').hide();
            $('#div_uniform').hide();


            /*   $("#state_id").change(function() {
                   var state_id = $(this).val();
                   $.get("{{ url('get_counties') }}" + '/' + state_id, function(data) {
                       //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
                       console.log(data);
                       var _select = '<option value="">Select</option>'
                       for (var i = 0; i < data.length; i++)
                           _select += '<option value="' + data[i].id + '"  >' + data[i].name +
                           '</option>';

                       $("#county_id").html(_select);
                   });
               });


               $("#county_id").change(function() {
                   var county_id = $(this).val();
                   $.get("{{ url('get_cities') }}" + '/' + county_id, function(data) {
                       //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
                       console.log(data);
                       var _select = '<option value="">Select</option>'
                       for (var i = 0; i < data.length; i++)
                           _select += '<option value="' + data[i].id + '"  >' + data[i].name +
                           '</option>';

                       $("#city_id").html(_select);
                   });
               });

               $("#city_id").change(function() {
                   var city_id = $(this).val();
                   $.get("{{ url('get_zipcodes') }}" + '/' + city_id, function(data) {
                       //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
                       console.log(data);
                       var _select = ''
                       for (var i = 0; i < data.length; i++)
                           _select += '<option value="' + data[i].id + '"  >' + data[i].czc_zipcode +
                           '</option>';

                       $("#zip_code").html(_select);
                   });
               });*/
        });

        /* function acwia() {
             if (document.getElementById('has_acwia_yes').checked == true) {
                 $('#div_acwia').show();
             } else {
                 $('#div_acwia').hide();
             }
         }*/

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


        //is_uniform_required
    </script>
@endsection
