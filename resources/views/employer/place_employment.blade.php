@extends ('dashboard')
@section('contenido')
    <div class="row">
        <div class="col-md-12 ">
            <div class="box box-primary">
                <form action="{{ url('employer_place_store') }}" method="POST">
                    <div class="box-header  with-border">
                        <h4><strong>{!! trans('employer.PlaceOfEmployment') !!}</strong></h4>
                    </div>

                    <input type="hidden" value="{{$employer->id}}" name="id">

                    @csrf

                    <div class="form-group">
                        <br>
                        <div class="col-md-12">
                            <label>{!! trans('employer.MainWorksiteState') !!}</label>
                        </div>
                        <div class="col-md-12">
                            <input type="checkbox" id="SamePlaceBusiness"> &nbsp;&nbsp; {!! trans('employer.SamePlaceBusiness') !!}
                        </div>
                    </div>
                    <div> &nbsp;</div>
                    <div id="DivMainWorksite">
                        <div class="col-md-12">

                            <div class="box-body">


                                <div class="form-group">
                                    <label>{!! trans('employer.MainWorksiteStreetAddress') !!}</label>
                                    <input type="text" name="main_worksite_location" class="form-control">
                                </div>

                            </div>

                        </div>


                        <div class="col-md-12">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>{!! trans('employer.MainWorksiteCity') !!}</label>
                                    <input type="text" name="main_worksite_city" class="form-control">
                                </div>


                                <div class="form-group">
                                    <label>{!! trans('employer.MainWorksiteCounty') !!}</label>
                                    <input type="text" name="main_worksite_country" class="form-control">
                                </div>


                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{!! trans('employer.MainWorksiteState') !!}</label>
                                    <select class="form-control" name="main_worksite_state">
                                        @foreach ($states as $obj)
                                            <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{!! trans('employer.MainWorksiteZipCode') !!}</label>
                                    <input type="text" name="main_worksite_zip_code" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>







                    <div class="col-md-12">
                        <h5><strong>{!! trans('employer.AdditionalEmployerWorksite') !!}</strong></h5>
                        <div class="col-md-6">
                            <div class="col-md-9">
                                <select class="form-control" name="Additional_employer_worksite"
                                    id="Additional_employer_worksite">
                                    <option value="0">{!! trans('employer.No') !!} </option>
                                    <option value="1">{!! trans('employer.Yes') !!} </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-success" id="BtnAddAdditionalWorksite"
                                    onclick="modal();">{!! trans('employer.AddAdditionalWorksite') !!}</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">&nbsp;</div>
                    <div class="col-md-1"></div>
                    <div class="col-md-10" id="response">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Street Address</th>
                                    <th>City address</th>
                                    <th>Country address</th>
                                    <th>State</th>
                                    <th>Zip code address</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($worksites as $obj)
                                    <tr>
                                        <td>{{ $obj->street_address }}</td>
                                        <td>{{ $obj->city_address }}</td>
                                        <td>{{ $obj->country_address }}</td>
                                        @if ($obj->state_id_address)
                                            <td>{{ $obj->state->name }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>{{ $obj->zip_code_address }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <div class="col-md-12">&nbsp;</div>
                    <div class="col-md-12">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{!! trans('employer.NormalBusinessDays') !!}</label>
                                <select name="normal_business_days_id" id="NormalBusinessDays" class="form-control">
                                    @foreach ($normal_business_days as $obj)
                                        <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                    @endforeach

                                </select>
                            </div>



                            <div class="form-group">
                                <label>{!! trans('employer.TransportationProvided') !!}</label>
                                <select class="form-control" name="is_transportation_provided">
                                    <option value="1">{!! trans('employer.Yes') !!} </option>
                                    <option value="0">{!! trans('employer.No') !!} </option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{!! trans('employer.Other') !!}</label>
                                <input type="text" id="Other" name="normal_business_days_other" class="form-control">
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{!! trans('employer.PublicTransportation') !!}</label>
                                <input type="text" name="how_far_transportation_from_worksite" class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{!! trans('employer.LocalPublicTransportation') !!}</label>
                                <input type="text" name="local_transportation_website" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{!! trans('employer.Notes') !!}</label>
                                <input type="text" name="place_employment_notes" class="form-control">
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">submit</button>
                    </div>

                    <div class="col-md-12">&nbsp;</div>
                </form>
            </div>
            <!-- /.col -->

        </div>

    </div>











    <div class="modal fade" id="modal_employer_additional_location" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true" data-tipo="1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ url('employer_additional_location') }}">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>

                        <div class="col-md-12">{!! trans('employer.AdditionalEmployerWorksiteAddress') !!}</div>
                        <div class="col-md-12">&nbsp;</div>
                        <div class="col-md-12">
                            <h4><strong>{!! trans('employer.AdditionalEmployerworksiteLocation') !!}</strong></h4>
                        </div>
                        <div class="col-md-12">{!! trans('employer.DoIncludeCustomer') !!}</div>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="employer_id" value="{{ $employer->id }}">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label>{!! trans('employer.StreetAddress') !!}</label>
                            <input type="text" id="street_address" required class="form-control">
                        </div>



                        <div class="form-group">
                            <label>{!! trans('employer.City') !!}</label>
                            <input type="text" id="city_address" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label>{!! trans('employer.County') !!}</label>
                            <input type="text" id="country_address" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label>{!! trans('employer.State') !!}</label>
                            <select class="form-control" id="state_id_address">
                                @foreach ($states as $obj)
                                    <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label>{!! trans('employer.ZipCode') !!}</label>
                            <input type="text" id="zip_code_address" required class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" onclick="add_employer_additional_location()" class="btn btn-primary">Save
                            changes</button>
                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>











    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#BtnAddAdditionalWorksite').hide();
            $('#Other').prop("disabled", true);
        });


        $("#SamePlaceBusiness").change(function() {
            if (document.getElementById('SamePlaceBusiness').checked) {
                //DivMainWorksite alert('checked')
                $('#DivMainWorksite').hide();

            } else {
                $('#DivMainWorksite').show();
            }
        });

        $("#NormalBusinessDays").change(function() {

            if (document.getElementById('NormalBusinessDays').value == 4) {
                $('#Other').prop("disabled", false);
            } else {
                $('#Other').prop("disabled", true);
            }
        });



        function add_employer_additional_location() {
            $('#response').html('<div><img src="../../public/img/ajax-loader.gif"/></div>');

            var parametros = {
                "employer_id": document.getElementById('employer_id').value,
                "street_address": document.getElementById('street_address').value,
                "city_address": document.getElementById('city_address').value,
                "country_address": document.getElementById('country_address').value,
                "state_id_address": document.getElementById('state_id_address').value,
                "zip_code_address": document.getElementById('zip_code_address').value,
                "_token": document.getElementById('token').value
            };
            $.ajax({
                type: "post",
                url: "{{ url('employer_additional_location') }}",
                data: parametros,
                success: function(data) {
                    console.log(data);
                    $('#response').html(data);

                    $('#modal_employer_additional_location').modal('hide');
                }
            });

        }


        $("#Additional_employer_worksite").change(function() {

            if (document.getElementById('Additional_employer_worksite').value == 1) {
                $('#BtnAddAdditionalWorksite').show();
                $('#modal_employer_additional_location').modal('show');
            } else {
                $('#BtnAddAdditionalWorksite').hide();
            }
        });

        function modal() {
            $('#modal_employer_additional_location').modal('show');
        }
    </script>
@endsection
