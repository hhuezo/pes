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




        #draw-canvas {
            border: 2px dotted #050505;
            border-radius: 10px;
            cursor: crosshair;
        }

        #draw-dataUrl {
            width: 100%;
        }

        h3 {
            margin: 10px 15px;
        }

        header {
            background: #273B47;
            height: 100%;
            width: 100%;
            padding: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        section {
            flex: 1;
        }

        h1 {
            margin: 10px 15px;
        }

        header {
            color: white;
            font-weight: 500;
            padding-left: 15px;
        }


        .button {
            background: #3071a9;
            box-shadow: inset 0 -3px 0 rgba(0, 0, 0, .3);
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 5px;
            margin: 0 15px;
            text-decoration: none;
            color: white;
        }

        .button:active {
            transform: scale(0.9);
        }

        .contenedor {
            width: 100% margin: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .instrucciones {
            width: 90%;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }

        label {
            margin: 0 15px;
        }
    </style>

    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    @php($id_detail = 0)
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{!! trans('job_application.Title') !!}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('job_application.update', $job->id) }}">
                        @method('PUT')
                        @csrf
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

                            <div class="col-sm-12">{!! trans('job_application.message') !!}</div>

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

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{!! trans('job_application.multiple_employment_period') !!}</label>
                                    <input type="text" name="explain_multiple_employment"
                                        value="{{ $job->explain_multiple_employment }}" class="form-control">
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
                                            @foreach ($job_details as $obj)
                                                <tr>
                                                    <td>{{ $obj->title->name }}</td>
                                                    <td>{{ $obj->number_workers }}</td>
                                                    <td>{{ $obj->ant_workday_total_hours }}</td>
                                                    <td align="center">
                                                        &nbsp;&nbsp;
                                                        <a href="" data-target="#modal-delete-{{ $obj->id }}"
                                                            data-toggle="modal"><i class="fa fa-trash fa-lg"></i></a>
                                                    </td>
                                                </tr>
                                                @include('job_application.modal_detail')
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
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
                            <div id="div_name_sing" width="300" height="200">

                            </div>
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

            </div>

            </form>
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
                <form action="{{ url('job_application_detail') }}" method="POST" class="forms-sample">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="job_app_id" value="{{ $job->id }}">
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
            hide_div_explain_benefits();
            hide_div_requeriments();

            $('#draw-submitBtn').hide();
            $('#color').hide();
            $('#puntero').hide();
        });

        $("#printed_name").change(function() {

        })


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
    </script>

    <script>
        (function() { // Comenzamos una funcion auto-ejecutable

            // Obtenenemos un intervalo regular(Tiempo) en la pamtalla
            window.requestAnimFrame = (function(callback) {
                return window.requestAnimationFrame ||
                    window.webkitRequestAnimationFrame ||
                    window.mozRequestAnimationFrame ||
                    window.oRequestAnimationFrame ||
                    window.msRequestAnimaitonFrame ||
                    function(callback) {
                        window.setTimeout(callback, 1000 / 60);
                        // Retrasa la ejecucion de la funcion para mejorar la experiencia
                    };
            })();

            // Traemos el canvas mediante el id del elemento html
            var canvas = document.getElementById("draw-canvas");
            var ctx = canvas.getContext("2d");


            // Mandamos llamar a los Elemetos interactivos de la Interfaz HTML
            var drawText = document.getElementById("draw-dataUrl");
            var drawImage = document.getElementById("draw-image");
            var clearBtn = document.getElementById("draw-clearBtn");
            var submitBtn = document.getElementById("draw-submitBtn");
            clearBtn.addEventListener("click", function(e) {
                // Definimos que pasa cuando el boton draw-clearBtn es pulsado
                clearCanvas();
                //drawImage.setAttribute("src", "");
            }, false);
            // Definimos que pasa cuando el boton draw-submitBtn es pulsado
            submitBtn.addEventListener("click", function(e) {
                var dataUrl = canvas.toDataURL();
                drawText.innerHTML = dataUrl;
                drawImage.setAttribute("src", dataUrl);
            }, false);

            // Activamos MouseEvent para nuestra pagina
            var drawing = false;
            var mousePos = {
                x: 0,
                y: 0
            };
            var lastPos = mousePos;
            canvas.addEventListener("mousedown", function(e) {
                /*
                  Mas alla de solo llamar a una funcion, usamos function (e){...}
                  para mas versatilidad cuando ocurre un evento
                */
                var tint = document.getElementById("color");
                var punta = document.getElementById("puntero");
                console.log(e);
                drawing = true;
                lastPos = getMousePos(canvas, e);
            }, false);
            canvas.addEventListener("mouseup", function(e) {
                drawing = false;
            }, false);
            canvas.addEventListener("mousemove", function(e) {
                mousePos = getMousePos(canvas, e);
            }, false);

            // Activamos touchEvent para nuestra pagina
            canvas.addEventListener("touchstart", function(e) {
                mousePos = getTouchPos(canvas, e);
                console.log(mousePos);
                e.preventDefault(); // Prevent scrolling when touching the canvas
                var touch = e.touches[0];
                var mouseEvent = new MouseEvent("mousedown", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(mouseEvent);
            }, false);
            canvas.addEventListener("touchend", function(e) {
                e.preventDefault(); // Prevent scrolling when touching the canvas
                var mouseEvent = new MouseEvent("mouseup", {});
                canvas.dispatchEvent(mouseEvent);
            }, false);
            canvas.addEventListener("touchleave", function(e) {
                // Realiza el mismo proceso que touchend en caso de que el dedo se deslice fuera del canvas
                e.preventDefault(); // Prevent scrolling when touching the canvas
                var mouseEvent = new MouseEvent("mouseup", {});
                canvas.dispatchEvent(mouseEvent);
            }, false);
            canvas.addEventListener("touchmove", function(e) {
                e.preventDefault(); // Prevent scrolling when touching the canvas
                var touch = e.touches[0];
                var mouseEvent = new MouseEvent("mousemove", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(mouseEvent);
            }, false);

            // Get the position of the mouse relative to the canvas
            function getMousePos(canvasDom, mouseEvent) {
                var rect = canvasDom.getBoundingClientRect();
                /*
                  Devuelve el tamaño de un elemento y su posición relativa respecto
                  a la ventana de visualización (viewport).
                */
                return {
                    x: mouseEvent.clientX - rect.left,
                    y: mouseEvent.clientY - rect.top
                };
            }

            // Get the position of a touch relative to the canvas
            function getTouchPos(canvasDom, touchEvent) {
                var rect = canvasDom.getBoundingClientRect();
                console.log(touchEvent);
                /*
                  Devuelve el tamaño de un elemento y su posición relativa respecto
                  a la ventana de visualización (viewport).
                */
                return {
                    x: touchEvent.touches[0].clientX - rect.left, // Popiedad de todo evento Touch
                    y: touchEvent.touches[0].clientY - rect.top
                };
            }

            // Draw to the canvas
            function renderCanvas() {
                if (drawing) {
                    var tint = document.getElementById("color");
                    var punta = document.getElementById("puntero");
                    ctx.strokeStyle = tint.value;
                    ctx.beginPath();
                    ctx.moveTo(lastPos.x, lastPos.y);
                    ctx.lineTo(mousePos.x, mousePos.y);
                    console.log(punta.value);
                    ctx.lineWidth = punta.value;
                    ctx.stroke();
                    ctx.closePath();
                    lastPos = mousePos;
                }
            }

            function clearCanvas() {
                canvas.width = canvas.width;
            }

            // Allow for animation
            (function drawLoop() {
                requestAnimFrame(drawLoop);
                renderCanvas();
            })();

        })();
    </script>
@endsection
