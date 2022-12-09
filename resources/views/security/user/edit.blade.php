@extends ('dashboard')
@section('contenido')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="basic-form">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input name="name" required value="{{ $user->name }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input name="email" required value="{{ $user->email }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input name="password" type="password" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-12" style="text-align: right;">
                                        <a href="{{ url('user') }}"><button type="button"
                                                class="btn btn-light">Cancel</button></a>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>




                                </div>
                            </div>

                    </form>
                </div>
            </div>


        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Roles</h4>
                </div>


                <div class="card-body row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <form method="POST" action="{{ url('role/link') }}">

                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Permision</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="user" value="{{ $user->id }}">
                                    <select name="role" class="form-control select2">
                                        @foreach ($roles as $obj)
                                            <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12" style="text-align: right;">
                                <a href="{{ url('user') }}"><button type="button"
                                        class="btn btn-light">Cancel</button></a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="col-sm-12">&nbsp;</div>
                <div class="card-body row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($current_roles as $obj)
                                    <tr>
                                        <td>{{ $obj->id }}</td>
                                        <td>{{ $obj->name }}</td>
                                        <td align="center">
                                            <i class="fa fa-trash" onclick="modal({{ $obj->id }})"></i>
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

    </div>


    <div class="modal fade bd-example-modal-lg" id="modal_delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Permission</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{ url('role/unlink') }}" method="POST" class="forms-sample">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="role" id="role">
                        <input type="hidden" name="user" value="{{ $user->id }}">
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
            document.getElementById('role').value = id;
            $('#modal_delete').modal('show');
        }
    </script>
@endsection
