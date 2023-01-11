<form method="POST" action="{{ url('job_request_deductions') }}" class="col-xl-12 col-xxl-12 row">
    @csrf
    <input type="hidden" value="{{ $request_id }}" name="request_id">
    @if ($Housing == 1)
        <div class="col-sm-12">
            <div class="card-header">
                <h4 class="card-title">{!! trans('job_application.HousingTitle') !!}</h4>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">{!! trans('job_application.DeductionAmount') !!}</label>
                        <input type="number" min="1" step="0.01" name="deduction_housing_amount_person_week"
                            value="{{ old('deduction_housing_amount_person_week') }}" required class="form-control">
                    </div>

                    <div id="showPleaseUtilities">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{!! trans('job_application.PleaseUtilities') !!}</label>
                            <input type="number" min="1" step="0.01" name="explain_housing_utilities"
                                value="{{ old('explain_housing_utilities') }}" required class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">{!! trans('job_application.RequiredHousing') !!}</label>
                        <br>
                        &nbsp;&nbsp; &nbsp;&nbsp;
                        {!! trans('job_application.Yes') !!}
                        <input type="radio" name="is_deposit_required" value="1" onClick="showDeposit()">
                        &nbsp;&nbsp;
                        {!! trans('job_application.No') !!}
                        <input type="radio" name="is_deposit_required" checked value="1" onClick="hideDeposit()">
                        &nbsp;&nbsp;
                        <br>
                    </div>
                    <div id="showIsDepositRequired">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{!! trans('job_application.DepositAmount') !!}</label>
                            <input type="number" min="1" step="0.01" name="deposit_amount"
                                class="form-control">
                        </div>

                        <label for="exampleInputEmail1">{!! trans('job_application.IsDepositRefundable') !!}</label>
                        <br>
                        &nbsp;&nbsp; &nbsp;&nbsp;
                        {!! trans('job_application.Yes') !!}
                        <input type="radio" name="is_deposit_refundable" value="1">
                        &nbsp;&nbsp;
                        {!! trans('job_application.No') !!}
                        <input type="radio" name="is_deposit_refundable" checked value="1">
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
                        <input type="radio" name="housing_utilities" value="1" onClick="hideUtilities()">
                        &nbsp;&nbsp;
                        {!! trans('job_application.No') !!}
                        <input type="radio" name="housing_utilities" checked value="1" onClick="showUtilities()">
                        &nbsp;&nbsp;
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                        <input type="text" name="housing_notes" value="{{ old('housing_notes') }}"
                            class="form-control">
                        <label for="exampleInputEmail1">{!! trans('job_application.additional_notes_housing') !!}</label>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($Medical == 1)
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
                        <input type="checkbox" id="ChkMedical" onchange="validDeductionMedical();">&nbsp;&nbsp;
                        <label for="exampleInputEmail1">Medical</label>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <input type="checkbox" id="ChkDental" onchange="validDeductionDental();">&nbsp;&nbsp;
                        <label for="exampleInputEmail1">Dental</label>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="form-group">
                        <input type="checkbox" id="ChkVision" onchange="validDeductionVision();">&nbsp;&nbsp;
                        <label for="exampleInputEmail1">Vision</label>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="form-group">
                        <input type="checkbox" id="ChkOther" onchange="validDeductionOther();">&nbsp;&nbsp;
                        <label for="exampleInputEmail1">Other</label>
                    </div>
                </div>
            </div>


        </div>

        <div class="col-sm-12" id="div_deductions">



        </div>
    @endif

    @if ($DailyTransportation == 1)
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
                        <input type="number" step="0.01" name="deduction_daily_amount_person_week" required
                            class="form-control">
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                        <input type="text" name="daily_notes" class="form-control">
                        <label for="exampleInputEmail1">{!! trans('job_application.additional_notes_daily_transportation') !!}</label>
                    </div>

                </div>
            </div>
        </div>
    @endif

    @if ($Other == 1)
        <div>
            <h4>
                <b>
                    {!! trans('job_application.NoDeductionsTitle') !!}
                </b>
            </h4>
        </div>
        <div class="col-sm-12">
            <div class="card-header">
                <h4 class="card-title">{!! trans('job_application.OtherTitle') !!} <br>({!! trans('job_application.listAdditionalDeduction') !!})</h4>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">{!! trans('job_application.OtherTitle') !!}</label>
                        <input type="text" name="other_deductions" required class="form-control">

                    </div>

                </div>
            </div>
        </div>
    @endif

    @if ($Meals == 1)
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
                        <input type="number" min="1" required name="how_many_meals_provided"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">{!! trans('job_application.EnterCost') !!}</label>
                        <input type="number" step="0.01" min="0.01" required name="cost_per_meal"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                        <input type="text" name="meals_notes" class="form-control">
                        <label for="exampleInputEmail1">{!! trans('job_application.AdditionalNotesMeals') !!}</label>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">{!! trans('job_application.ThereCost') !!}</label>
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        {!! trans('job_application.Yes') !!}
                        <input type="radio" name="is_there_costo_per_meal" value="1">
                        &nbsp;&nbsp;
                        {!! trans('job_application.No') !!}
                        <input type="radio" name="is_there_costo_per_meal" checked value="1">
                        &nbsp;&nbsp;
                        <br>
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">{!! trans('job_application.EnterDeduction') !!}</label>
                        <input type="number" step="0.01" min="0.01" name="deduction_amount_per_meal"
                            required class="form-control">
                    </div>
                </div>


            </div>
        </div>
    @endif


    @if ($NoDeductions == 1)
        <div>
            <h4>
                <b>
                    {!! trans('job_application.NoDeductionsTitle') !!}
                </b>
            </h4>
        </div>
    @endif

    @if ($Housing == 1 ||
        $Medical == 1 ||
        $DailyTransportation == 1 ||
        $Other == 1 ||
        $Meals == 1 ||
        $NoDeductions == 1)
        <div class="col-sm-12 form-group">
            <button type="submit" class="btn btn-primary float-right">submit</button>
        </div>
    @endif
</form>

<script type="text/javascript">
    document.getElementById('showIsDepositRequired').hidden = true;

    function hideUtilities() {
        //alert('ocultar');
        // var element = document.getElementById("showPleaseUtilities");
        // element.style.display = "none";

        document.getElementById('showPleaseUtilities').hidden = true;


    }

    function showUtilities() {
        //alert('mostrar');
        // var element = document.getElementById("showPleaseUtilities");
        // element.style.display = "show";
        document.getElementById('showPleaseUtilities').hidden = false;
    }



    function hideDeposit() {
        //alert('ocultar');
        // var element = document.getElementById("showPleaseUtilities");
        // element.style.display = "none";

        document.getElementById('showIsDepositRequired').hidden = true;


    }

    function showDeposit() {
        //alert('mostrar');
        // var element = document.getElementById("showPleaseUtilities");
        // element.style.display = "show";
        document.getElementById('showIsDepositRequired').hidden = false;
    }
</script>
