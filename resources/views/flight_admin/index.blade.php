@extends ('dashboard')
@section('contenido')
    <!-- /.box -->


    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <div class="col-xl-12 col-xxl-12">

        <div class="card">

            <div class="card-header">
                <h4 class="card-title">flights List</h4>
            </div>

            <div class="card-body">
                <table id="example" class="display" style="min-width: 845px">
                    <thead>
                        <tr>
                            <th>Name Candidate</th>
                            <th>Last Name Candidate</th>
                            <th>Recruitment status</th>
                            <th>Requirement Job Title</th>
                            <th>Requirement English Level</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($flight_candidates as $obj)
                            <tr>
                                <td>{{ $obj->name_candidate }}</td>
                                <td>{{ $obj->lastname_candidate }}</td>
                                <td>{{ $obj->recruitment_status }}</td>
                                <td>{{ $obj->required_job_title }}</td>
                                <td>{{ $obj->required_english_level }}</td>
                                <td align="center">

                                    <a href="#"
                                        onclick="modal_add_flight_itinerary({{ $obj->candidate_id }},{{ $obj->request_id }})"
                                        class="on-default edit-row">
                                        <i class="fa fa-edit fa-lg"></i></a>



                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

        </div>
    </div>



    <!-- modal add flight itinerary -->
    <div class="modal fade bd-example-modal-lg" id="modal-add-flight-itinerary" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Flight Itinerary</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{ url('flight_admin/update_itinerary') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Departure Itinerary</h5>
                                <input type="hidden" name="candidate_id" id="candidate_id" />
                                <input type="hidden" name="request_id" id="request_id" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Departure date</label>
                                    <input type="date" name="departure_date" id="departure_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Departure time</label>
                                    <input type="time" name="departure_time" id="departure_time" class="form-control">
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Aeropuerto de salida</label>
                                    <select name="departure_airport_id" id="departure_airport_id"
                                        class="form-control select2">
                                        <option value="">Select</option>
                                        @if ($airports)
                                            @foreach ($airports as $obj)
                                                <option value="{{ $obj->id }}">{{ $obj->ident }} -
                                                    {{ $obj->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <h5>Arriving Itinerary</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Arrival date</label>
                                    <input type="date" name="arrival_date" id="arrival_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Hora de llegada</label>
                                    <input type="time" name="arrival_time" id="arrival_time" class="form-control">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Aeropuerto de llegada</label>
                                    <select name="arrival_airport_id" id="arrival_airport_id" class="form-control select2">
                                        <option value="">Select</option>
                                        @if ($airports)
                                            @foreach ($airports as $obj)
                                                <option value="{{ $obj->id }}">{{ $obj->ident }} -
                                                    {{ $obj->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-rounded" style="background-color: #F77883"
                            data-dismiss="modal">&nbsp;&nbsp;&nbsp;Close&nbsp;&nbsp;&nbsp;</button>
                        <button type="submit" class="btn btn-primary btn-rounded"
                            style="background-color: #2763FF">&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal add flight itinerary -->



    @include('sweetalert::alert')


    <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {




        });


        function modal_add_flight_itinerary(candidate_id, request_id) {
            $('#modal-add-flight-itinerary').modal('show');
            document.getElementById('candidate_id').value = candidate_id;
            document.getElementById('request_id').value = request_id;
        }
    </script>
@endsection
