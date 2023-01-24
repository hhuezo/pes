@extends ('dashboard')
@section('contenido')
    <!-- /.box -->


    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <div class="col-xl-12 col-xxl-12">

        <div class="card">

            <div class="card-header">
                <h4 class="card-title">Requirements</h4>
                @can('create job application')
                    <a href="{{ url('job_request/create') }}"><button type="button" class="btn btn-primary float-right">New
                            Requirement</button></a>
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
                            <th>Workers</th>
                            <th>Status</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($job_requests as $obj)
                            <tr>
                                <td>{{ $obj->employer }}</td>
                                <td>{{ date('m/d/Y', strtotime($obj->start_date)) }}</td>
                                <td>{{ date('m/d/Y', strtotime($obj->end_date)) }}</td>
                                @if ($obj->paid == 1)
                                    <td>Weekly</td>
                                @elseif ($obj->paid == 2)
                                    <td>Bi-weekly</td>
                                @endif
                                <td>{{ $obj->number_workers }}</td>
                                @if ($obj->request_status_id)
                                    @if ($obj->request_status_id == 1)
                                        <td>
                                            <div class="btn btn-warning btn-block">{{ $obj->status->name }}</div>
                                        </td>
                                    @elseif ($obj->request_status_id == 2)
                                        <td>
                                            <div class="btn btn-info btn-block">{{ $obj->status->name }}</div>
                                        </td>
                                    @elseif ($obj->request_status_id == 3)
                                        <td>
                                            <div class="btn btn-success btn-block">{{ $obj->status->name }}</div>
                                        </td>
                                    @endif
                                @else
                                    <td></td>
                                @endif
                                <td align="center">
                                    <a href="{{ url('job_request') }}/{{ $obj->id }}/edit" class="on-default edit-row">
                                        <i class="fa fa-edit fa-lg"></i></a>

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
