@if ($ChkMedical == 1)
    <div class="col-sm-12">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">{!! trans('job_application.DeductionAmountMedical') !!}</label>
                    <input type="number" step="0.01" name="deduction_medical_paycheck" required class="form-control">
                    <label for="exampleInputEmail1">{!! trans('job_application.PlansPremium') !!}</label>
                </div>

            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                    <input type="text" name="deduction_medical_note" class="form-control">
                    <label for="exampleInputEmail1">{!! trans('job_application.additional_notes_medical') !!}</label>
                </div>

            </div>
        </div>
    </div>
@endif

@if ($ChkDental == 1)
    <div class="col-sm-12">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">{!! trans('job_application.DeductionAmountDental') !!}</label>
                    <input type="number" step="0.01" name="deduction_dental_paycheck" required class="form-control">
                    <label for="exampleInputEmail1">{!! trans('job_application.PlansPremium') !!}</label>
                </div>

            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                    <input type="text" name="deduction_dental_note" class="form-control">
                    <label for="exampleInputEmail1">{!! trans('job_application.additional_notes_medical') !!}</label>
                </div>

            </div>
        </div>
    </div>
@endif


@if ($ChkVision == 1)
    <div class="col-sm-12">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">{!! trans('job_application.DeductionAmountVision') !!}</label>
                    <input type="number" step="0.01" name="deduction_vision_paycheck" required class="form-control">
                    <label for="exampleInputEmail1">{!! trans('job_application.PlansPremium') !!}</label>
                </div>

            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                    <input type="text" name="deduction_vision_note" class="form-control">
                    <label for="exampleInputEmail1">{!! trans('job_application.additional_notes_medical') !!}</label>
                </div>

            </div>
        </div>
    </div>
@endif


@if ($ChkOther == 1)
    <div class="col-sm-12">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">{!! trans('job_application.DeductionAmountOther') !!}</label>
                    <input type="number" step="0.01" name="deduction_other_paycheck" required class="form-control">
                    <label for="exampleInputEmail1">{!! trans('job_application.PlansPremium') !!}</label>
                </div>

            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">{!! trans('job_application.notes') !!}</label>
                    <input type="text" name="deduction_other_note" class="form-control">
                    <label for="exampleInputEmail1">{!! trans('job_application.additional_notes_medical') !!}</label>
                </div>

            </div>
        </div>
    </div>
@endif
