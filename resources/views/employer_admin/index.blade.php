@extends ('dashboard')
@section('contenido')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <div class="col-xl-12 col-xxl-12">

        <div class="card">

            <div class="card-header">
                <h4 class="card-title">Employers listing</h4>
            </div>

            <div class="card-body">
                <table id="example" class="display" style="min-width: 845px">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>State</th>

                            <th>City</th>
                            <th>Validation</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($employers as $obj)
                            <tr>
                                <td>
                                    <span class="success"><i class="fa fa-user fa-lg"></i></span>&nbsp;&nbsp;
                                    {{ $obj->legal_business_name }}
                                </td>
                                @if ($obj->principal_state_id)
                                    <td>{{ $obj->principal_state->cs_state }}</td>
                                @else
                                    <td></td>
                                @endif

                                @if ($obj->principal_city_id)
                                    <td>{{ $obj->principal_city->czc_city }}</td>
                                @else
                                    <td></td>
                                @endif

                                @if ($obj->validated == 0)
                                    <td><div class="btn btn-warning">  {{ $estate[$obj->validated] }} </div></td>
                                @elseif ($obj->validated == 1)
                                <td><div class="btn btn-info">  {{ $estate[$obj->validated] }} </div></td>
                                @endif
                                <td align="center">
                                    <a href="{{ url('employer_admin') }}/{{ $obj->id }}/edit" class="on-default edit-row">
                                        <i class="fa fa-eye fa-lg"></i></a>
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
