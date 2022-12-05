@extends ('dashboard')
@section('contenido')
    <!-- /.box -->

    <div class="col-xl-12 col-xxl-12">
        <div class="card">

            <div class="card-header">
                <h4 class="card-title">Job applications listing</h4>
                <a href="{{ url('job_application/create') }}"><button type="button" class="btn btn-success float-right" data-toggle="modal"
                    data-target=".bd-example-modal-lg">Add</button></a>
            </div>

            <div class="card-body">
                <table id="example" class="display" style="min-width: 845px">
                    <thead>
                        <tr>

                            <th>Employer</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Paid</th>
                            <th>Notes</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($job_applications as $obj)
                            <tr>
                                <td>{{ $obj->employer->legal_business_name }}</td>
                                <td>{{ $obj->start_date }}</td>
                                <td>{{ $obj->end_date }}</td>
                                @if ($obj->paid == 1)
                                    <td>Weekly</td>
                                @elseif ($obj->paid == 2)
                                    <td>Bi-weekly</td>
                                @endif
                                <td>{{ $obj->job_notes }}</td>
                                <td align="center">
                                    <a href="{{ url('job_application') }}/{{ $obj->id }}/edit"
                                        class="on-default edit-row">
                                        <i class="fa fa-edit fa-lg"></i></a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>

                </table>

            </div>

        </div>
    </div>
@endsection
