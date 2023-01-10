@extends ('dashboard2')
@section('contenido')
@include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
<div class="row">
    <div class="col-xl-12 col-xxl-12">
        <div class="card">
            <div class="card-header">
                <div class="col-xl-12 col-xxl-12">
                    <h4 class="card-title">Register</h4>

                </div>
            </div>
            <div class="card-body">


                <div class="col-xl-12 col-xxl-12 row">

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="exampleInputUsername1">Contact Name</label>
                            <input type="text" name="primary_contact_name" required class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="exampleInputUsername1">Contact Middle Name</label>
                            <input type="text" name="contact_middle_name" required class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="exampleInputUsername1">Contact Last Name</label>
                            <input type="text" name="primary_contact_last_name" required class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="exampleInputUsername1">Contact Middle Name</label>
                            <input type="text" name="contact_middle_name" required class="form-control">
                        </div>
                    </div>


                </div>



            </div>

        </div>
    </div>
</div>






@endsection
