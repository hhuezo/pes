@extends ('dashboard')
@section('contenido')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])


    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Role</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('role.update', $role->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input name="name" required value="{{ $role->name }}" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-12" style="text-align: right;">
                            <a href="{{ url('role') }}"><button type="button" class="btn btn-light">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-7">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Permissions</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('permission/link') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Permision</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="role" value="{{ $role->id }}">
                                <select name="permission" class="form-control select2">
                                    @foreach ($permissions as $obj)
                                        <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12" style="text-align: right;">
                            <a href="{{ url('role') }}"><button type="button" class="btn btn-light">Cancel</button></a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12">&nbsp;</div>
                <div class="card-body">
                    <table id="example2" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($current_permissions as $obj)
                                <tr>
                                    <td>{{ $obj->id }}</td>
                                    <td>{{ $obj->name }}</td>
                                    <td align="center">
                                        <i class="fa fa-trash" onclick="modal({{$obj->id}})"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>






            </div>
        </div>




        <div class="modal fade bd-example-modal-lg" id="modal_delete" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Permission</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('permission/unlink') }}" method="POST" class="forms-sample">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="permission" id="permission">
                            <input type="hidden" name="role" value="{{ $role->id }}">
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
        <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {

            });

            function modal(id) {
                document.getElementById('permission').value = id;
                $('#modal_delete').modal('show');
            }
        </script>
    @endsection
