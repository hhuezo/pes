@extends ('dashboard')
@section('contenido')
    <link rel="stylesheet" href="{{ asset('job_application/style.css') }}">

    {{ $deduction->housing_utilities }}

    @if ($deduction->housing_utilities == 0)
        <style>
            .divHousing {
                display: none;
            }
        </style>
    @endif

    <div class="row">


        <div class="card col-md-12">
            <div class="card-header">
                <h4 class="card-title">Default Tab</h4>
            </div>
            <div class="card-body">
                <!-- Nav tabs -->
                <div class="default-tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab1">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab2">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab3">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab4">Message</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab5">tab5</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="tab1" role="tabpanel">
                            <form method="POST" action="{{ route('job_request.update', $job_request->id) }}">
                                @method('PUT')
                                @csrf


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
                                                <td>{{ $obj->title->title }}</td>
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
                                                    @if ($deduction->housing_utilities == 1)
                                                        <input type="checkbox" id="Housing" name="Housing" checked
                                                            onclick="validHousing();">
                                                        <label for="exampleInputUsername1">{!! trans('job_application.Housing') !!}</label>
                                                    @endif
                                                    @if ($deduction->housing_utilities == 0)
                                                        <input type="checkbox" id="Housing" name="Housing"
                                                            onclick="validHousing();">
                                                        <label for="exampleInputUsername1">{!! trans('job_application.Housing') !!}</label>
                                                    @endif


                                                    <br>
                                                    @if ($deduction->medical == 1)
                                                        <input type="checkbox" id="Medical" name="Medical" checked
                                                            onclick="validMedical();"> <label
                                                            for="exampleInputUsername1">{!! trans('job_application.Medical') !!}</label>
                                                    @endif
                                                    @if ($deduction->medical == 0)
                                                        <input type="checkbox" id="Medical" name="Medical"
                                                            onclick="validMedical();">
                                                        <label for="exampleInputUsername1">{!! trans('job_application.Medical') !!}</label>
                                                    @endif


                                                    <br>
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


                                                </div>

                                                <div class="col-md-6">
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

                                                    <br>
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

                                                    <br>
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


                                                </div>

                                                <div class="col-sm-12">&nbsp;</div>
                                                <div class="col-sm-12">&nbsp;</div>

                                                <div id="content" class="col-sm-12 row">

                                                </div>




                                            </div>
                                        </div>

                                    </div>
                                </div>


                                @csrf
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
                                                    <input type="number" min="1" step="0.01"
                                                        name="deduction_housing_amount_person_week"
                                                        value="{{ old('deduction_housing_amount_person_week', $deduction->deduction_housing_amount_person_week) }}"
                                                        class="form-control">
                                                </div>

                                                <div id="showPleaseUtilities">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{!! trans('job_application.PleaseUtilities') !!}</label>
                                                        <input type="text" name="explain_housing_utilities"
                                                            value="{{ old('explain_housing_utilities', $deduction->explain_housing_utilities) }}"
                                                            class="form-control">
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.RequiredHousing') !!}</label>
                                                    <br>
                                                    &nbsp;&nbsp; &nbsp;&nbsp;
                                                    {!! trans('job_application.Yes') !!}

                                                    @if ($deduction->is_deposit_required == 1)
                                                        <input type="radio" name="is_deposit_required"
                                                            id="is_deposit_required" checked value="1"
                                                            onClick="validIsDeposit()">
                                                    @else
                                                        <input type="radio" name="is_deposit_required"
                                                            id="is_deposit_required" value="1"
                                                            onClick="validIsDeposit()">
                                                    @endif


                                                    &nbsp;&nbsp;
                                                    {!! trans('job_application.No') !!}

                                                    @if ($deduction->is_deposit_required == 0)
                                                        <input type="radio" name="is_deposit_required"
                                                            id="is_deposit_required" checked value="0"
                                                            onClick="validIsDeposit()">
                                                    @else
                                                        <input type="radio" name="is_deposit_required"
                                                            id="is_deposit_required" value="0"
                                                            onClick="validIsDeposit()">
                                                    @endif



                                                    &nbsp;&nbsp;
                                                    <br>
                                                </div>
                                                <div id="showIsDepositRequired">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{!! trans('job_application.DepositAmount') !!}</label>
                                                        <input type="number" step="0.01" name="deposit_amount"
                                                            @if ($deduction->deposit_amount) value="{{ old('deposit_amount', $deduction->deposit_amount) }}" @endif
                                                            class="form-control">
                                                    </div>

                                                    <label for="exampleInputEmail1">{!! trans('job_application.IsDepositRefundable') !!}</label>
                                                    <br>
                                                    &nbsp;&nbsp; &nbsp;&nbsp;
                                                    {!! trans('job_application.Yes') !!}

                                                    @if ($deduction->is_deposit_refundable == 1)
                                                        <input type="radio" name="is_deposit_refundable"
                                                            id="is_deposit_refundable" checked value="1">
                                                    @else
                                                        <input type="radio" name="is_deposit_refundable"
                                                            id="is_deposit_refundable" value="1">
                                                    @endif



                                                    &nbsp;&nbsp;
                                                    {!! trans('job_application.No') !!}
                                                    @if ($deduction->is_deposit_refundable == 0)
                                                        <input type="radio" name="is_deposit_refundable"
                                                            id="is_deposit_refundable" checked value="0">
                                                    @else
                                                        <input type="radio" name="is_deposit_refundable"
                                                            id="is_deposit_refundable" value="0">
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

                                                    @if ($deduction->housing_includes_utilities == 1)
                                                        <input type="radio" name="housing_utilities"
                                                            id="housing_utilities" value="1" checked
                                                            onClick="validUtilities()">
                                                    @else
                                                        <input type="radio" name="housing_utilities"
                                                            id="housing_utilities" value="1"
                                                            onClick="validUtilities()">
                                                    @endif



                                                    &nbsp;&nbsp;
                                                    {!! trans('job_application.No') !!}

                                                    @if ($deduction->housing_includes_utilities == 0)
                                                        <input type="radio" name="housing_utilities"
                                                            id="housing_utilities" value="0" checked
                                                            onClick="validUtilities()">
                                                    @else
                                                        <input type="radio" name="housing_utilities"
                                                            id="housing_utilities" value="0"
                                                            onClick="validUtilities()">
                                                    @endif

                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                                                    <input type="text" name="housing_notes"
                                                        value="{{ old('housing_notes', $deduction->housing_notes) }}"
                                                        class="form-control">
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
                                                    @if ($deduction->deduction_medical_paycheck == 1)
                                                        <input type="checkbox" id="ChkMedical" name="ChkMedical" checked
                                                            onchange="validDeductionMedical();">&nbsp;&nbsp;
                                                        <label for="exampleInputEmail1">Medical</label>
                                                    @endif
                                                    @if ($deduction->deduction_medical_paycheck == 0)
                                                        <input type="checkbox" id="ChkMedical" name="ChkMedical"
                                                            onchange="validDeductionMedical();">&nbsp;&nbsp;
                                                        <label for="exampleInputEmail1">Medical</label>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    @if ($deduction->deduction_dental_paycheck == 1)
                                                        <input type="checkbox" id="ChkDental" name="ChkDental" checked
                                                            onchange="validDeductionDental();">&nbsp;&nbsp;
                                                        <label for="exampleInputEmail1">Dental</label>
                                                    @endif
                                                    @if ($deduction->deduction_dental_paycheck == 0)
                                                        <input type="checkbox" id="ChkDental" name="ChkDental"
                                                            onchange="validDeductionDental();">&nbsp;&nbsp;
                                                        <label for="exampleInputEmail1">Dental</label>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    @if ($deduction->deduction_vision_paycheck == 1)
                                                        <input type="checkbox" id="ChkVision" name="ChkVision" checked
                                                            onchange="validDeductionVision();">&nbsp;&nbsp;
                                                        <label for="exampleInputEmail1">Vision</label>
                                                    @endif
                                                    @if ($deduction->deduction_vision_paycheck == 0)
                                                        <input type="checkbox" id="ChkVision" name="ChkVision"
                                                            onchange="validDeductionVision();">&nbsp;&nbsp;
                                                        <label for="exampleInputEmail1">Vision</label>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group">
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
                                                    <input type="number" step="0.01"
                                                        name="deduction_daily_amount_person_week"
                                                        value="{{ old('deduction_daily_amount_person_week', $deduction->deduction_daily_amount_person_week) }}"
                                                        class="form-control">
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                                                    <input type="text" name="daily_notes"
                                                        value="{{ old('daily_notes', $deduction->daily_notes) }}"
                                                        class="form-control">
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
                                                    <input type="text" name="other_deductions"
                                                        value="{{ old('other_deductions', $deduction->other_deductions) }}"
                                                        class="form-control">

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
                                                    <input type="number" min="1" name="how_many_meals_provided"
                                                        value="{{ old('how_many_meals_provided', $deduction->how_many_meals_provided) }}"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.EnterCost') !!}</label>
                                                    <input type="number" step="0.01" min="0.01"
                                                        name="cost_per_meal"
                                                        value="{{ old('cost_per_meal', $deduction->cost_per_meal) }}"
                                                        class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                                                    <input type="text" name="meals_notes"
                                                        value="{{ old('meals_notes', $deduction->meals_notes) }}"
                                                        class="form-control">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.AdditionalNotesMeals') !!}</label>
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.ThereCost') !!}</label>
                                                    <br>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    {!! trans('job_application.Yes') !!}
                                                    @if ($deduction->is_there_cost_per_meal == 1)
                                                        <input type="radio" name="is_there_costo_per_meal"
                                                            id="is_there_costo_per_meal" value="1" checked>
                                                    @else
                                                        <input type="radio" name="is_there_costo_per_meal"
                                                            id="is_there_costo_per_meal" value="1">
                                                    @endif


                                                    &nbsp;&nbsp;
                                                    {!! trans('job_application.No') !!}
                                                    @if ($deduction->is_there_cost_per_meal == 0)
                                                        <input type="radio" name="is_there_costo_per_meal"
                                                            id="is_there_costo_per_meal" value="0" checked>
                                                    @else
                                                        <input type="radio" name="is_there_costo_per_meal"
                                                            id="is_there_costo_per_meal" value="0">
                                                    @endif

                                                    &nbsp;&nbsp;
                                                    <br>
                                                    <br>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{!! trans('job_application.EnterDeduction') !!}</label>
                                                    <input type="number" step="0.01" min="0.01"
                                                        name="deduction_amount_per_meal"
                                                        value="{{ old('deduction_amount_per_meal', $deduction->deduction_amount_per_meal) }}"
                                                        class="form-control">
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

                            <h3>JOB REQUIREMENTS / CONDITIONS OF EMPLOYMENT</h3>
                            <p>Background checks, drug testing and/or other job requirements and conditions of employment
                                must not favor either U.S. or H-2B workers, they must be applied on an equal basis for all
                                employees.</p>
                            <h5>All job requirements and conditions of employment must be disclosed in the Job Order. </h5>
                            <h5>{!! trans('job_application.BackgroundChecks') !!} </h5>

                            <div class="col-xl-12 col-xxl-12">
                                <div class="col-sm-12">&nbsp;</div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.IsBackgroundChecks') !!}</label>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;{!! trans('job_application.Yes') !!}
                                        @if ($job_request->is_uniform_required == 1)
                                            <input type="radio" value="1" checked name="is_uniform_required">
                                        @else
                                            <input type="radio" value="1" name="is_uniform_required">
                                        @endif
                                        &nbsp;&nbsp;
                                        {!! trans('job_application.No') !!}
                                        @if ($job_request->is_uniform_required == 0)
                                            <input type="radio" value="0" checked>
                                        @else
                                            <input type="radio" value="0">
                                        @endif
                                        <br>
                                        <label for="exampleInputEmail1">{!! trans('job_application.AppliesAllApplicants') !!}</label>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.CheckCriminalHistory') !!}</label>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;{!! trans('job_application.Yes') !!}
                                        @if ($job_request->is_uniform_required == 1)
                                            <input type="radio" value="1" checked name="is_uniform_required">
                                        @else
                                            <input type="radio" value="1" name="is_uniform_required">
                                        @endif
                                        &nbsp;&nbsp;
                                        {!! trans('job_application.No') !!}
                                        @if ($job_request->is_uniform_required == 0)
                                            <input type="radio" value="0" checked>
                                        @else
                                            <input type="radio" value="0">
                                        @endif
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.BackgroundChecksConducted') !!}</label>
                                        <br>
                                        &nbsp;&nbsp;
                                        <input type="checkbox">&nbsp;&nbsp;
                                        {!! trans('job_application.Pre-employment') !!}

                                        &nbsp;&nbsp;
                                        <input type="checkbox">&nbsp;&nbsp;
                                        {!! trans('job_application.Post-employment') !!}

                                        &nbsp;&nbsp;
                                        <input type="checkbox">&nbsp;&nbsp;
                                        {!! trans('job_application.Other') !!}

                                        <br>
                                        <label for="exampleInputEmail1">{!! trans('job_application.SelectApply') !!}</label>
                                    </div>

                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.DrugTesting') !!}</label>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;{!! trans('job_application.Yes') !!}
                                        @if ($job_request->is_uniform_required == 1)
                                            <input type="radio" value="1" checked name="is_uniform_required">
                                        @else
                                            <input type="radio" value="1" name="is_uniform_required">
                                        @endif
                                        &nbsp;&nbsp;
                                        {!! trans('job_application.No') !!}
                                        @if ($job_request->is_uniform_required == 0)
                                            <input type="radio" value="0" checked>
                                        @else
                                            <input type="radio" value="0">
                                        @endif
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.DrugTestingConducted') !!}</label>
                                        <br>
                                        &nbsp;&nbsp;
                                        <input type="checkbox">&nbsp;&nbsp;
                                        {!! trans('job_application.Pre-employment') !!}

                                        &nbsp;&nbsp;
                                        <input type="checkbox">&nbsp;&nbsp;
                                        {!! trans('job_application.Post-employment') !!}

                                        &nbsp;&nbsp;
                                        <input type="checkbox">&nbsp;&nbsp;
                                        {!! trans('job_application.PostInjury') !!}


                                        &nbsp;&nbsp;
                                        <input type="checkbox">&nbsp;&nbsp;
                                        {!! trans('job_application.Other') !!}
                                        <br>
                                        <label for="exampleInputEmail1">{!! trans('job_application.SelectApply') !!}</label>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.JobRequirements') !!}</label>
                                        <br>
                                        &nbsp;&nbsp;&nbsp;{!! trans('job_application.Yes') !!}
                                        @if ($job_request->is_uniform_required == 1)
                                            <input type="radio" value="1" checked name="is_uniform_required">
                                        @else
                                            <input type="radio" value="1" name="is_uniform_required">
                                        @endif
                                        &nbsp;&nbsp;
                                        {!! trans('job_application.No') !!}
                                        @if ($job_request->is_uniform_required == 0)
                                            <input type="radio" value="0" checked>
                                        @else
                                            <input type="radio" value="0">
                                        @endif
                                        <br>
                                        {!! trans('job_application.AppliesUS') !!}
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
                                    <input type="radio"> &nbsp;&nbsp;Arrange and pay directly for transportation and
                                    subsistence (recommended)
                                    <br>
                                    <input type="radio"> &nbsp;&nbsp;Reimburse the worker for transportation and
                                    subsistence
                                    <br>
                                    <input type="radio"> &nbsp;&nbsp;Provide advance payment (to the worker) for
                                    transportation and subsistence
                                    <br>
                                </div>

                            </div>
                            <p>{!! trans('job_application.message6') !!}</p>



                        </div>

                        <div class="tab-pane fade  show active" id="tab5">
                            <div class="col-xl-12 col-xxl-12 row">
                                <div class="col-sm-12">&nbsp;</div>
                                <div class="col-sm-12">
                                    <h3>{!! trans('job_application.USWorker') !!}</h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">{!! trans('job_application.StateWorkforceUsername') !!}</label>
                                        <input type="text" name="swa_username"
                                            value="{{ old('swa_username', $job_request->swa_username) }}" required
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.StateWorkforcePassword') !!}</label>
                                        <input type="text" name="swa_password"
                                            value="{{ old('swa_password', $job_request->swa_password) }}" required
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">{!! trans('job_application.TelephoneNumber') !!}</label>
                                        <input type="text" name="application_phone_number"
                                            value="{{ old('application_phone_number', $job_request->application_phone_number) }}"
                                            required class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.EmailWhereUS') !!}</label>
                                        <input type="text" name="application_email"
                                            value="{{ old('application_email', $job_request->application_email) }}"
                                            required class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">{!! trans('job_application.WebsiteWhereUS') !!}</label>
                                        <input type="text" name="application_website"
                                            value="{{ old('application_website', $job_request->application_website) }}"
                                            required class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-12">&nbsp;</div>



                            </div>






                            <div class="col-xl-12 col-xxl-12 row">
                                <div class="col-sm-12">&nbsp;</div>
                                <div class="col-sm-12">
                                    <h3>{!! trans('job_application.AdditionalInformation') !!}</h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">{!! trans('job_application.IfApplicable') !!}</label>
                                        <input type="text" name="last_season_impact"
                                            value="{{ old('last_season_impact', $job_request->last_season_impact) }}"
                                            required class="form-control">
                                        <label for="exampleInputUsername2">{!! trans('job_application.ForExample') !!}</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{!! trans('job_application.AdditionalInformation') !!}</label>
                                        <input type="text" name="additional_information"
                                            value="{{ old('additional_information', $job_request->additional_information) }}"
                                            required class="form-control">
                                        <label for="exampleInputEmail2">{!! trans('job_application.PleaseAdditionalInformation') !!}</label>
                                    </div>
                                </div>


                                <div class="col-sm-12">&nbsp;</div>



                            </div>

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

            show_multiple_employment_period();
            show_div_uniform();

            //show_div_explain_benefits();

            //show_div_requeriments();

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
    </script>
@endsection
