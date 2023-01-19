@extends ('dashboard')
@section('contenido')
    <!-- /.box -->

    <style>
        .box {
            padding-top: 10px;
            padding-right: 30px;
            padding-bottom: 50px;
            padding-left: 30px;

            height: 80px;
            width: 270px;

            background: #2763FF;
            border-radius: 10%;
        }

        .big_letter {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 700;
            font-size: 36px;
            line-height: 10px;
            color: #FFFFFF;
        }

        .small_letter {
            font-family: 'Poppins';
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
                <h4 class="card-title">Requirements</h4>

            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('img/pes_admin.png') }}">
                        Client: Sheraton Hotel &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ID: 3423423432
                    </div>

                    <div class="col-md-6">

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        Date assigned: {{ $job_request->start_date }}

                        <table>
                            <tr>
                                <td>
                                    Position
                                </td>
                                <td>
                                    Workers
                                </td>
                                <td>
                                    English Level
                                </td>
                            </tr>

                            @foreach ($positions as $position)
                                <tr>
                                    <td>
                                        {{ $position->request_detail->position->title }}
                                    </td>
                                    <td>
                                        {{ $position->number_of_workers }}
                                    </td>
                                    <td>
                                        {{ $position->english_level->description_level_en }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            Request will be ready in:

                            <div class="box">
                                <table>
                                    <tr>
                                        <td align='center' class='big_letter'>
                                            {{ $DeferenceInDays }}
                                        </td>
                                        <td align='center' class='big_letter'>
                                            {{ $DeferenceInHours }}
                                        </td>
                                        <td align='center' class='big_letter'>
                                            {{ $DeferenceInMinutes }}
                                        </td>
                                        <td align='center' class='big_letter'>
                                            {{ $DeferenceInSeconds }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align='center' class='samall_letter'>
                                            <span style="color: white">DAY</span>

                                        </td>
                                        <td align='center' class='samall_letter'>
                                            <span style="color: white">HOUR</span>
                                        </td>
                                        <td align='center' class='samall_letter'>
                                            <span style="color: white">MNU</span>
                                        </td>
                                        <td align='center' class='samall_letter'>
                                            <span style="color: white">SECO</span>
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </div>


                        <form method="POST" action="{{ route('job_request_admin.update', $job_request->id) }}">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Assign rate</label>

                                    <input type="number" name="request_rate" class="form-control" min="1"
                                        step="0.01" value="{{ $job_request->request_rate }}">
                                </div>
                            </div>


                            <div class="form-group">
                                <button type="submit" name="send_rate" id="send_rate"
                                    class="btn btn-primary float-right">Send</button>
                            </div>
                        </form>




                    </div>
                </div>





            </div>

            <hr>


            <div class="card-body">

            </div>



        </div>
        @include('sweetalert::alert')
    </div>
@endsection
