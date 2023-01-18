@extends ('dashboard')
@section('contenido')
    <!-- /.box -->


    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    <div class="col-xl-12 col-xxl-12">

        <div class="card">

            <div class="card-header">
                <h4 class="card-title">Requirements</h4>
                @can('create job application')
                <a href="{{ url('job_request/create') }}"><button type="button" class="btn btn-info float-right">New Requirement</button></a>
                @endcan

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
                        @foreach ($job_requests as $obj)
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
                                    <a href="{{ url('job_request') }}/{{ $obj->id }}/edit"
                                        class="on-default edit-row">
                                        <i class="fa fa-edit fa-lg"></i></a>
                                        &nbsp;&nbsp;
                                        <a href="{{ url('job_request/form9141') }}/{{ $obj->id }}" target="_blank"
                                            class="on-default edit-row">
                                            <i class="fa fa-print fa-lg"></i></a>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

        </div>
        @include('sweetalert::alert')
    </div>

@endsection
