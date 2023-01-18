@extends ('dashboard')
@section('contenido')
    <!-- /.box -->


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
                            <th>{!! trans('employer.LegalName') !!}</th>
                            <th>{!! trans('employer.IdentificationNumber') !!}</th>

                            <th>{!! trans('employer.PrimaryBusinessPhone') !!}</th>
                            <th>Validation</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($employers as $obj)
                            <tr>
                                <td>{{ $obj->legal_business_name }}</td>
                                <td>{{ $obj->federal_id_number }}</td>

                                <td>{{ $obj->primary_business_phone }}</td>
                                @if ($obj->validated == 0 || $obj->validated == 1)
                                    <td>{{ $estate[$obj->validated] }} </td>
                                @else
                                    <td></td>
                                @endif
                                <td align="center">
                                    <a href="{{ url('employer') }}/{{ $obj->id }}/edit" class="on-default edit-row">
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
