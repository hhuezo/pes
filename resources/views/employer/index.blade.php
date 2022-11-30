@extends ('dashboard')
@section('contenido')
    <!-- /.box -->

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title"><strong>Employer listing</strong></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{!! trans('employer.LegalName') !!}</th>
                        <th>{!! trans('employer.IdentificationNumber') !!}</th>
                        <th>{!! trans('employer.PrimaryBusiness') !!}</th>
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
                            @if ($obj->primary_business_type_id)
                                <td>{{ $obj->naicsCode->name }}</td>
                            @else
                                <td></td>
                            @endif
                            <td>{{ $obj->primary_business_phone }}</td>
                            @if ($obj->validated ==0 || $obj->validated ==1)
                                <td>{{ $estate[$obj->validated] }} </td>
                            @else
                                <td></td>
                            @endif
                            <td align="center">
                                <a href="{{ url('employer') }}/{{ $obj->id }}/edit" class="on-default edit-row">
                                    <i class="fa fa-edit fa-lg"></i></a>
                            </td>
                        </tr>
                    @endforeach


                </tbody>

            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection
