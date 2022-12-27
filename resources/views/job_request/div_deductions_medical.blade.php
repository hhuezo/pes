@if ($ChkMedical == 1)
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

@if ($ChkDental == 1)
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


@if ($ChkVision == 1)
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


@if ($ChkOther == 1)
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
