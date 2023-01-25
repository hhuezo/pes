@extends ('dashboard')
@section('contenido')
    <div class="col-xl-12 col-xxl-12">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Employer</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Legal Business Name: </strong>
                            @if ($request->employer_id)
                                {{ $request->employer->legal_business_name }}
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table table-hover table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>Position</th>
                                        <th>Workers</th>
                                        <th>Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($details)
                                        @foreach ($details as $obj)
                                            <tr>
                                                <td>{{$obj->title->title}}</td>
                                                <td>{{$obj->number_workers}}</td>
                                                <td>{{ number_format(($obj->candidates * 100)/$obj->number_workers, 2, '.', '')}} %</td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">English level</h4>
                    </div>
                    <div class="card-body">


                    </div>
                </div>
            </div>
        </div>

        <div class="card">

            <div class="card-header">
                <h4 class="card-title">Tracking status</h4>
            </div>

            <div class="card-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">English level</h4>
                            </div>
                            <div class="card-body">


                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">English level</h4>
                            </div>
                            <div class="card-body">


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
