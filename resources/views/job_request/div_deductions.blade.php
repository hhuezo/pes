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
                            required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">{!! trans('job_application.RequiredHousing') !!}</label>
                        <br>
                        &nbsp;&nbsp; &nbsp;&nbsp;
                        {!! trans('job_application.Yes') !!}
                        <input type="radio" name="is_deposit_required" value="1">
                        &nbsp;&nbsp;
                        {!! trans('job_application.No') !!}
                        <input type="radio" name="is_deposit_required" checked value="1">
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
                        <input type="radio" name="housing_utilities" value="1">
                        &nbsp;&nbsp;
                        {!! trans('job_application.No') !!}
                        <input type="radio" name="housing_utilities" checked value="1">
                        &nbsp;&nbsp;
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                        <input type="text" name="housing_notes" class="form-control">
                        <label for="exampleInputEmail1">{!! trans('job_application.additional_space') !!}</label>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($Medical == 1)
        <div class="col-sm-12">
            <div class="card-header">
                <h4 class="card-title">{!! trans('job_application.MedicalTitle') !!}</h4>
            </div>
            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                       <input type="checkbox" id="ChkMedical" onchange="get_div_deductions_medical();">&nbsp;&nbsp; <label for="exampleInputEmail1">Medical</label>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                       <input type="checkbox" id="ChkDental" onchange="get_div_deductions_medical();">&nbsp;&nbsp; <label for="exampleInputEmail1">Dental</label>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="form-group">
                       <input type="checkbox" id="ChkVision" onchange="get_div_deductions_medical();">&nbsp;&nbsp; <label for="exampleInputEmail1">Vision</label>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="form-group">
                       <input type="checkbox" id="ChkOther" onchange="get_div_deductions_medical();">&nbsp;&nbsp; <label for="exampleInputEmail1">Other</label>
                    </div>
                </div>
            </div>


        </div>

        <div class="col-sm-12" id="div_deductions">



        </div>
    @endif

    @if ($DailyTransportation == 1)
        <div class="col-sm-12">
            <div class="card-header">
                <h4 class="card-title">{!! trans('job_application.DailyTransportationTitle') !!}</h4>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">{!! trans('job_application.DeductionPerWeek') !!}</label>
                        <input type="number" step="0.01" name="deduction_daily_amount_person_week" required class="form-control">
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                        <input type="text" name="daily_notes" class="form-control">
                    </div>

                </div>
            </div>
        </div>
    @endif

    @if ($Other == 1)
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
                        <input type="number" step="0.01" min="0.01" name="deduction_amount_per_meal" required class="form-control">
                    </div>
                </div>


            </div>
        </div>
    @endif


    @if ($NoDeductions == 1)
        <div class="col-sm-12">
            <h4 class="card-title">{!! trans('job_application.NoDeductionsTitle') !!}</h4>
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
