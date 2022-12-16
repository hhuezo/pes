@extends ('dashboard')
@section('contenido')
    <!-- /.box -->


    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <div class="col-xl-12 col-xxl-12">

        <div class="card">

            <div class="card-header">
                <h4 class="card-title">Case managers</h4>
            </div>

            <div class="card-body">
                <table id="example" class="display" style="min-width: 845px">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Date admission</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach ($case_managers as $obj)
                            <tr>
                                <td>{{ $obj->name }} {{ $obj->last_name }}</td>
                                <td>{{ $obj->email }}</td>
                                @if ($obj->country)
                                <td>{{ $obj->countries->name }}</td>
                                @else
                                <td></td>
                                @endif
                                <td>{{ $obj->date_admission }}</td>
                                <td align="center">
                                    <a href="{{ url('employer') }}/{{ $obj->id }}/edit" class="on-default edit-row">
                                        <i class="fa fa-pencil fa-lg"></i></a>
                                        &nbsp;
                                        <a href="{{ url('employer') }}/{{ $obj->id }}/edit" class="on-default edit-row">
                                            <i class="fa fa-trash fa-lg"></i></a>
                                            &nbsp;
                                            <a href="{{ url('employer') }}/{{ $obj->id }}/edit" class="on-default edit-row">
                                                <i class="fa fa-ellipsis-h"></i></a>

                                </td>
                            </tr>
                            @php($i++)
                        @endforeach


                    </tbody>

                </table>

            </div>

        </div>
        @include('sweetalert::alert')
    </div>
@endsection
