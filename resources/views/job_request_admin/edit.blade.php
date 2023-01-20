@extends ('dashboard')
@section('contenido')
    <!-- /.box -->

    <style>
        .v-line {
            border: none;
            border-left: 1px solid hsla(200, 10%, 50%, 100);
            height: 100%;
            width: 1px;
            color: #BDBDC7
        }

        .box {
            padding-top: 10px;
            padding-right: 30px;
            padding-bottom: 50px;
            padding-left: 30px;

            height: 110px;
            /*width: 270px;*/

            background: #2763FF;
            border-radius: 20px;
        }

        .big_letter {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-size: 36px;
            line-height: 10px;
            color: #FFFFFF;
        }

        .small_letter {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-size: 10px;
            line-height: 70px;
            color: #FFFFFF;
        }

        td {
            padding-top: 7px;
            padding-right: 7px;
            padding-bottom: 7px;
            padding-left: 7px;
        }
    </style>
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <div class="col-xl-12 col-xxl-12">

        <div class="card">

            <div class="card-header">
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-md-6 row">
                        <div class="col-md-4" style="text-align: center;">
                            <img src="{{ asset('img/pes_admin.png') }}" style="width: 77px;">
                        </div>
                        <div class="col-md-8" style="display: flex; align-items: center;">
                            <h4>Client: <br>{{ $job_request->employer->legal_business_name }}</h4>
                        </div>
                        <div class="col-md-12">
                            <hr>

                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">English level</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-responsive-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Position</th>
                                                        <th> English Level</th>
                                                        <th>Workers</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php($total = 0)
                                                    @foreach ($positions as $position)
                                                        <tr>
                                                            <td>
                                                                {{ $position->request_detail->position->title }}
                                                            </td>
                                                            <td>
                                                                {{ $position->english_level->description_level_en }}
                                                            </td>
                                                            <td>
                                                                {{ $position->number_of_workers }}
                                                            </td>
                                                        </tr>
                                                        @php($total += $position->number_of_workers)
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="2"><strong>Total</strong></td>
                                                        <td><strong>{{ $total }}</strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /# card -->
                            </div>
                        </div>
                    </div>
                    <hr>


                    <div class="col-md-6">
                        <div class="col-md-12">
                            <br>
                            <center>
                                <h4 style="margin-top: 17px;"> Request will be ready in:<h4>
                            </center>
                        </div>

                        <div class="col-md-12" style="text-align: center; display: flex; margi">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 col-sm-12 row box" style="margin-top: 30px;">
                                <div class="col-md-3 col-sm-12" style="text-align: center;     margin-top: 12px;">
                                    <div class="big_letter" style="margin-top: 10px; font-weight: bold;">
                                        {{ $DeferenceInDays }}</div><br>
                                    <span style="color: white;  margin-top: 10px; font-weight: bold;"><span
                                            style="font: ">DAYS</span></span>
                                </div>
                                <div class="col-md-3 col-sm-12" style="text-align: center;     margin-top: 12px;">
                                    <div class="big_letter" style="margin-top: 10px; font-weight: bold;">
                                        {{ $DeferenceInHours }}</div><br>
                                    <span style="color: white;  margin-top: 10px; font-weight: bold;">HOURS</span>
                                </div>

                                <div class="col-md-3 col-sm-12" style="text-align: center;     margin-top: 12px;">
                                    <div class="big_letter" style="margin-top: 10px; font-weight: bold;">
                                        {{ $DeferenceInMinutes }}</div><br>
                                    <span style="color: white;  margin-top: 10px; font-weight: bold;">MINU</span>
                                </div>

                                <div class="col-md-3 col-sm-12" style="text-align: center;     margin-top: 12px;">
                                    <div class="big_letter" style="margin-top: 10px; font-weight: bold;">
                                        {{ $DeferenceInSeconds }}</div><br>
                                    <span style="color: white;  margin-top: 10px; font-weight: bold;">SECO</span>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <br>
                        <br>
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('job_request_admin.update', $job_request->id) }}">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <h5>Assign rate</h5>
                                        </label>

                                        <input type="number" name="request_rate" class="form-control"
                                            placeholder="To write" min="1" step="0.01"
                                            value="{{ $job_request->request_rate }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <center><button type="submit" name="send_rate" id="send_rate"
                                            class="btn btn-primary float-right btn-rounded"
                                            style="background-color: #2763FF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Send&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                    </center>
                                </div>
                            </form>




                        </div>

                    </div>



                </div>












            </div>




        </div>
        @include('sweetalert::alert')
    </div>
@endsection
