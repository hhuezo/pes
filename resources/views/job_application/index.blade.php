@extends ('dashboard')
@section('contenido')
    <!-- /.box -->

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title"><strong>Job applications listing</strong></h3>

            <a href="{{ url('job_application/create') }}"><button type="button" class="btn btn-info float-right" >New</button></a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>

                        <th>Validation</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($job_applications as $obj)
                        <tr>

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
