@extends ('dashboard')
@section('contenido')
    <!-- Plugin css for this page -->
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])




    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-md-6">
                            <h4 class="card-title">Users listing</h4>
                        </div>
                        <div class="col-md-6">
                            @can('create acount')
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                    data-target=".bd-example-modal-lg">New</button>
                            @endcan

                        </div>
                    </div>
                    <div class="card-body">

                        <div class="col-md-12">&nbsp;</div>
                        <table id="example" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Case manager</th>
                                    <th>Country</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($case_managers)
                                    @foreach ($case_managers as $obj)
                                        <tr>
                                            <td>{{ $obj->id }}</td>
                                            <td>{{ $obj->email }}</td>
                                            <td>{{ $obj->name }} {{ $obj->last_name }}</td>
                                            <td>{{ $obj->role }}</td>
                                            @if ($obj->case_manager)
                                                <td>{{ $obj->case_managers->name }}</td>
                                            @else
                                                <td></td>
                                            @endif

                                            @if ($obj->country_id)
                                                <td>{{ $obj->countries->cc_country }}</td>
                                            @else
                                                <td></td>
                                            @endif

                                            <td align="center">
                                                @can('edit acount')
                                                    <a href="{{ url('user') }}/{{ $obj->id }}/edit"
                                                        class="on-default edit-row">
                                                        <i class="icon icon-form lg"></i></a>
                                                    &nbsp;&nbsp;
                                                    <a href="" data-target="#modal-delete-{{ $obj->id }}"
                                                        data-toggle="modal"><i class="fa fa-trash"></i></a>
                                                @endcan
                                                <!--<i class="fa fa-trash lg" onclick="modal({{ $obj->id }})"></i>-->
                                            </td>
                                        </tr>
                                        @include('security.user.modal')
                                    @endforeach
                                @endif

                                @if ($recluters->count() > 0)
                                    @foreach ($recluters as $obj)
                                        <tr>
                                            <td>{{ $obj->id }}</td>
                                            <td>{{ $obj->email }}</td>
                                            <td>{{ $obj->name }} {{ $obj->last_name }}</td>
                                            <td>{{ $obj->role }}</td>
                                            @if ($obj->case_manager)
                                                <td>{{ $obj->case_managers->name }}</td>
                                            @else
                                                <td></td>
                                            @endif

                                            @if ($obj->country_id)
                                                <td>{{ $obj->countries->cc_country }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td align="center">
                                                @can('edit acount')
                                                    <a href="{{ url('user') }}/{{ $obj->id }}/edit"
                                                        class="on-default edit-row">
                                                        <i class="icon icon-form lg"></i></a>
                                                    &nbsp;&nbsp;
                                                    <a href="" data-target="#modal-delete-{{ $obj->id }}"
                                                        data-toggle="modal"><i class="fa fa-trash"></i></a>
                                                    <!--<i class="fa fa-trash lg" onclick="modal({{ $obj->id }})"></i>-->
                                                @endcan
                                            </td>
                                        </tr>
                                        @include('security.user.modal')
                                    @endforeach
                                @endif


                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane fade" id="home" role="tabpanel">
                        <div class="col-md-12">&nbsp;</div>


                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade bd-example-modal-lg" tabindex="-1" user="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Users</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form action="{{ url('account') }}" method="POST" class="forms-sample">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Role</label>
                                    <select name="role" id="role" class="form-control">
                                        @foreach ($roles as $obj)
                                            <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group" id="div_case_manager">
                                    <label for="exampleInputEmail1">Case manager</label>
                                    <select name="case_manager" id="case_manager" class="form-control">
                                        @if ($case_managers)
                                            @foreach ($case_managers as $obj)
                                                <option value="{{ $obj->id }}">{{ $obj->name }}
                                                    {{ $obj->last_name }}
                                                </option>
                                            @endforeach
                                        @endif

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Last name</label>
                                    <input type="text" name="last_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="text" name="password" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Country</label>
                                    <select name="country" class="form-control select2">
                                        @foreach ($countries as $obj)
                                            <option value="{{ $obj->id }}">{{ $obj->cc_country }}</option>
                                        @endforeach
                                    </select>
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




    @include('sweetalert::alert')
    </div>

    <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#div_case_manager').hide();
        });

        $("#role").change(function() {
            if (document.getElementById('role').value == 4) {
                $('#div_case_manager').hide();
            } else if (document.getElementById('role').value == 5) {
                $('#div_case_manager').show();
            }

        });
    </script>
@endsection
