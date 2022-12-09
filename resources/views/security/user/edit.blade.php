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
                                            <input name="name" required value="{{ $user->name }}"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-12" style="text-align: right;">
                                        <a href="{{url('user')}}"><button type="button" class="btn btn-light">Cancel</button></a>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>




                                </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
