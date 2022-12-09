@extends ('dashboard')
@section('contenido')
    <!-- Plugin css for this page -->
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])

    <div class="col-md-12 grid-margin stretch-card">

        <div class="card row">


            <div class="card-body">
                <div class="col-md-12 row">
                    <div class="col-md-6">
                        <h4 class="card-title">Permissions listing</h4>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                            data-target=".bd-example-modal-lg">New</button>
                    </div>

                </div>
                <div class="col-md-12 row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">

                        <table id="example" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $obj)
                                    <tr>
                                        <td>{{ $obj->id }}</td>
                                        <td>{{ $obj->name }}</td>
                                        <td align="center">
                                            <a href="{{ url('permission') }}/{{ $obj->id }}/edit"
                                                class="on-default edit-row">
                                                <i class="icon icon-form lg"></i></a>
                                            &nbsp;&nbsp;
                                            <a href="" data-target="#modal-delete-{{ $obj->id }}" data-toggle="modal"><i class="fa fa-trash"></i></a>
                                            <!--<i class="fa fa-trash lg" onclick="modal({{ $obj->id }})"></i>-->
                                        </td>
                                    </tr>
                                    @include('security.permission.modal')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Permissions</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{ url('permission') }}" method="POST" class="forms-sample">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Permissions</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('permission.destroy', $obj->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Do you want to delete the record?</h5>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @include('sweetalert::alert')
    </div>

    <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        /*$(document).ready(function() {

                });*/

        function modal(id) {
            $('#modal_delete').modal('show');
        }
    </script>
@endsection
