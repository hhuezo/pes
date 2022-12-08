@extends ('dashboard')
@section('contenido')
    <style>
        canvas {
            width: 556.51px;
            height: 285.93px;
            background-color: #ffff;
            margin: 12px;
        }

        .div_canvas {
            background-color: #E5E5E5;
            width: 580.51px;
            height: 309.93px;
        }
    </style>

    <style>
        .nav-tabs-custom>.tab-content {

            padding: 0px;
        }

        .modal-lg,
        .modal-xl {
            max-width: 70%;
        }
    </style>

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


                    <form action="{{ url('job_application') }}" method="POST" class="forms-sample">
                        @csrf
                        <div class="col-xl-12 col-xxl-12 row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputUsername1">{!! trans('job_application.start_date') !!}</label>
                                    <input type="date" min="{{ date('Y-m-d') }}" name="start_date" id="start_date"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.end_date') !!}</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control">
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



                            <!-- ADD PISITION -->

                            <div class="col-sm-12" style="text-align: center;">

                                <button type="button" class="btn btn-rounded btn-info btn-lg" data-toggle="modal"
                                    data-target=".bd-example-modal-lg"><strong>Add
                                        position</strong><span class="btn-icon-right">
                                        <i class="fa fa-plus color-info"></i></span>
                                </button>

                            </div>

                            <!-- END ADD PISITION -->

                            <!-- <div class="col-sm-12">&nbsp;</div>

                                        <div class="col-sm-12" style="text-align: center;">
                                            <h3>{!! trans('job_application.EmployeeRights') !!}</h3>
                                        </div>

                                        <div class="col-sm-12">
                                            {!! trans('job_application.message4') !!}
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="checkbox"> &nbsp;&nbsp;{!! trans('job_application.Agree') !!}
                                        </div>
                                        <div class="col-sm-12">&nbsp;</div>
                                        <div class="col-sm-12">
                                            {!! trans('job_application.message5') !!}
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="checkbox"> &nbsp;&nbsp;{!! trans('employer.Yes') !!}
                                        </div>
                                        <div class="col-sm-12">&nbsp;</div>
                                        <div class="col-sm-12">
                                            {!! trans('job_application.PleasSign') !!}
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="div_canvas"> <canvas id="pizarra"></canvas></div>
                                        </div>
                                        <div class="col-sm-12">&nbsp;</div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{!! trans('job_application.printed_name') !!}</label>
                                                <input type="text" name="explain_multiple_employment" class="form-control">
                                            </div>
                                        </div>-->


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


    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{!! trans('job_application.Position') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{ url('job_application_detail') }}" method="POST" class="forms-sample">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="job_app_id" value="0">
                                            <input type="hidden" name="start_date_modal" id="start_date_modal"
                                                class="form-control">
                                            <input type="hidden" name="end_date_modal" id="end_date_modal"
                                                class="form-control">
                                            <input type="hidden" value="0" name="need_h2b_workers_modal"
                                                id="need_h2b_workers_modal" class="form-control">
                                            <input type="hidden" name="explain_multiple_employment_modal"
                                                id="explain_multiple_employment_modal" class="form-control">



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








    <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            hide_multiple_employment_period();
            hide_div_explain_benefits();
            hide_div_requeriments();
        });

        function hide_multiple_employment_period() {
            $('#div_multiple_employment_period').hide();
        }

        function show_multiple_employment_period() {
            $('#div_multiple_employment_period').show();
        }
        //
        $("#start_date").change(function() {
            document.getElementById('start_date_modal').value = document.getElementById('start_date').value;
        });

        $("#end_date").change(function() {
            document.getElementById('end_date_modal').value = document.getElementById('end_date').value;
        });

        $("#explain_multiple_employment").change(function() {
            document.getElementById('explain_multiple_employment_modal').value = document.getElementById(
                'explain_multiple_employment').value;
        });

        $("#need_h2b_workers").change(function() {
            if (document.getElementById('need_h2b_workers').checked == true) {
                document.getElementById('need_h2b_workers_modal').value = 1;
            } else {
                document.getElementById('need_h2b_workers_modal').value = 0;
            }
        });

        $("#need_h2b_workers2").change(function() {
            if (document.getElementById('need_h2b_workers2').checked == true) {
                document.getElementById('need_h2b_workers_modal').value = 0;
            } else {
                document.getElementById('need_h2b_workers_modal').value = 1;
            }
        });


        $("#is_there_benefits").change(function() {
            show_div_explain_benefits()
        })

        $("#is_there_benefits2").change(function() {
            hide_div_explain_benefits()
        })

        function show_div_explain_benefits() {
            $('#div_explain_benefits').show();
        }

        function hide_div_explain_benefits() {
            $('#div_explain_benefits').hide();
        }

        $("#are_there_any_requeriments").change(function() {
            show_div_requeriments()
        })

        $("#are_there_any_requeriments2").change(function() {
            hide_div_requeriments()
        })

        function show_div_requeriments() {
            $('#div_requeriments').show();
        }

        function hide_div_requeriments() {
            $('#div_requeriments').hide();
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


    <script>
        //======================================================================
        // VARIABLES
        //======================================================================
        let miCanvas = document.querySelector('#pizarra');
        let lineas = [];
        let correccionX = 0;
        let correccionY = 0;
        let pintarLinea = false;
        // Marca el nuevo punto
        let nuevaPosicionX = 0;
        let nuevaPosicionY = 0;

        let posicion = miCanvas.getBoundingClientRect()
        correccionX = posicion.x;
        correccionY = posicion.y;

        miCanvas.width = 556.51;
        miCanvas.height = 285.93;

        //======================================================================
        // FUNCIONES
        //======================================================================

        /**
         * Funcion que empieza a dibujar la linea
         */
        function empezarDibujo() {
            pintarLinea = true;
            lineas.push([]);
        };

        /**
         * Funcion que guarda la posicion de la nueva línea
         */
        function guardarLinea() {
            lineas[lineas.length - 1].push({
                x: nuevaPosicionX,
                y: nuevaPosicionY
            });
        }

        /**
         * Funcion dibuja la linea
         */
        function dibujarLinea(event) {
            event.preventDefault();
            if (pintarLinea) {
                let ctx = miCanvas.getContext('2d')
                // Estilos de linea
                ctx.lineJoin = ctx.lineCap = 'round';
                ctx.lineWidth = 5;
                // Color de la linea
                ctx.strokeStyle = '#0D0909';
                // Marca el nuevo punto
                if (event.changedTouches == undefined) {
                    // Versión ratón
                    nuevaPosicionX = event.layerX;
                    nuevaPosicionY = event.layerY;
                } else {
                    // Versión touch, pantalla tactil
                    nuevaPosicionX = event.changedTouches[0].pageX - correccionX;
                    nuevaPosicionY = event.changedTouches[0].pageY - correccionY;
                }
                // Guarda la linea
                guardarLinea();
                // Redibuja todas las lineas guardadas
                ctx.beginPath();
                lineas.forEach(function(segmento) {
                    ctx.moveTo(segmento[0].x, segmento[0].y);
                    segmento.forEach(function(punto, index) {
                        ctx.lineTo(punto.x, punto.y);
                    });
                });
                ctx.stroke();
            }
        }

        /**
         * Funcion que deja de dibujar la linea
         */
        function pararDibujar() {
            pintarLinea = false;
            guardarLinea();
        }

        //======================================================================
        // EVENTOS
        //======================================================================

        // Eventos raton
        miCanvas.addEventListener('mousedown', empezarDibujo, false);
        miCanvas.addEventListener('mousemove', dibujarLinea, false);
        miCanvas.addEventListener('mouseup', pararDibujar, false);

        // Eventos pantallas táctiles
        miCanvas.addEventListener('touchstart', empezarDibujo, false);
        miCanvas.addEventListener('touchmove', dibujarLinea, false);
    </script>
@endsection
