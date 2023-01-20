@extends ('dashboard')
@section('contenido')
    <!-- /.box -->

    <style>
        .btn-circle {
            width: 30px;
            height: 30px;
            padding: 6px 0px;
            border-radius: 15px;
            text-align: center;
            font-size: 12px;
            line-height: 1.42857;
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
                                        <form method="POST" action="{{ url('job_request_finantial') }}">
                                            @csrf
                                            <div class="form-group">
                                                <div class="form-group row">
                                                    <input type="hidden" name="request_id" value="{{ $job_request->id }}">
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
                                                        <input type="number" name="ammount_due" step="0.01"
                                                            min="1.00" class="form-control" required>
                                                    </div>

                                                </div>
                                            </div>





                                            <div class="form-group">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">
                                                        <h5>Date due</h5>
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
                                                        <input type="text" name="comments" class="form-control" required>
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
                                                    <th>#</th>
                                                    <th>Type</th>
                                                    <th>Ammount</th>
                                                    <th>Date due</th>
                                                    <th>Comments</th>
                                                    <th>Status</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php($i = 1)
                                                @foreach ($invoices as $obj)
                                                    <tr class="table-{{ $color[$obj->catalog_invoice_status_id] }}">
                                                        <td>{{ $i }}</td>
                                                        <td>
                                                            @if ($obj->catalog_invoice_types_id)
                                                                {{ $obj->type->name }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            ${{ $obj->ammount_due }}
                                                        </td>
                                                        <td>
                                                            {{ date('m/d/Y', strtotime($obj->date_due)) }}
                                                        </td>
                                                        <td>
                                                            {{ $obj->comments }}
                                                        </td>
                                                        <td>
                                                            @if ($obj->catalog_invoice_status_id)
                                                                {{ $obj->status->name }}
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if ($obj->proof_of_payment)
                                                                <a href="{{ asset('invoice') }}/{{ $obj->proof_of_payment }}"
                                                                    target="_blank"> <button
                                                                        class="btn btn-info btn-circle"><i
                                                                            class="fa fa-file-pdf-o fa-lg"></i></button></a>
                                                                &nbsp;&nbsp;
                                                            @endif

                                                            @if ($obj->catalog_invoice_status_id != 1)
                                                                <button class="btn btn-success btn-circle"
                                                                    onclick="modal_pay({{ $obj->id }})">Pay</button>
                                                            @endif



                                                        </td>
                                                    </tr>
                                                    @php($i++)
                                                @endforeach
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





        <div class="modal fade" id="modal-pay">
            <div class="modal-dialog" role="document">
                <form method="POST" action="{{ url('job_request_finantial/pay') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">You want to record the invoice payment?</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <!--You want to record the invoice payment?-->

                            <div class="form-group">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">
                                        <h5>Proof of payment</h5>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="file" name="proof_of_payment" required>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



    </div>

    <script>
        function modal_pay(id) {
            document.getElementById('id').value = id;
            $('#modal-pay').modal('show');
        }
    </script>
@endsection
