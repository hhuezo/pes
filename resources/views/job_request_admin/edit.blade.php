@extends ('dashboard')
@section('contenido')
    <!-- /.box -->


    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <div class="col-xl-12 col-xxl-12">

        <div class="card">

            <div class="card-header">
                <h4 class="card-title">Requirements</h4>

            </div>

            <div class="card-body">
                <img src="{{ asset('img/pes_admin.png') }}">
                Client: Sheraton Hotel &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ID: 3423423432
            </div>

            <hr>


            <div class="card-body">
                Date assigned: 25/12/2022
            </div>

        </div>
        @include('sweetalert::alert')
    </div>
@endsection
