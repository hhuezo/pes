@extends ('dashboard')
@section('contenido')

  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('template/vendors/mdi/css/materialdesignicons.min.css') }}">

<div class="col-md-12 grid-margin stretch-card">

    <div class="card row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Employer listing</h4>


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
                                            <i class="mdi mdi-table-edit lg"></i></a>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>

                    </table>



                </div>
            </div>

        </div>
    </div>
</div>




@endsection
