@extends ('dashboard')
@section('contenido')
    <link rel="stylesheet" href="{{ asset('job_application/style.css') }}">

    @if (session()->has('tab_request'))
        @php($tab_request = session('tab_request'))
    @else
        @php($tab_request = 1)
    @endif

    @if ($deduction)
        @if ($deduction->housing_utilities == 0)
            <style>
                .divHousing {
                    display: none;
                }
            </style>
        @endif
    @endif


    @if ($job_request->signature)
        <style>
            .divCreateSign {
                display: none;
            }
        </style>
    @else
        <style>
            .divEditSign {
                display: none;
            }
        </style>
    @endif

    <div class="row">


        <div class="card col-md-12">
            <div class="card-header">
                <h4 class="card-title">MY REQUIREMENTS</h4>
            </div>
            <div class="card-body">
                <!-- Nav tabs -->
                <div class="default-tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab1"> TEMPORARY NEED INFORMATION </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab2">POSITION(S) NEEDED</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab3">DEDUCTIONS PAYCHECK
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab4">JOB REQUIREMENTS AND CONDITIONS
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab5">ATTORNEY OR AGENT INFORMATION
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab6">EMPLOYER RIGHTS
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="tab1" role="tabpanel">
                            <form method="POST" action="{{ route('job_request.update', $job_request->id) }}">
                                @method('PUT')
                                @csrf

                                <br>
                                <h3>TEMPORARY NEED INFORMATION</h3>

                                <div class="col-xl-12 col-xxl-12 row">
                                    <div class="col-sm-12">&nbsp;</div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">{!! trans('job_application.start_date') !!}</label>
                                            <input type="date" name="start_date" value="{{ $job_request->start_date }}"
                                                required class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.end_date') !!}</label>
                                            <input type="date" name="end_date" value="{{ $job_request->end_date }}"
                                                required class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">{!! trans('job_application.message') !!}</div>

                                    <div class="col-sm-12">&nbsp;</div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.need_workers') !!}</label>
                                            <br>
                                            {!! trans('job_application.Yes') !!}
                                            @if ($job_request->need_h2b_workers == 1)
                                                <input type="radio" checked value="1" id="need_h2b_workers_yes"
                                                    onclick="show_multiple_employment_period();" name="need_h2b_workers">
                                            @else
                                                <input type="radio" value="1" id="need_h2b_workers_yes"
                                                    onclick="show_multiple_employment_period();" name="need_h2b_workers">
                                            @endif
                                            &nbsp;&nbsp;
                                            {!! trans('job_application.No') !!}
                                            @if ($job_request->need_h2b_workers == 0)
                                                <input type="radio" value="0" checked
                                                    onclick="show_multiple_employment_period();" name="need_h2b_workers">
                                            @else
                                                <input type="radio" value="0"
                                                    onclick="show_multiple_employment_period();" name="need_h2b_workers">
                                            @endif
                                            <br>

                                            {!! trans('job_application.message2') !!}


                                        </div>
                                    </div>

                                    <div class="col-md-6" id="div_multiple_employment_period">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.multiple_employment_period') !!}</label>
                                            <input type="text" name="explain_multiple_employment"
                                                value="{{ $job_request->explain_multiple_employment }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">&nbsp;</div>

                                    <!-- paid -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.workers_paid') !!}</label>
                                            <br>
                                            {!! trans('job_application.Weekly') !!}
                                            @if ($job_request->paid == 1)
                                                <input type="radio" value="1" checked name="workers_paid">
                                            @else
                                                <input type="radio" value="1" name="workers_paid">
                                            @endif
                                            &nbsp;&nbsp;
                                            {!! trans('job_application.Bi-weekly') !!}
                                            @if ($job_request->paid == 2)
                                                <input type="radio" value="2" checked name="workers_paid">
                                            @else
                                                <input type="radio" value="2" name="workers_paid">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.uniform') !!}</label>
                                            <br>
                                            {!! trans('job_application.Yes') !!}
                                            @if ($job_request->is_uniform_required == 1)
                                                <input type="radio" value="1" checked name="is_uniform_required"
                                                    id="is_uniform_required" onclick="show_div_uniform();">
                                            @else
                                                <input type="radio" value="1" name="is_uniform_required"
                                                    id="is_uniform_required" onclick="show_div_uniform();">
                                            @endif
                                            &nbsp;&nbsp;
                                            {!! trans('job_application.No') !!}
                                            @if ($job_request->is_uniform_required == 0)
                                                <input type="radio" value="0" checked name="is_uniform_required"
                                                    onclick="show_div_uniform();">
                                            @else
                                                <input type="radio" value="0" name="is_uniform_required"
                                                    onclick="show_div_uniform();">
                                            @endif
                                        </div>
                                        <label for="exampleInputEmail1">{!! trans('job_application.message3') !!}</label>
                                    </div>

                                    <div class="col-md-6" id="div_uniform">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.uniform_pieces') !!}</label>
                                            <input type="text" name="uniform_pieces_required"
                                                value="{{ $job_request->uniform_pieces_required }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                                            <input type="text" name="job_notes" value="{{ $job_request->job_notes }}"
                                                class="form-control">
                                        </div>
                                        <label for="exampleInputEmail1">{!! trans('job_application.additional_space') !!}</label>
                                    </div>





                                    <div class="col-sm-12 form-group">
                                        <button type="submit" class="btn btn-primary float-right">Next</button>
                                    </div>

                                </div>

                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab2">
                            <br>
                            <h3>POSITION(S) NEEDED</h3>
                            <div class="col-md-12">&nbsp;</div>
                            <div class="col-sm-12 form-group">
                                <a href="{{ url('job_request_detail/create') }}/{{ $job_request->id }}">
                                    <button type="button" class="btn btn-primary float-right">Add Position</button>
                                </a>
                            </div>
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
                                        @foreach ($details as $obj)
                                            <tr>
                                                <td>{{ $obj->id }} {{ $obj->title->title }}</td>
                                                <td>{{ $obj->number_workers }}</td>
                                                <td>{{ $obj->ant_workday_total_hours }}</td>
                                                <td align="center">
                                                    &nbsp;&nbsp;
                                                    <i class="fa fa-trash fa-lg"
                                                        onclick="modal_delete({{ $obj->id }})"></i>
                                                    &nbsp;&nbsp;
                                                    <a href="{{ url('job_request_detail') }}/{{ $obj->id }}/edit"
                                                        class="on-default edit-row">
                                                        <i class="fa fa-pencil fa-lg"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>










                            <!-- modal delete detail -->
                            <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{!! trans('job_application.Position') !!}</h5>
                                            <button type="button" class="close"
                                                data-dismiss="modal"><span>&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ url('job_request_detail/delete') }}">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="hidden" id="id_detail" name="id">
                                                        <h5>Do you want to delete the record?</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end delete modal -->

                        </div>
                        <div class="tab-pane fade" id="tab3">







                            <form method="POST" action="{{ url('job_request_deductions') }}">
                                @csrf
                                <div class="col-xl-12 col-xxl-12 row">
                                    <div class="col-sm-12">&nbsp;</div>
                                    <div class="col-md-12">
                                        <h3>{!! trans('job_application.tab3_title') !!}</h3>
                                        <p>{!! trans('job_application.tab3_title2') !!}</p>
                                        <h5>{!! trans('job_application.tab3_title3') !!}</h5>
                                        <div class="form-group">
                                            <input type="hidden" id="request_id" name="request_id"
                                                value="{{ $job_request->id }}">
                                            <label for="exampleInputUsername1">{!! trans('job_application.select_deductions') !!}</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @if ($deduction)
                                                        @if ($deduction->housing_utilities == 1)
                                                            <input type="checkbox" id="Housing" name="Housing" checked
                                                                onclick="validHousing();">
                                                            <label
                                                                for="exampleInputUsername1">{!! trans('job_application.Housing') !!}</label>
                                                        @endif
                                                        @if ($deduction->housing_utilities == 0)
                                                            <input type="checkbox" id="Housing" name="Housing"
                                                                onclick="validHousing();">
                                                            <label
                                                                for="exampleInputUsername1">{!! trans('job_application.Housing') !!}</label>
                                                        @endif
                                                    @else
                                                        <input type="checkbox" id="Housing" name="Housing"
                                                            onclick="validHousing();">
                                                        <label for="exampleInputUsername1">{!! trans('job_application.Housing') !!}</label>
                                                    @endif



                                                    <br>
                                                    @if ($deduction)
                                                        @if ($deduction->medical == 1)
                                                            <input type="checkbox" id="Medical" name="Medical" checked
                                                                onclick="validMedical();"> <label
                                                                for="exampleInputUsername1">{!! trans('job_application.Medical') !!}</label>
                                                        @endif
                                                        @if ($deduction->medical == 0)
                                                            <input type="checkbox" id="Medical" name="Medical"
                                                                onclick="validMedical();">
                                                            <label
                                                                for="exampleInputUsername1">{!! trans('job_application.Medical') !!}</label>
                                                        @endif
                                                    @else
                                                        <input type="checkbox" id="Medical" name="Medical"
                                                            onclick="validMedical();">
                                                        <label for="exampleInputUsername1">{!! trans('job_application.Medical') !!}</label>
                                                    @endif



                                                    <br>
                                                    @if ($deduction)
                                                        @if ($deduction->daily_transportation == 1)
                                                            <input type="checkbox"
                                                                id="DailyTransportation"name="DailyTransportation" checked
                                                                onclick="validDaily();"> <label
                                                                for="exampleInputUsername1">{!! trans('job_application.DailyTransportation') !!}</label>
                                                        @endif
                                                        @if ($deduction->daily_transportation == 0)
                                                            <input type="checkbox"
                                                                id="DailyTransportation"name="DailyTransportation"
                                                                onclick="validDaily();"> <label
                                                                for="exampleInputUsername1">{!! trans('job_application.DailyTransportation') !!}</label>
                                                        @endif
                                                    @else
                                                        <input type="checkbox"
                                                            id="DailyTransportation"name="DailyTransportation"
                                                            onclick="validDaily();"> <label
                                                            for="exampleInputUsername1">{!! trans('job_application.DailyTransportation') !!}</label>
                                                    @endif



                                                </div>

                                                <div class="col-md-6">
                                                    @if ($deduction)
                                                        @if ($deduction->other == 1)
                                                            <input type="checkbox" id="Other" name="Other" checked
                                                                onclick="validOther();"> <label
                                                                for="exampleInputUsername1">{!! trans('job_application.Other') !!}</label>
                                                        @endif
                                                        @if ($deduction->other == 0)
                                                            <input type="checkbox" id="Other" name="Other"
                                                                onclick="validOther();"> <label
                                                                for="exampleInputUsername1">{!! trans('job_application.Other') !!}</label>
                                                        @endif
                                                    @else
                                                        <input type="checkbox" id="Other" name="Other"
                                                            onclick="validOther();"> <label
                                                            for="exampleInputUsername1">{!! trans('job_application.Other') !!}</label>
                                                    @endif


                                                    <br>
                                                    @if ($deduction)
                                                        @if ($deduction->meals == 1)
                                                            <input type="checkbox" id="Meals" name="Meals" checked
                                                                onclick="validMeals();"> <label
                                                                for="exampleInputUsername1">{!! trans('job_application.Meals') !!}</label>
                                                        @endif
                                                        @if ($deduction->meals == 0)
                                                            <input type="checkbox" id="Meals" name="Meals"
                                                                onclick="validMeals();"> <label
                                                                for="exampleInputUsername1">{!! trans('job_application.Meals') !!}</label>
                                                        @endif
                                                    @else
                                                        <input type="checkbox" id="Meals" name="Meals"
                                                            onclick="validMeals();"> <label
                                                            for="exampleInputUsername1">{!! trans('job_application.Meals') !!}</label>
                                                    @endif


                                                    <br>
                                                    @if ($deduction)
                                                        @if ($deduction->no_deduction == 1)
                                                            <input type="checkbox" id="NoDeductions" name="NoDeductions"
                                                                checked onclick="validNoDeductions();"> <label
                                                                for="exampleInputUsername1">{!! trans('job_application.NoDeductions') !!}</label>
                                                        @endif
                                                        @if ($deduction->no_deduction == 0)
                                                            <input type="checkbox" id="NoDeductions" name="NoDeductions"
                                                                onclick="validNoDeductions();"> <label
                                                                for="exampleInputUsername1">{!! trans('job_application.NoDeductions') !!}</label>
                                                        @endif
                                                    @else
                                                        <input type="checkbox" id="NoDeductions" name="NoDeductions"
                                                            onclick="validNoDeductions();"> <label
                                                            for="exampleInputUsername1">{!! trans('job_application.NoDeductions') !!}</label>
                                                    @endif



                                                </div>

                                                <div class="col-sm-12">&nbsp;</div>
                                                <div class="col-sm-12">&nbsp;</div>

                                                <div id="content" class="col-sm-12 row">

                                                </div>




                                            </div>
                                        </div>

                                    </div>
                                </div>



                                {{-- divHousing --}}
                                <div id="divHousing">
                                    <div class="col-sm-12">
                                        <div class="card-header">
                                            <h4 class="card-title">{!! trans('job_application.HousingTitle') !!}</h4>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.DeductionAmount') !!}</label>
                                                    @if ($deduction)
                                                        <input type="number" min="1" step="0.01"
                                                            name="deduction_housing_amount_person_week"
                                                            value="{{ old('deduction_housing_amount_person_week', $deduction->deduction_housing_amount_person_week) }}"
                                                            class="form-control">
                                                    @else
                                                        <input type="number" min="1" step="0.01"
                                                            name="deduction_housing_amount_person_week"
                                                            value="{{ old('deduction_housing_amount_person_week') }}"
                                                            class="form-control">
                                                    @endif

                                                </div>

                                                <div id="showPleaseUtilities">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{!! trans('job_application.PleaseUtilities') !!}</label>
                                                        @if ($deduction)
                                                            <input type="text" name="explain_housing_utilities"
                                                                value="{{ old('explain_housing_utilities', $deduction->explain_housing_utilities) }}"
                                                                class="form-control">
                                                        @else
                                                            <input type="text" name="explain_housing_utilities"
                                                                value="{{ old('explain_housing_utilities') }}"
                                                                class="form-control">
                                                        @endif


                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.RequiredHousing') !!}</label>
                                                    <br>
                                                    &nbsp;&nbsp; &nbsp;&nbsp;
                                                    {!! trans('job_application.Yes') !!}

                                                    @if ($deduction)
                                                        @if ($deduction->is_deposit_required == 1)
                                                            <input type="radio" name="is_deposit_required"
                                                                id="is_deposit_required" checked value="1"
                                                                onClick="validIsDeposit()">
                                                        @else
                                                            <input type="radio" name="is_deposit_required"
                                                                id="is_deposit_required" value="1"
                                                                onClick="validIsDeposit()">
                                                        @endif
                                                    @else
                                                        <input type="radio" name="is_deposit_required"
                                                            id="is_deposit_required" onClick="validIsDeposit()">
                                                    @endif



                                                    &nbsp;&nbsp;
                                                    {!! trans('job_application.No') !!}

                                                    @if ($deduction)
                                                        @if ($deduction->is_deposit_required == 0)
                                                            <input type="radio" name="is_deposit_required"
                                                                id="is_deposit_required" checked value="0"
                                                                onClick="validIsDeposit()">
                                                        @else
                                                            <input type="radio" name="is_deposit_required"
                                                                id="is_deposit_required" value="0"
                                                                onClick="validIsDeposit()">
                                                        @endif
                                                    @else
                                                        <input type="radio" name="is_deposit_required"
                                                            id="is_deposit_required" onClick="validIsDeposit()">
                                                    @endif



                                                    &nbsp;&nbsp;
                                                    <br>
                                                </div>
                                                <div id="showIsDepositRequired">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{!! trans('job_application.DepositAmount') !!}</label>
                                                        @if ($deduction)
                                                            <input type="number" step="0.01" name="deposit_amount"
                                                                @if ($deduction->deposit_amount) value="{{ old('deposit_amount', $deduction->deposit_amount) }}" @endif
                                                                class="form-control">
                                                        @else
                                                            <input type="number" step="0.01" name="deposit_amount"
                                                                value="{{ old('deposit_amount') }}" class="form-control">
                                                        @endif

                                                    </div>

                                                    <label for="exampleInputEmail1">{!! trans('job_application.IsDepositRefundable') !!}</label>
                                                    <br>
                                                    &nbsp;&nbsp; &nbsp;&nbsp;
                                                    {!! trans('job_application.Yes') !!}

                                                    @if ($deduction)
                                                        @if ($deduction->is_deposit_refundable == 1)
                                                            <input type="radio" name="is_deposit_refundable"
                                                                id="is_deposit_refundable" checked value="1">
                                                        @else
                                                            <input type="radio" name="is_deposit_refundable"
                                                                id="is_deposit_refundable" value="1">
                                                        @endif
                                                    @else
                                                        <input type="radio" name="is_deposit_refundable"
                                                            id="is_deposit_refundable">
                                                    @endif



                                                    &nbsp;&nbsp;
                                                    {!! trans('job_application.No') !!}
                                                    @if ($deduction)
                                                        @if ($deduction->is_deposit_refundable == 0)
                                                            <input type="radio" name="is_deposit_refundable"
                                                                id="is_deposit_refundable" checked value="0">
                                                        @else
                                                            <input type="radio" name="is_deposit_refundable"
                                                                id="is_deposit_refundable" value="0">
                                                        @endif
                                                    @else
                                                        <input type="radio" name="is_deposit_refundable"
                                                            id="is_deposit_refundable">
                                                    @endif
                                                    &nbsp;&nbsp;
                                                    <br>


                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.HousingDeduction') !!}</label>
                                                    <br>
                                                    &nbsp;&nbsp; &nbsp;&nbsp;
                                                    {!! trans('job_application.Yes') !!}

                                                    @if ($deduction)
                                                        @if ($deduction->housing_includes_utilities == 1)
                                                            <input type="radio" name="housing_utilities"
                                                                id="housing_utilities" value="1" checked
                                                                onClick="validUtilities()">
                                                        @else
                                                            <input type="radio" name="housing_utilities"
                                                                id="housing_utilities" value="1"
                                                                onClick="validUtilities()">
                                                        @endif
                                                    @else
                                                        <input type="radio" name="housing_utilities"
                                                            id="housing_utilities" onClick="validUtilities()">
                                                    @endif



                                                    &nbsp;&nbsp;
                                                    {!! trans('job_application.No') !!}

                                                    @if ($deduction)
                                                        @if ($deduction->housing_includes_utilities == 0)
                                                            <input type="radio" name="housing_utilities"
                                                                id="housing_utilities" value="0" checked
                                                                onClick="validUtilities()">
                                                        @else
                                                            <input type="radio" name="housing_utilities"
                                                                id="housing_utilities" value="0"
                                                                onClick="validUtilities()">
                                                        @endif
                                                    @else
                                                        <input type="radio" name="housing_utilities"
                                                            id="housing_utilities" onClick="validUtilities()">
                                                    @endif

                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>

                                                    @if ($deduction)
                                                        <input type="text" name="housing_notes"
                                                            value="{{ old('housing_notes', $deduction->housing_notes) }}"
                                                            class="form-control">
                                                    @else
                                                        <input type="text" name="housing_notes"
                                                            value="{{ old('housing_notes') }}" class="form-control">
                                                    @endif

                                                    <label for="exampleInputEmail1">{!! trans('job_application.additional_notes_housing') !!}</label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>



                                {{-- divMedical --}}
                                <div id="divMedical">
                                    <div class="col-sm-12">
                                        <div>
                                            <h4>
                                                <b>
                                                    {!! trans('job_application.NoDeductionsTitle') !!}
                                                </b>
                                            </h4>
                                        </div>
                                        <br>
                                        <br>

                                        <h4>
                                            <b>
                                                {!! trans('job_application.MedicalTitle') !!}
                                            </b>
                                        </h4>
                                        <div class="card-header">

                                            <h4 class="card-title">{!! trans('job_application.SelectDeductions') !!}</h4>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    @if ($deduction)
                                                        @if ($deduction->deduction_medical_paycheck == 1)
                                                            <input type="checkbox" id="ChkMedical" name="ChkMedical"
                                                                checked onchange="validDeductionMedical();">&nbsp;&nbsp;
                                                            <label for="exampleInputEmail1">Medical</label>
                                                        @endif
                                                        @if ($deduction->deduction_medical_paycheck == 0)
                                                            <input type="checkbox" id="ChkMedical" name="ChkMedical"
                                                                onchange="validDeductionMedical();">&nbsp;&nbsp;
                                                            <label for="exampleInputEmail1">Medical</label>
                                                        @endif
                                                    @else
                                                        <input type="checkbox" id="ChkMedical" name="ChkMedical"
                                                            onchange="validDeductionMedical();">&nbsp;&nbsp;
                                                        <label for="exampleInputEmail1">Medical</label>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    @if ($deduction)
                                                        @if ($deduction->deduction_dental_paycheck == 1)
                                                            <input type="checkbox" id="ChkDental" name="ChkDental"
                                                                checked onchange="validDeductionDental();">&nbsp;&nbsp;
                                                            <label for="exampleInputEmail1">Dental</label>
                                                        @endif
                                                        @if ($deduction->deduction_dental_paycheck == 0)
                                                            <input type="checkbox" id="ChkDental" name="ChkDental"
                                                                onchange="validDeductionDental();">&nbsp;&nbsp;
                                                            <label for="exampleInputEmail1">Dental</label>
                                                        @endif
                                                    @else
                                                        <input type="checkbox" id="ChkDental" name="ChkDental"
                                                            onchange="validDeductionDental();">&nbsp;&nbsp;
                                                        <label for="exampleInputEmail1">Dental</label>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    @if ($deduction)
                                                        @if ($deduction->deduction_vision_paycheck == 1)
                                                            <input type="checkbox" id="ChkVision" name="ChkVision"
                                                                checked onchange="validDeductionVision();">&nbsp;&nbsp;
                                                            <label for="exampleInputEmail1">Vision</label>
                                                        @endif
                                                        @if ($deduction->deduction_vision_paycheck == 0)
                                                            <input type="checkbox" id="ChkVision" name="ChkVision"
                                                                onchange="validDeductionVision();">&nbsp;&nbsp;
                                                            <label for="exampleInputEmail1">Vision</label>
                                                        @endif
                                                    @else
                                                        <input type="checkbox" id="ChkVision" name="ChkVision"
                                                            onchange="validDeductionVision();">&nbsp;&nbsp;
                                                        <label for="exampleInputEmail1">Vision</label>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    @if ($deduction)
                                                        @if ($deduction->deduction_other_paycheck == 1)
                                                            <input type="checkbox" id="ChkOther" name="ChkOther" checked
                                                                onchange="validDeductionOther();">&nbsp;&nbsp;
                                                            <label for="exampleInputEmail1">Other</label>
                                                        @endif
                                                        @if ($deduction->deduction_other_paycheck == 0)
                                                            <input type="checkbox" id="ChkOther" name="ChkOther"
                                                                onchange="validDeductionOther();">&nbsp;&nbsp;
                                                            <label for="exampleInputEmail1">Other</label>
                                                        @endif
                                                    @else
                                                        <input type="checkbox" id="ChkOther" name="ChkOther"
                                                            onchange="validDeductionOther();">&nbsp;&nbsp;
                                                        <label for="exampleInputEmail1">Other</label>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>






                                        <div id="divDeductionMedical">
                                            <div class="col-sm-12">
                                                <div class="card-header">
                                                    <h4 class="card-title"></h4>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.DeductionAmountMedical') !!}</label>
                                                            @if ($deduction_medical)
                                                                <input type="number" step="0.01"
                                                                    name="deduction_medical_paycheck"
                                                                    value="{{ old('deduction_medical_paycheck', $deduction_medical->deduction_ammount) }}"
                                                                    class="form-control">
                                                            @else
                                                                <input type="number" step="0.01"
                                                                    name="deduction_medical_paycheck"
                                                                    class="form-control">
                                                            @endif

                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.PlansPremium') !!}</label>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                                                            @if ($deduction_medical)
                                                                <input type="text" name="deduction_medical_note"
                                                                    value="{{ old('deduction_medical_note', $deduction_medical->comments) }}"
                                                                    class="form-control">
                                                            @else
                                                                <input type="text" name="deduction_medical_note"
                                                                    class="form-control">
                                                            @endif

                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.additional_notes_medical') !!}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div id="divDeductionDental">
                                            <div class="col-sm-12">
                                                <div class="card-header">
                                                    <h4 class="card-title"></h4>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.DeductionAmountDental') !!}</label>
                                                            @if ($deduction_dental)
                                                                <input type="number" step="0.01"
                                                                    name="deduction_dental_paycheck"
                                                                    value="{{ old('deduction_dental_paycheck', $deduction_dental->deduction_ammount) }}"
                                                                    class="form-control">
                                                            @else
                                                                <input type="number" step="0.01"
                                                                    name="deduction_dental_paycheck" class="form-control">
                                                            @endif

                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.PlansPremium') !!}</label>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                                                            @if ($deduction_dental)
                                                                <input type="text" name="deduction_dental_note"
                                                                    value="{{ old('deduction_dental_note', $deduction_dental->comments) }}"
                                                                    class="form-control">
                                                            @else
                                                                <input type="text" name="deduction_dental_note"
                                                                    class="form-control">
                                                            @endif

                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.additional_notes_medical') !!}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div id="divDeductionVision">
                                            <div class="col-sm-12">
                                                <div class="card-header">
                                                    <h4 class="card-title"></h4>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.DeductionAmountVision') !!}</label>
                                                            @if ($deduction_vision)
                                                                <input type="number" step="0.01"
                                                                    name="deduction_vision_paycheck"
                                                                    value="{{ old('deduction_vision_paycheck', $deduction_vision->deduction_ammount) }}"
                                                                    class="form-control">
                                                            @else
                                                                <input type="number" step="0.01"
                                                                    name="deduction_vision_paycheck" class="form-control">
                                                            @endif

                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.PlansPremium') !!}</label>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                                                            @if ($deduction_vision)
                                                                <input type="text" name="deduction_vision_note"
                                                                    value="{{ old('deduction_vision_note', $deduction_vision->comments) }}"
                                                                    class="form-control">
                                                            @else
                                                                <input type="text" name="deduction_vision_note"
                                                                    class="form-control">
                                                            @endif

                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.additional_notes_medical') !!}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div id="divDeductionOther">
                                            <div class="col-sm-12">
                                                <div class="card-header">
                                                    <h4 class="card-title"></h4>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.DeductionAmountOther') !!}</label>
                                                            @if ($deduction_other)
                                                                <input type="number" step="0.01"
                                                                    name="deduction_other_paycheck"
                                                                    value="{{ old('deduction_other_paycheck', $deduction_other->deduction_ammount) }}"
                                                                    class="form-control">
                                                            @else
                                                                <input type="number" step="0.01"
                                                                    name="deduction_other_paycheck" class="form-control">
                                                            @endif

                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.PlansPremium') !!}</label>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                                                            @if ($deduction_other)
                                                                <input type="text" name="deduction_other_note"
                                                                    value="{{ old('deduction_other_note', $deduction_other->comments) }}"
                                                                    class="form-control">
                                                            @else
                                                                <input type="text" name="deduction_other_note"
                                                                    class="form-control">
                                                            @endif

                                                            <label
                                                                for="exampleInputEmail1">{!! trans('job_application.additional_notes_medical') !!}</label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>





                                    </div>

                                    <div class="col-sm-12" id="div_deductions">
                                    </div>

                                </div>



                                {{-- divDaily --}}
                                <div id="divDaily">
                                    <div>
                                        <h4>
                                            <b>
                                                {!! trans('job_application.NoDeductionsTitle') !!}
                                            </b>
                                        </h4>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="card-header">
                                            <h4 class="card-title">{!! trans('job_application.DailyTransportationTitle') !!}</h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.DeductionPerWeek') !!}</label>
                                                    @if ($deduction)
                                                        <input type="number" step="0.01"
                                                            name="deduction_daily_amount_person_week"
                                                            value="{{ old('deduction_daily_amount_person_week', $deduction->deduction_daily_amount_person_week) }}"
                                                            class="form-control">
                                                    @else
                                                        <input type="number" step="0.01"
                                                            name="deduction_daily_amount_person_week"
                                                            value="{{ old('deduction_daily_amount_person_week') }}"
                                                            class="form-control">
                                                    @endif
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                                                    @if ($deduction)
                                                        <input type="text" name="daily_notes"
                                                            value="{{ old('daily_notes', $deduction->daily_notes) }}"
                                                            class="form-control">
                                                    @else
                                                        <input type="text" name="daily_notes"
                                                            value="{{ old('daily_notes') }}" class="form-control">
                                                    @endif
                                                    <label for="exampleInputEmail1">{!! trans('job_application.additional_notes_daily_transportation') !!}</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div id="divOther">
                                    <div>
                                        <h4>
                                            <b>
                                                {!! trans('job_application.NoDeductionsTitle') !!}
                                            </b>
                                        </h4>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="card-header">
                                            <h4 class="card-title">{!! trans('job_application.OtherTitle') !!}
                                                <br>({!! trans('job_application.listAdditionalDeduction') !!})
                                            </h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.OtherTitle') !!}</label>
                                                    @if ($deduction)
                                                        <input type="text" name="other_deductions"
                                                            value="{{ old('other_deductions', $deduction->other_deductions) }}"
                                                            class="form-control">
                                                    @else
                                                        <input type="text" name="other_deductions"
                                                            value="{{ old('other_deductions') }}" class="form-control">
                                                    @endif

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div id="divMeals">
                                    <div class="col-sm-12">
                                        <div class="card-header">
                                            <div>
                                                <h4>
                                                    <b>
                                                        {!! trans('job_application.NoDeductionsTitle') !!}
                                                    </b>
                                                </h4>
                                            </div>
                                        </div>

                                        <div>
                                            <h4 class="card-title">{!! trans('job_application.MealsTitle') !!}</h4>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.MealsPerShift') !!}</label>
                                                    @if ($deduction)
                                                        <input type="number" min="1"
                                                            name="how_many_meals_provided"
                                                            value="{{ old('how_many_meals_provided', $deduction->how_many_meals_provided) }}"
                                                            class="form-control">
                                                    @else
                                                        <input type="number" min="1"
                                                            name="how_many_meals_provided"
                                                            value="{{ old('how_many_meals_provided') }}"
                                                            class="form-control">
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.EnterCost') !!}</label>
                                                    @if ($deduction)
                                                        <input type="number" step="0.01" min="0.01"
                                                            name="cost_per_meal"
                                                            value="{{ old('cost_per_meal', $deduction->cost_per_meal) }}"
                                                            class="form-control">
                                                    @else
                                                        <input type="number" step="0.01" min="0.01"
                                                            name="cost_per_meal" value="{{ old('cost_per_meal') }}"
                                                            class="form-control">
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                                                    @if ($deduction)
                                                        <input type="text" name="meals_notes"
                                                            value="{{ old('meals_notes', $deduction->meals_notes) }}"
                                                            class="form-control">
                                                    @else
                                                        <input type="text" name="meals_notes"
                                                            value="{{ old('meals_notes') }}" class="form-control">
                                                    @endif
                                                    <label for="exampleInputEmail1">{!! trans('job_application.AdditionalNotesMeals') !!}</label>
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.ThereCost') !!}</label>
                                                    <br>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    {!! trans('job_application.Yes') !!}
                                                    @if ($deduction)
                                                        @if ($deduction->is_there_cost_per_meal == 1)
                                                            <input type="radio" name="is_there_costo_per_meal"
                                                                id="is_there_costo_per_meal" value="1" checked>
                                                        @else
                                                            <input type="radio" name="is_there_costo_per_meal"
                                                                id="is_there_costo_per_meal" value="1">
                                                        @endif
                                                    @else
                                                        <input type="radio" name="is_there_costo_per_meal"
                                                            id="is_there_costo_per_meal">
                                                    @endif


                                                    &nbsp;&nbsp;
                                                    {!! trans('job_application.No') !!}
                                                    @if ($deduction)
                                                        @if ($deduction->is_there_cost_per_meal == 0)
                                                            <input type="radio" name="is_there_costo_per_meal"
                                                                id="is_there_costo_per_meal" value="0" checked>
                                                        @else
                                                            <input type="radio" name="is_there_costo_per_meal"
                                                                id="is_there_costo_per_meal" value="0">
                                                        @endif
                                                    @else
                                                        <input type="radio" name="is_there_costo_per_meal"
                                                            id="is_there_costo_per_meal">
                                                    @endif

                                                    &nbsp;&nbsp;
                                                    <br>
                                                    <br>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.EnterDeduction') !!}</label>
                                                    @if ($deduction)
                                                        <input type="number" step="0.01" min="0.01"
                                                            name="deduction_amount_per_meal"
                                                            value="{{ old('deduction_amount_per_meal', $deduction->deduction_amount_per_meal) }}"
                                                            class="form-control">
                                                    @else
                                                        <input type="number" step="0.01" min="0.01"
                                                            name="deduction_amount_per_meal"
                                                            value="{{ old('deduction_amount_per_meal') }}"
                                                            class="form-control">
                                                    @endif
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>


                                <div id="divNoDeductions">
                                    <div>
                                        <h4>
                                            <b>
                                                {!! trans('job_application.NoDeductionsTitle') !!}
                                            </b>
                                        </h4>
                                    </div>
                                </div>


                                <div class="col-sm-12 form-group">
                                    <button type="submit" class="btn btn-primary float-right">Next</button>
                                </div>

                            </form>
















                        </div>
                        <div class="tab-pane fade" id="tab4">
                            <form method="POST" action="{{ url('job_request_requirements') }}">
                                <input type="hidden" id="request_id" name="request_id" value="{{ $job_request->id }}">
                                @csrf
                                <br>
                                <h3>JOB REQUIREMENTS / CONDITIONS OF EMPLOYMENT</h3>
                                <p>Background checks, drug testing and/or other job requirements and conditions of
                                    employment
                                    must not favor either U.S. or H-2B workers, they must be applied on an equal basis for
                                    all
                                    employees.</p>
                                <h5>All job requirements and conditions of employment must be disclosed in the Job Order.
                                </h5>
                                <h5>{!! trans('job_application.BackgroundChecks') !!} </h5>

                                <div class="col-xl-12 col-xxl-12">
                                    <div class="col-sm-12">&nbsp;</div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.IsBackgroundChecks') !!}</label>
                                            <br>
                                            &nbsp;&nbsp;&nbsp;{!! trans('job_application.Yes') !!}
                                            @if ($bgcheck_reg)
                                                @if ($bgcheck_reg->is_background_check_required == 1)
                                                    <input type="radio" name="is_background_check_required"
                                                        id="is_background_check_required" value="1" checked
                                                        onClick="validCriminal()">
                                                @else
                                                    <input type="radio" name="is_background_check_required"
                                                        id="is_background_check_required" value="1"
                                                        onClick="validCriminal()">
                                                @endif
                                            @else
                                                <input type="radio" name="is_background_check_required"
                                                    id="is_background_check_required" value="1"
                                                    onClick="validCriminal()">
                                            @endif


                                            &nbsp;&nbsp;
                                            {!! trans('job_application.No') !!}
                                            @if ($bgcheck_reg)
                                                @if ($bgcheck_reg->is_background_check_required == 0)
                                                    <input type="radio" name="is_background_check_required"
                                                        id="is_background_check_required" value="0" checked
                                                        onClick="validCriminal()">
                                                @else
                                                    <input type="radio" name="is_background_check_required"
                                                        id="is_background_check_required" value="0"
                                                        onClick="validCriminal()">
                                                @endif
                                            @else
                                                <input type="radio" name="is_background_check_required"
                                                    id="is_background_check_required" value="0"
                                                    onClick="validCriminal()">
                                            @endif

                                            <br>
                                            <label for="exampleInputEmail1">{!! trans('job_application.AppliesAllApplicants') !!}</label>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <div id="divCriminal">
                                                <label for="exampleInputEmail1">{!! trans('job_application.CheckCriminalHistory') !!}</label>
                                                <br>
                                                &nbsp;&nbsp;&nbsp;{!! trans('job_application.Yes') !!}
                                                @if ($bgcheck_reg)
                                                    @if ($bgcheck_reg->is_included_criminal_history == 1)
                                                        <input type="radio" name="is_included_criminal_history"
                                                            id="is_included_criminal_history" value="1" checked>
                                                    @else
                                                        <input type="radio" name="is_included_criminal_history"
                                                            id="is_included_criminal_history" value="1">
                                                    @endif
                                                @else
                                                    <input type="radio" name="is_included_criminal_history"
                                                        id="is_included_criminal_history" value="1">
                                                @endif

                                                &nbsp;&nbsp;
                                                {!! trans('job_application.No') !!}
                                                @if ($bgcheck_reg)
                                                    @if ($bgcheck_reg->is_included_criminal_history == 0)
                                                        <input type="radio" name="is_included_criminal_history"
                                                            id="is_included_criminal_history" value="0" checked>
                                                    @else
                                                        <input type="radio" name="is_included_criminal_history"
                                                            id="is_included_criminal_history" value="0">
                                                    @endif
                                                @else
                                                    <input type="radio" name="is_included_criminal_history"
                                                        id="is_included_criminal_history" value="0">
                                                @endif


                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.BackgroundChecksConducted') !!}</label>
                                                    <br>
                                                    &nbsp;&nbsp;
                                                    @if ($bgcheck_reg)
                                                        @if ($bgcheck_reg->is_background_check_pre_employement == 1)
                                                            <input type="checkbox"
                                                                id="is_background_check_pre_employement"
                                                                name="is_background_check_pre_employement"
                                                                checked>&nbsp;&nbsp;
                                                        @endif
                                                        @if ($bgcheck_reg->is_background_check_pre_employement == 0)
                                                            <input type="checkbox"
                                                                id="is_background_check_pre_employement"
                                                                name="is_background_check_pre_employement">&nbsp;&nbsp;
                                                        @endif
                                                    @else
                                                        <input type="checkbox" id="is_background_check_pre_employement"
                                                            name="is_background_check_pre_employement">&nbsp;&nbsp;
                                                    @endif

                                                    &nbsp;&nbsp;
                                                    {!! trans('job_application.Pre-employment') !!}

                                                    &nbsp;&nbsp;
                                                    @if ($bgcheck_reg)
                                                        @if ($bgcheck_reg->is_background_check_post_employement == 1)
                                                            <input type="checkbox"
                                                                id="is_background_check_post_employement"
                                                                name="is_background_check_post_employement"
                                                                checked>&nbsp;&nbsp;
                                                        @endif
                                                        @if ($bgcheck_reg->is_background_check_post_employement == 0)
                                                            <input type="checkbox"
                                                                id="is_background_check_post_employement"
                                                                name="is_background_check_post_employement">&nbsp;&nbsp;
                                                        @endif
                                                    @else
                                                        <input type="checkbox" id="is_background_check_post_employement"
                                                            name="is_background_check_post_employement">&nbsp;&nbsp;
                                                    @endif

                                                    &nbsp;&nbsp;
                                                    {!! trans('job_application.Post-employment') !!}

                                                    &nbsp;&nbsp;
                                                    @if ($bgcheck_reg)
                                                        @if ($bgcheck_reg->is_background_check_other == 1)
                                                            <input type="checkbox" id="is_background_check_other"
                                                                name="is_background_check_other"
                                                                onclick="validOtherDescription()" checked>&nbsp;&nbsp;
                                                        @endif
                                                        @if ($bgcheck_reg->is_background_check_other == 0)
                                                            <input type="checkbox" id="is_background_check_other"
                                                                name="is_background_check_other"
                                                                onclick="validOtherDescription()">&nbsp;&nbsp;
                                                        @endif
                                                    @else
                                                        <input type="checkbox" id="is_background_check_other"
                                                            name="is_background_check_other"
                                                            onclick="validOtherDescription()">&nbsp;&nbsp;
                                                    @endif

                                                    &nbsp;&nbsp;
                                                    {!! trans('job_application.Other') !!}

                                                    <br>
                                                    <label for="exampleInputEmail1">{!! trans('job_application.SelectApply') !!}</label>
                                                </div>

                                                <div id="divOtherDescription">
                                                    <div class="form-group">
                                                        <label
                                                            for="exampleInputUsername1">{!! trans('job_application.OtherPleaseDescribe') !!}</label>
                                                        @if ($bgcheck_reg)
                                                            <input type="text" name="others_description"
                                                                value="{{ old('others_description', $bgcheck_reg->others_description) }}"
                                                                class="form-control">
                                                        @else
                                                            <input type="text" name="others_description"
                                                                value="{{ old('others_description') }}"
                                                                class="form-control">
                                                        @endif

                                                    </div>
                                                </div>


                                            </div>

                                        </div>

                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.DrugTesting') !!}</label>
                                            <br>
                                            &nbsp;&nbsp;&nbsp;{!! trans('job_application.Yes') !!}
                                            @if ($bgcheck_reg)
                                                @if ($bgcheck_reg->is_drug_testing_required == 1)
                                                    <input type="radio" name="is_drug_testing_required"
                                                        onclick="validDrugTesting()" id="is_drug_testing_required"
                                                        value="1" checked>
                                                @else
                                                    <input type="radio" name="is_drug_testing_required"
                                                        onclick="validDrugTesting()" id="is_drug_testing_required"
                                                        value="1">
                                                @endif
                                            @else
                                                <input type="radio" name="is_drug_testing_required"
                                                    onclick="validDrugTesting()" id="is_drug_testing_required"
                                                    value="1">
                                            @endif

                                            &nbsp;&nbsp;
                                            {!! trans('job_application.No') !!}
                                            @if ($bgcheck_reg)
                                                @if ($bgcheck_reg->is_drug_testing_required == 0)
                                                    <input type="radio" name="is_drug_testing_required"
                                                        onclick="validDrugTesting()" id="is_drug_testing_required"
                                                        value="0" checked>
                                                @else
                                                    <input type="radio" name="is_drug_testing_required"
                                                        onclick="validDrugTesting()" id="is_drug_testing_required"
                                                        value="0">
                                                @endif
                                            @else
                                                <input type="radio" name="is_drug_testing_required"
                                                    onclick="validDrugTesting()" id="is_drug_testing_required"
                                                    value="0">
                                            @endif

                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <div id="divDrugTesting">
                                                <label for="exampleInputEmail1">{!! trans('job_application.DrugTestingConducted') !!}</label>
                                                <br>
                                                &nbsp;&nbsp;
                                                @if ($bgcheck_reg)
                                                    @if ($bgcheck_reg->is_drug_testing_pre_employment == 1)
                                                        <input type="checkbox" id="is_drug_testing_pre_employment"
                                                            name="is_drug_testing_pre_employment" checked>&nbsp;&nbsp;
                                                    @endif
                                                    @if ($bgcheck_reg->is_drug_testing_pre_employment == 0)
                                                        <input type="checkbox" id="is_drug_testing_pre_employment"
                                                            name="is_drug_testing_pre_employment">&nbsp;&nbsp;
                                                    @endif
                                                @else
                                                    <input type="checkbox" id="is_drug_testing_pre_employment"
                                                        name="is_drug_testing_pre_employment">&nbsp;&nbsp;
                                                @endif

                                                &nbsp;&nbsp;
                                                {!! trans('job_application.Pre-employment') !!}

                                                &nbsp;&nbsp;
                                                @if ($bgcheck_reg)
                                                    @if ($bgcheck_reg->is_drug_testing_post_employment == 1)
                                                        <input type="checkbox" id="is_drug_testing_post_employment"
                                                            name="is_drug_testing_post_employment" checked>&nbsp;&nbsp;
                                                    @endif
                                                    @if ($bgcheck_reg->is_drug_testing_post_employment == 0)
                                                        <input type="checkbox" id="is_drug_testing_post_employment"
                                                            name="is_drug_testing_post_employment">&nbsp;&nbsp;
                                                    @endif
                                                @else
                                                    <input type="checkbox" id="is_drug_testing_post_employment"
                                                        name="is_drug_testing_post_employment">&nbsp;&nbsp;
                                                @endif

                                                &nbsp;&nbsp;
                                                {!! trans('job_application.Post-employment') !!}

                                                &nbsp;&nbsp;
                                                @if ($bgcheck_reg)
                                                    @if ($bgcheck_reg->is_drug_testing_post_injury == 1)
                                                        <input type="checkbox" id="is_drug_testing_post_injury"
                                                            name="is_drug_testing_post_injury" checked>&nbsp;&nbsp;
                                                    @endif
                                                    @if ($bgcheck_reg->is_drug_testing_post_injury == 0)
                                                        <input type="checkbox" id="is_drug_testing_post_injury"
                                                            name="is_drug_testing_post_injury">&nbsp;&nbsp;
                                                    @endif
                                                @else
                                                    <input type="checkbox" id="is_drug_testing_post_injury"
                                                        name="is_drug_testing_post_injury">&nbsp;&nbsp;
                                                @endif

                                                &nbsp;&nbsp;
                                                {!! trans('job_application.PostInjury') !!}


                                                &nbsp;&nbsp;
                                                @if ($bgcheck_reg)
                                                    @if ($bgcheck_reg->is_drug_testing_other == 1)
                                                        <input type="checkbox" id="is_drug_testing_other"
                                                            name="is_drug_testing_other"
                                                            onclick="validTestingOtherDescription()" checked>&nbsp;&nbsp;
                                                    @endif
                                                    @if ($bgcheck_reg->is_drug_testing_other == 0)
                                                        <input type="checkbox" id="is_drug_testing_other"
                                                            name="is_drug_testing_other"
                                                            onclick="validTestingOtherDescription()">&nbsp;&nbsp;
                                                    @endif
                                                @else
                                                    <input type="checkbox" id="is_drug_testing_other"
                                                        name="is_drug_testing_other"
                                                        onclick="validTestingOtherDescription()">&nbsp;&nbsp;
                                                @endif
                                                &nbsp;&nbsp;
                                                {!! trans('job_application.Other') !!}
                                                <br>
                                                <label for="exampleInputEmail1">{!! trans('job_application.SelectApply') !!}</label>

                                                <div id="divTestingOtherDescription">
                                                    <div class="form-group">
                                                        <label
                                                            for="exampleInputUsername1">{!! trans('job_application.OtherPleaseDescribe') !!}</label>
                                                        @if ($bgcheck_reg)
                                                            <input type="text" name="testing_other_description"
                                                                value="{{ old('testing_other_description', $bgcheck_reg->testing_other_description) }}"
                                                                class="form-control">
                                                        @else
                                                            <input type="text" name="testing_other_description"
                                                                value="{{ old('testing_other_description') }}"
                                                                class="form-control">
                                                        @endif



                                                    </div>
                                                </div>
                                            </div>












                                        </div>



                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.JobRequirements') !!}</label>
                                            <br>
                                            &nbsp;&nbsp;&nbsp;{!! trans('job_application.Yes') !!}
                                            @if ($bgcheck_reg)
                                                @if ($bgcheck_reg->are_there_other_requirements == 1)
                                                    <input type="radio" name="are_there_other_requirements"
                                                        onclick="validRequirementsDescription()"
                                                        id="are_there_other_requirements" value="1" checked>
                                                @else
                                                    <input type="radio" name="are_there_other_requirements"
                                                        onclick="validRequirementsDescription()"
                                                        id="are_there_other_requirements" value="1">
                                                @endif
                                            @else
                                                <input type="radio" name="are_there_other_requirements"
                                                    onclick="validRequirementsDescription()"
                                                    id="are_there_other_requirements" value="1">
                                            @endif

                                            &nbsp;&nbsp;
                                            {!! trans('job_application.No') !!}
                                            @if ($bgcheck_reg)
                                                @if ($bgcheck_reg->are_there_other_requirements == 0)
                                                    <input type="radio" name="are_there_other_requirements"
                                                        onclick="validRequirementsDescription()"
                                                        id="are_there_other_requirements" value="0" checked>
                                                @else
                                                    <input type="radio" name="are_there_other_requirements"
                                                        onclick="validRequirementsDescription()"
                                                        id="are_there_other_requirements" value="0">
                                                @endif
                                            @else
                                                <input type="radio" name="are_there_other_requirements"
                                                    onclick="validRequirementsDescription()"
                                                    id="are_there_other_requirements" value="0">
                                            @endif

                                            <br>
                                            {!! trans('job_application.AppliesUS') !!}
                                        </div>

                                        <div id="divRequirementsDescription">
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">{!! trans('job_application.OtherPleaseDescribe') !!}</label>

                                                @if ($bgcheck_reg)
                                                    <input type="text" name="other_requirements_description"
                                                        value="{{ old('other_requirements_description', $bgcheck_reg->other_requirements_description) }}"
                                                        class="form-control">
                                                @else
                                                    <input type="text" name="other_requirements_description"
                                                        value="{{ old('other_requirements_description') }}"
                                                        class="form-control">
                                                @endif



                                            </div>
                                        </div>

                                    </div>


                                </div>






                                <div class="col-sm-12">&nbsp;</div>

                                <h3>{!! trans('job_application.Transportation&Daily') !!}</h3>
                                <h5>{!! trans('job_application.InboundTransportation') !!}</h5>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><strong>{!! trans('job_application.PleaseTransportation') !!}</strong></label>
                                        <br>
                                        @if ($employer_transportation)
                                            <input type="radio" name="arrange_and_pay" id="arrange_and_pay"
                                                @if ($employer_transportation->arrange_and_pay == 1) checked
                                    @else
                                        '' @endif
                                                onclick="validArrangePay()">
                                        @else
                                            <input type="radio" name="arrange_and_pay" id="arrange_and_pay"
                                                onclick="validArrangePay()">
                                        @endif
                                        &nbsp;&nbsp;Arrange and pay directly
                                        for
                                        transportation and
                                        subsistence (recommended)
                                        <br>
                                        @if ($employer_transportation)
                                            <input type="radio" name="reimburse" id="reimburse"
                                                @if ($employer_transportation->reimburse == 1) checked
                                    @else
                                        '' @endif
                                                onclick="validReimburse()">
                                        @else
                                            <input type="radio" name="reimburse" id="reimburse"
                                                onclick="validReimburse()">
                                        @endif
                                        &nbsp;&nbsp;Reimburse the
                                        worker for
                                        transportation and
                                        subsistence
                                        <br>
                                        @if ($employer_transportation)
                                            <input type="radio" name="provide_advance" id="provide_advance"
                                                @if ($employer_transportation->provide_advance == 1) checked
                                    @else
                                        '' @endif
                                                onclick="validProvideAdvance()">
                                        @else
                                            <input type="radio" name="provide_advance" id="provide_advance"
                                                onclick="validProvideAdvance()">
                                        @endif
                                        &nbsp;&nbsp;Provide advance payment
                                        (to the
                                        worker) for
                                        transportation and subsistence
                                        <br>
                                    </div>

                                </div>


                                <div class="col-md-12">
                                    <div id="divArrangePay">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{!! trans('job_application.ArrangeInboundTransportation') !!}</label>
                                            <br>
                                            &nbsp;&nbsp;&nbsp;{!! trans('job_application.Yes') !!}
                                            @if ($employer_transportation)
                                                <input type="radio" name="pes_arramge_inbound_transportation"
                                                    id="pes_arramge_inbound_transportation"
                                                    @if ($employer_transportation->pes_arramge_inbound_transportation == 1) checked
                                            @else
                                                '' @endif
                                                    value="1">
                                            @else
                                                <input type="radio" name="pes_arramge_inbound_transportation"
                                                    id="pes_arramge_inbound_transportation">
                                            @endif

                                            &nbsp;&nbsp;
                                            {!! trans('job_application.No') !!}
                                            @if ($employer_transportation)
                                                <input type="radio" name="pes_arramge_inbound_transportation"
                                                    id="pes_arramge_inbound_transportation"
                                                    @if ($employer_transportation->pes_arramge_inbound_transportation == 0) checked
                                            @else
                                                '' @endif
                                                    value="0">
                                            @else
                                                <input type="radio" name="pes_arramge_inbound_transportation"
                                                    id="pes_arramge_inbound_transportation">
                                            @endif

                                        </div>
                                    </div>


                                </div>


                                <p>{!! trans('job_application.message6') !!}</p>


                                <div class="col-sm-12 form-group">
                                    <button type="submit" class="btn btn-primary float-right">Next</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="tab5">




                            <div class="col-xl-12 col-xxl-12 row">
                                <div class="col-sm-12">&nbsp;</div>
                                <div class="col-sm-12">
                                    <h3>{!! trans('job_application.AttorneyAgentInformation') !!}</h3>
                                </div>
                                <div class="col-md-12">



                                    <form method="POST" action="{{ url('job_request_representative') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{!! trans('job_application.Lawyers') !!}</label>
                                                    <input type="hidden" name="request_id"
                                                        value="{{ $job_request->id }}">
                                                    <select class="form-control select2"
                                                        name="employer_representative_id"
                                                        id="employer_representative_id">
                                                        <option value="">Select</option>
                                                        @foreach ($employers_representative as $obj)
                                                            @if ($employers_representative)
                                                                @if ($obj->id == $job_request->employer_representative_id)
                                                                    <option value="{{ $obj->id }}" selected>
                                                                        {{ $obj->er_last_name . ' ' . $obj->er_first_name . ' ' . $obj->er_middle_name }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $obj->id }}">
                                                                        {{ $obj->er_last_name . ' ' . $obj->er_first_name . ' ' . $obj->er_middle_name }}
                                                                    </option>
                                                                @endif
                                                            @else
                                                                <option value="0">
                                                                    Seleccione</option>
                                                            @endif
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <br>
                                                    <button type="button" name="btn_add_lawyer" id="btn_add_lawyer"
                                                        class="btn btn-primary" onclick="modal_lawyer()">Add
                                                        Lawyer</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="row">
                                                <button type="submit" name="btn_add_lawyer" id="btn_add_lawyer"
                                                    class="btn btn-primary">Next</button>
                                            </div>
                                        </div>
                                    </form>







                                </div>


                                <div class="col-sm-12">
                                    <!-- modal attorney  -->
                                    <div class="modal fade bd-example-modal-lg" id="modal-lawyer" tabindex="-1"
                                        role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{!! trans('job_application.Position') !!}</h5>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{ url('job_request_representative') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>{!! trans('job_application.TypeRepresentation') !!}</label>
                                                                    <input type="hidden" name="request_id"
                                                                        value="{{ $job_request->id }}">
                                                                    <select class="form-control select2"
                                                                        name="er_type_of_representation_id"
                                                                        id="er_type_of_representation_id">
                                                                        <option value="">Select</option>
                                                                        @foreach ($types_representation as $obj)
                                                                            <option value="{{ $obj->id }}">
                                                                                {{ $obj->name }}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                            </div>



                                                            <div class="row">
                                                                <div class="col-xl-4 col-xxl-4">
                                                                    <div class="form-group">
                                                                        <label>{!! trans('job_application.FirstName') !!}</label>

                                                                        <input type="text" name="er_first_name"
                                                                            value="{{ old('er_first_name') }}"
                                                                            class="form-control">

                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-4 col-xxl-4">
                                                                    <div class="form-group">
                                                                        <label>{!! trans('job_application.MiddleName') !!}</label>

                                                                        <input type="text" name="er_middle_name"
                                                                            value="{{ old('er_middle_name') }}"
                                                                            class="form-control">


                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-4 col-xxl-4">
                                                                    <div class="form-group">
                                                                        <label>{!! trans('job_application.AttorneyAgentLastName') !!}</label>

                                                                        <input type="text" name="er_last_name"
                                                                            value="{{ old('er_last_name') }}"
                                                                            class="form-control">


                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">

                                                                <div class="col-xl-12 col-xxl-12">&nbsp;</div>
                                                                <div class="col-xl-6 col-xxl-6">





                                                                    <div class="form-group">
                                                                        <label>{!! trans('job_application.State') !!}</label>
                                                                        <input type="hidden" name="country_id"
                                                                            value="1">
                                                                        <select class="form-control select2"
                                                                            name="er_state_id" id="er_state_id">
                                                                            <option value="">Select</option>


                                                                            @foreach ($states as $obj)
                                                                                <option value="{{ $obj->id }}">
                                                                                    {{ $obj->name }}</option>
                                                                            @endforeach




                                                                        </select>

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>{!! trans('job_application.Country') !!}</label>
                                                                        <select class="form-control select2"
                                                                            name="er_county_id" id="er_county_id">








                                                                        </select>

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>{!! trans('job_application.City') !!}</label>
                                                                        <select class="form-control select2"
                                                                            name="er_city_id" id="er_city_id">






                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>{!! trans('job_application.PostalCode') !!}</label>
                                                                        <select class="form-control select2"
                                                                            name="er_zip_addr1" id="er_zip_addr1">






                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $job_request->id }}">
                                                                        <label>{!! trans('job_application.Address') !!}</label>

                                                                        <input type="text" name="er_address_1"
                                                                            value="{{ old('er_address_1') }}"
                                                                            class="form-control">


                                                                    </div>
                                                                </div>


                                                                <div class="col-xl-6 col-xxl-6">







                                                                    <div class="form-group">
                                                                        <label>{!! trans('job_application.LawBusinessEmailAddress') !!}</label>

                                                                        <input type="text" name="er_lawfirm_email"
                                                                            value="{{ old('er_lawfirm_email') }}"
                                                                            class="form-control">

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>{!! trans('job_application.LawBusinessName') !!}</label>

                                                                        <input type="text"
                                                                            name="er_lawfirm_business_name"
                                                                            value="{{ old('er_lawfirm_business_name') }}"
                                                                            class="form-control">

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $job_request->id }}">
                                                                        <label>{!! trans('job_application.LawBusinessFEIN') !!}</label>

                                                                        <input type="text"
                                                                            name="er_lawfirm_fein_number"
                                                                            value="{{ old('er_lawfirm_fein_number') }}"
                                                                            class="form-control">


                                                                    </div>

                                                                    <div class="form-group">
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $job_request->id }}">
                                                                        <label>{!! trans('job_application.StateBarNumber') !!}</label>

                                                                        <input type="text" name="er_state_bar_number"
                                                                            value="{{ old('er_state_bar_number') }}"
                                                                            class="form-control">

                                                                    </div>

                                                                    <div class="form-group">
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $job_request->id }}">
                                                                        <label>{!! trans('job_application.StateHighestCourt') !!}</label>
                                                                        <select class="form-control select2"
                                                                            name="er_state_good_standing_id"
                                                                            id="er_state_good_standing_id">
                                                                            <option value="">Select</option>

                                                                            @foreach ($states as $obj)
                                                                                <option value="{{ $obj->id }}">
                                                                                    {{ $obj->name }}</option>
                                                                            @endforeach



                                                                        </select>

                                                                    </div>


                                                                </div>


                                                            </div>

                                                            <div class="row">
                                                                <div class="col-xl-4 col-xxl-4">
                                                                    <div class="form-group">
                                                                        <label>{!! trans('job_application.TelephoneNumber') !!}</label>

                                                                        <input type="text" name="er_telephone_number"
                                                                            data-inputmask="'mask': ['(999)999-9999']"
                                                                            data-mask
                                                                            value="{{ old('er_telephone_number') }}"
                                                                            class="form-control">

                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-4 col-xxl-4">
                                                                    <div class="form-group">
                                                                        <br>
                                                                        <label>{!! trans('job_application.Extension') !!}</label>

                                                                        <input type="text"
                                                                            name="er_telephone_number_ext"
                                                                            value="{{ old('er_telephone_number_ext') }}"
                                                                            data-inputmask="'mask': ['(999)999-9999']"
                                                                            data-mask class="form-control">


                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-4 col-xxl-4">

                                                                    <div class="form-group">
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $job_request->id }}">
                                                                        <label>{!! trans('job_application.NameHighestCourt') !!}</label>

                                                                        <input type="text"
                                                                            name="er_highest_state_court_name"
                                                                            value="{{ old('er_highest_state_court_name') }}"
                                                                            class="form-control">


                                                                    </div>
                                                                </div>
                                                            </div>



                                                        </div>







                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end modal attorney -->
                                </div>

                                <div class="col-sm-12">&nbsp;</div>



                            </div>









                        </div>

                        <div class="tab-pane fade" id="tab6">
                            <form action="{{ url('job_request_sign') }}" method="POST">
                                @csrf
                                <br>
                                <input type="hidden" id="request_id" name="request_id"
                                    value="{{ $job_request->id }}">
                                <div class="col-sm-12">
                                    <h4>{!! trans('job_application.EmployeeRights') !!}</h4>
                                </div>
                                <div class="col-sm-12">{!! trans('job_application.message4') !!}</div>

                                @if ($job_request->signature)
                                    <div class="col-sm-12">
                                        <h5><input type="checkbox" checked>&nbsp;&nbsp;{!! trans('job_application.Agree') !!}</h5>
                                    </div>
                                    <div class="col-sm-12">{!! trans('job_application.message5') !!}</div>
                                    <div class="col-sm-12">
                                        <h5><input type="checkbox" checked>&nbsp;&nbsp;{!! trans('employer.Yes') !!}</h5>
                                    </div>
                                @else
                                    <div class="col-sm-12">
                                        <h5><input type="checkbox">&nbsp;&nbsp;{!! trans('job_application.Agree') !!}</h5>
                                    </div>
                                    <div class="col-sm-12">{!! trans('job_application.message5') !!}</div>
                                    <div class="col-sm-12">
                                        <h5><input type="checkbox">&nbsp;&nbsp;{!! trans('employer.Yes') !!}</h5>
                                    </div>
                                @endif



                                <div class="col-sm-12">&nbsp;</div>
                                <div class="col-sm-12">{!! trans('job_application.PleasSign') !!}</div>

                                <div class="row">


                                    <div class="col-sm-6">

                                        <div id="divEditSign" class="divEditSign">
                                            <img src="{{ asset('sign') }}/{{ $job_request->signature }}">
                                            <input type="button" class="button" id="draw-editBtn"
                                                onclick="editSign()" value="Edit Sign" />

                                        </div>

                                        <div id="divCreateSign" class="divCreateSign">
                                            <canvas id="draw-canvas" width="300" height="200">

                                            </canvas>
                                            <textarea id="draw-dataUrl" name="sign" class="form-control" rows="5"></textarea>

                                            <input type="button" class="button" id="draw-clearBtn"
                                                value="Clear" />
                                            <input type="submit" class="button" id="draw-submitBtn"
                                                value="Send" />
                                            <input type="color" id="color">
                                            <input type="range" id="puntero" min="1" default="1"
                                                max="5" width="10%">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">

                                    </div>








                                </div>






                            </form>
                        </div>



                    </div>
                </div>
            </div>
        </div>


    </div>

    @include('sweetalert::alert')


    <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {


            var tab_request = '<?php echo $tab_request; ?>';
            //alert(tab_request);
            switch (tab_request) {
                case '1':
                    $('.nav-tabs a[href="#tab1"]').tab('show');
                    break;
                case '2':
                    $('.nav-tabs a[href="#tab2"]').tab('show');
                    break;
                case '3':
                    $('.nav-tabs a[href="#tab3"]').tab('show');
                    break;
                case '4':
                    $('.nav-tabs a[href="#tab4"]').tab('show');
                    break;
                case '5':
                    $('.nav-tabs a[href="#tab5"]').tab('show');
                    break;
                case '6':
                    $('.nav-tabs a[href="#tab6"]').tab('show');
                    break;
                case '7':
                    $('.nav-tabs a[href="#tab7"]').tab('show');
                    break;
            }


            show_multiple_employment_period();
            show_div_uniform();

            $('#draw-submitBtn').hide();
            $('#color').hide();
            $('#puntero').hide();
            $('#draw-dataUrl').hide();



            validHousing();
            validMedical();
            validDaily();
            validOther();
            validMeals();
            validNoDeductions();
            validIsDeposit();
            validUtilities();

            validDeductionMedical();
            validDeductionDental();
            validDeductionVision();
            validDeductionOther();

            validCriminal();
            validOtherDescription();
            validTestingOtherDescription();
            validRequirementsDescription();
            validDrugTesting();

            validArrangePay();
            validReimburse();
            validProvideAdvance();


            //captura de firma
            $("#draw-canvas").click(function() {
                $('#draw-submitBtn').show();
                //$('#draw-submitBtn').click();
            });

            //limpiar firma y ocultar boton send
            $("#draw-clearBtn").click(function() {
                $('#draw-submitBtn').hide();
            });



            $("#er_state_id").change(function() {
                var State = $(this).val();
                load_counties(State, "er_county_id");
            });

            $("#er_county_id").change(function() {
                var State = $(this).val();
                load_cities(State, "er_city_id");
            });

            $("#er_city_id").change(function() {
                var City = $(this).val();
                load_zip_cods(City, "er_zip_addr1");
            });


        });

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



        function show_div_explain_benefits() {
            if (document.getElementById('is_there_benefits').checked == true) {
                $('#div_explain_benefits').show();
            } else {
                $('#div_explain_benefits').hide();
            }
        }

        function show_div_requeriments() {
            if (document.getElementById('are_there_any_requeriments').checked == true) {
                $('#div_requeriments').show();
            } else {
                $('#div_requeriments').hide();
            }
        }
    </script>




    <script>
        function modal_delete(id) {
            document.getElementById('id_detail').value = id;
            $('#modal-delete').modal('show');
        }

        function modal_lawyer() {
            $('#modal-lawyer').modal('show');
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
    </script>

    <script>
        function get_div_deductions_medical() {
            var ChkMedical = 0;
            var ChkDental = 0;
            var ChkVision = 0;
            var ChkOther = 0;

            if (document.getElementById('ChkMedical').checked == true) {
                var ChkMedical = 1;
            }
            if (document.getElementById('ChkDental').checked == true) {
                var ChkDental = 1;
            }
            if (document.getElementById('ChkVision').checked == true) {
                var ChkVision = 1;
            }
            if (document.getElementById('ChkOther').checked == true) {
                var ChkOther = 1;
            }


            var parametros = {
                "ChkMedical": ChkMedical,
                "ChkDental": ChkDental,
                "ChkVision": ChkVision,
                "ChkOther": ChkOther,
            };
            $.ajax({
                type: "get",
                url: "{{ url('job_request/get_div_deductions_medical') }}",
                data: parametros,
                success: function(data) {
                    console.log(data);
                    $('#div_deductions').html(data);
                }
            })


        }

        function get_div_tab3() {
            var Housing = 0;
            var Medical = 0;
            var DailyTransportation = 0;
            var Other = 0;
            var Meals = 0;
            var NoDeductions = 0;

            if (document.getElementById('Housing').checked == true) {
                var Housing = 1;
            }

            if (document.getElementById('Medical').checked == true) {
                var Medical = 1;
            }

            if (document.getElementById('DailyTransportation').checked == true) {
                var DailyTransportation = 1;
            }

            if (document.getElementById('Other').checked == true) {
                var Other = 1;
            }

            if (document.getElementById('Meals').checked == true) {
                var Meals = 1;
            }

            if (document.getElementById('NoDeductions').checked == true) {
                var NoDeductions = 1;
            }


            var parametros = {
                "Housing": Housing,
                "Medical": Medical,
                "DailyTransportation": DailyTransportation,
                "Other": Other,
                "Meals": Meals,
                "NoDeductions": NoDeductions,
                'request_id': document.getElementById('request_id').value,
            };
            $.ajax({
                type: "get",
                url: "{{ url('job_request/get_div_deductions') }}",
                data: parametros,
                success: function(data) {
                    console.log(data);
                    $('#content').html(data);
                }
            })
        }


        function validHousing() {
            if (document.getElementById('Housing').checked == true)
                document.getElementById('divHousing').hidden = false;
            else
                document.getElementById('divHousing').hidden = true;

        }


        function validMedical() {
            if (document.getElementById('Medical').checked == true)
                document.getElementById('divMedical').hidden = false;
            else
                document.getElementById('divMedical').hidden = true;
        }



        function validDaily() {
            if (document.getElementById('DailyTransportation').checked == true)
                document.getElementById('divDaily').hidden = false;
            else
                document.getElementById('divDaily').hidden = true;
        }



        function validOther() {
            if (document.getElementById('Other').checked == true)
                document.getElementById('divOther').hidden = false;
            else
                document.getElementById('divOther').hidden = true;
        }


        function validMeals() {
            if (document.getElementById('Meals').checked == true)
                document.getElementById('divMeals').hidden = false;
            else
                document.getElementById('divMeals').hidden = true;
        }


        function validNoDeductions() {
            if (document.getElementById('NoDeductions').checked == true)
                document.getElementById('divNoDeductions').hidden = false;
            else
                document.getElementById('divNoDeductions').hidden = true;
        }


        function validIsDeposit() {
            if (document.getElementById('is_deposit_required').checked == true)
                document.getElementById('showIsDepositRequired').hidden = false;
            else
                document.getElementById('showIsDepositRequired').hidden = true;
        }


        function validUtilities() {
            if (document.getElementById('housing_utilities').checked == true)
                document.getElementById('showPleaseUtilities').hidden = false;
            else
                document.getElementById('showPleaseUtilities').hidden = true;
        }


        function validDeductionMedical() {

            if (document.getElementById('ChkMedical').checked == true) {
                document.getElementById('divDeductionMedical').hidden = false;
            } else {
                document.getElementById('divDeductionMedical').hidden = true;
            }

        }

        function validDeductionDental() {
            if (document.getElementById('ChkDental').checked == true)
                document.getElementById('divDeductionDental').hidden = false;
            else
                document.getElementById('divDeductionDental').hidden = true;
        }

        function validDeductionVision() {
            if (document.getElementById('ChkVision').checked == true)
                document.getElementById('divDeductionVision').hidden = false;
            else
                document.getElementById('divDeductionVision').hidden = true;
        }

        function validDeductionOther() {
            if (document.getElementById('ChkOther').checked == true)
                document.getElementById('divDeductionOther').hidden = false;
            else
                document.getElementById('divDeductionOther').hidden = true;
        }



        function validCriminal() {
            if (document.getElementById('is_background_check_required').checked == true)
                document.getElementById('divCriminal').hidden = false;
            else
                document.getElementById('divCriminal').hidden = true;
        }

        function validDrugTesting() {
            if (document.getElementById('is_drug_testing_required').checked == true)
                document.getElementById('divDrugTesting').hidden = false;
            else
                document.getElementById('divDrugTesting').hidden = true;
        }



        function validOtherDescription() {
            if (document.getElementById('is_background_check_other').checked == true)
                document.getElementById('divOtherDescription').hidden = false;
            else
                document.getElementById('divOtherDescription').hidden = true;
        }

        function validTestingOtherDescription() {
            if (document.getElementById('is_drug_testing_other').checked == true)
                document.getElementById('divTestingOtherDescription').hidden = false;
            else
                document.getElementById('divTestingOtherDescription').hidden = true;
        }

        function validRequirementsDescription() {
            if (document.getElementById('are_there_other_requirements').checked == true)
                document.getElementById('divRequirementsDescription').hidden = false;
            else
                document.getElementById('divRequirementsDescription').hidden = true;
        }


        function validArrangePay() {
            if (document.getElementById('arrange_and_pay').checked == true) {
                document.getElementById('reimburse').checked = false;
                document.getElementById('provide_advance').checked = false;
                document.getElementById('divArrangePay').hidden = false;

                // document.getElementById('arrange_and_pay').value = 1;
                // document.getElementById('reimburse').value = 0;
                // document.getElementById('provide_advance').value = 0;
            }
        }

        function validReimburse() {
            if (document.getElementById('reimburse').checked == true) {
                document.getElementById('arrange_and_pay').checked = false;
                document.getElementById('provide_advance').checked = false;
                document.getElementById('divArrangePay').hidden = true;

                // document.getElementById('arrange_and_pay').value = 0;
                // document.getElementById('reimburse').value = 1;
                // document.getElementById('provide_advance').value = 0;
            }
        }

        function validProvideAdvance() {
            if (document.getElementById('provide_advance').checked == true) {
                document.getElementById('reimburse').checked = false;
                document.getElementById('arrange_and_pay').checked = false;
                document.getElementById('divArrangePay').hidden = true;

                // document.getElementById('arrange_and_pay').value = 0;
                // document.getElementById('reimburse').value = 0;
                // document.getElementById('provide_advance').value = 1;
            }
        }




        function editSign() {

            //document.getElementById('divEditSign').hidden = true;
            //document.getElementById('divCreateSign').show = true;
            $('#divEditSign').hide();
            $('#divCreateSign').show();

            // divCreateSign


        }




        function load_counties(id, control) {
            if (id > 0) {
                var selector = "#" + control;
                //console.log(selector);
                $.get("{{ url('get_counties') }}" + '/' + id, function(data) {
                    var _select = '<option value="">Select</option>'
                    for (var i = 0; i < data.length; i++)
                        _select += '<option value="' + data[i].id + '"  >' + data[i].name +
                        '</option>';
                    $(selector).html(_select);
                });
            }
        }


        function load_cities(id, control) {
            if (id > 0) {
                var selector = "#" + control;
                //console.log(selector);
                $.get("{{ url('get_cities') }}" + '/' + id, function(data) {
                    var _select = '<option value="">Select</option>'
                    for (var i = 0; i < data.length; i++)
                        _select += '<option value="' + data[i].id + '"  >' + data[i].name +
                        '</option>';
                    $(selector).html(_select);
                });
            }
        }

        function load_zip_cods(id, control) {
            if (id > 0) {
                var selector = "#" + control;
                //console.log(selector);
                $.get("{{ url('get_zipcodes') }}" + '/' + id, function(data) {
                    var _select = ''
                    for (var i = 0; i < data.length; i++)
                        _select += '<option value="' + data[i].id + '"  >' + data[i]
                        .czc_zipcode + '</option>';
                    $(selector).html(_select);
                });
            }
        }
    </script>

    <script src="{{ asset('job_application/sign.js') }}"></script>
@endsection
