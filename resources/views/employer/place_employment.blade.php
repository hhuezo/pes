@extends ('dashboard')
@section('contenido')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4><strong>{!! trans('employer.PlaceOfEmployment') !!}</strong></h4>
                </div>
                <form action="{{ url('employer') }}" method="POST">
                    @csrf

                    <div class="col-md-12">

                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">{!! trans('employer.MainWorksiteLocation') !!}</label>
                                <div class="col-md-12">
                                    <input type="checkbox"> &nbsp;&nbsp; {!! trans('employer.SamePlaceBusiness') !!}
                                </div>
                            </div>
                            <div> &nbsp;</div>
                            <div class="form-group">
                                <label>{!! trans('employer.MainWorksiteStreetAddress') !!}</label>
                                <input type="text" name="trade_name" class="form-control">
                            </div>

                        </div>

                    </div>


                    <div class="col-md-12">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>{!! trans('employer.MainWorksiteCity') !!}</label>
                                <input type="text" name="trade_name" class="form-control">
                            </div>


                            <div class="form-group">
                                <label>{!! trans('employer.MainWorksiteCounty') !!}</label>
                                <input type="text" name="trade_name" class="form-control">
                            </div>


                        </div>

                        <div class="col-md-6">
                            <!-- /.box-header -->
                            <!-- form start -->
                            <div role="form">
                                <div class="box-body">


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
        <script type="text/javascript">
            $("#ParticipatedH-2B").change(function() {
                if (document.getElementById('ParticipatedH-2B').value == 1) {
                    $('#DivYearsCompanyParticipated').show();
                } else {
                    $('#DivYearsCompanyParticipated').hide();
                }

            });

            $("#PrimaryContactListed").change(function() {
                if (document.getElementById('PrimaryContactListed').value == 1) {
                    $('#DivSignatory').hide();

                } else {
                    $('#DivSignatory').show();
                }

            });


            $("#SameAsAbove").change(function() {
                if (document.getElementById('SameAsAbove').checked == true) {
                    $('#DivMailin').hide();

                } else {
                    $('#DivMailin').show();
                }

            });



            $("#PrimaryBusinessType").change(function() {
                var PrimaryBusinessType = $(this).val();

                if (PrimaryBusinessType != 6) {
                    $('#DivNaicsCodCompany').show();
                    $('#DivNaicsNameCompany').hide();

                    $.get("{{ url('get_naics_code') }}" + '/' + PrimaryBusinessType, function(data) {
                        //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
                        console.log(data);
                        var _select = ''
                        for (var i = 0; i < data.length; i++)
                            _select += '<option value="' + data[i].id + '"  >' + data[i].code + ' ' + data[i]
                            .name +
                            '</option>';
                        $("#NaicsCod").html(_select);
                    });
                } else {
                    $('#DivNaicsCodCompany').hide();
                    $('#DivNaicsNameCompany').show();
                }



            });
            //


            $(document).ready(function() {
                $('#DivYearsCompanyParticipated').hide();
                $('#DivSignatory').hide();

                $('#DivNaicsCodCompany').show();
                $('#DivNaicsNameCompany').hide();
            });
        </script>
    @endsection
