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

                    <div class="col-md-12 row">
                        <div class="col-md-2" style="text-align: center;">
                            <img src="{{ asset('img/pes_admin.png') }}" style="width: 77px;">
                        </div>
                        <div class="col-md-8" style="display: flex; align-items: center;">
                            <h4>Client: <br>{{ $job_request->employer->legal_business_name }}</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col-md-12 row">

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Invoice</h4>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <form method="POST"
                                            action="{{ route('job_request_admin.update', $job_request->id) }}">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-group">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">
                                                        <h5>Type</h5>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <select name="catalog_invoice_types_id" class="form-control">
                                                            @foreach ($types as $obj)
                                                                <option value="{{ $obj->id }}">{{ $obj->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">
                                                        <h5>Ammount</h5>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="number" step="0.01" min="1.00" class="form-control" required>
                                                    </div>

                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">
                                                        <h5>proof of payment</h5>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="proof_of_payment" required>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">
                                                        <h5>date due</h5>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="date" name="date_due" class="form-control" required>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">
                                                        <h5>Comments</h5>
                                                    </label>
                                                    <div class="col-sm-9">
                                                        <input type="text"  class="form-control" required>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <center><button type="submit" name="send_rate" id="send_rate"
                                                        class="btn btn-primary float-right btn-rounded">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Send&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                                </center>
                                            </div>
                                        </form>




                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">

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
                                                @foreach ($invoices as $obj)
                                                    <tr>
                                                        <td>

                                                        </td>
                                                        <td>

                                                        </td>
                                                        <td>

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












            </div>




        </div>
        @include('sweetalert::alert')
    </div>
@endsection
