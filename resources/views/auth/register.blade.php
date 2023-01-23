@extends ('dashboard2')
@section('contenido')
    <style>
        body {
            color: #6b6c6d;

        }
    </style>
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-xl-12 col-xxl-12">
                        <h4 class="card-title">Register</h4>
                        <br>
                        * Indicate that the field is required

                    </div>
                </div>
                <div class="card-body">

                    <form action="{{ url('register') }}" method="POST">
                        @csrf
                        <div class="col-xl-12 col-xxl-12 row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Contact Name *</label>
                                    <input type="text" name="primary_contact_name" id="primary_contact_name" required
                                        class="form-control" onblur="validateRequired('primary_contact_name')">
                                    <div id="div_primary_contact_name">
                                        <label for="exampleInputUsername1"
                                            style="background-color: #FF9696; color: red; width: 100%; height: 40px; padding: 10px">This
                                            field is
                                            required</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Contact Middle Name</label>
                                    <input type="text" name="contact_middle_name" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Contact Last Name *</label>
                                    <input type="text" name="primary_contact_last_name" id="primary_contact_last_name"
                                        required class="form-control"
                                        onblur="validateRequired('primary_contact_last_name')">
                                    <div id="div_primary_contact_last_name">
                                        <label for="exampleInputUsername1"
                                            style="background-color: #FF9696; color: red; width: 100%; height: 40px; padding: 10px">This
                                            field is
                                            required</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Position *</label>
                                    <input type="text" name="primary_contact_job_title" id="primary_contact_job_title"
                                        required class="form-control"
                                        onblur="validateRequired('primary_contact_job_title')">
                                    <div id="div_primary_contact_job_title">
                                        <label for="exampleInputUsername1"
                                            style="background-color: #FF9696; color: red; width: 100%; height: 40px; padding: 10px">This
                                            field is required</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Company name *</label>
                                    <input type="text" name="name" id="name" required class="form-control"
                                        onblur="validateRequired('name')">
                                    <div id="div_name">
                                        <label for="exampleInputUsername1"
                                            style="background-color: #FF9696; color: red; width: 100%; height: 40px; padding: 10px">This
                                            field is required</label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Company e-mail *</label>
                                    <input type="email" name="email" id="email" required class="form-control"
                                        onblur="validateRequired('email')">
                                    <div id="div_email">
                                        <label for="exampleInputUsername1"
                                            style="background-color: #FF9696; color: red; width: 100%; height: 40px; padding: 10px">This
                                            field is required</label>
                                    </div>
                                </div>

                                <div id="alert_email" class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                    error, there is already a user with this email.
                                </div>
                            </div>



                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Phone number *</label>
                                    <input type="text" name="primary_business_phone" id="primary_business_phone"
                                        data-inputmask="'mask': ['(999)999-9999']" data-mask required class="form-control"
                                        onblur="validateRequired('primary_business_phone')">
                                    <div id="div_primary_business_phone">
                                        <label for="exampleInputUsername1"
                                            style="background-color: #FF9696; color: red; width: 100%; height: 40px; padding: 10px">This
                                            field is required</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Company website *</label>
                                    <input type="text" name="company_website" id="company_website" required
                                        class="form-control" onblur="validateRequired('company_website')">
                                    <div id="div_company_website">
                                        <label for="exampleInputUsername1"
                                            style="background-color: #FF9696; color: red; width: 100%; height: 40px; padding: 10px">This
                                            field is required</label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Primary Business Type *</label>
                                    <select name="catalog_industry_id" id="catalog_industry_id" required
                                        class="form-control select2" onblur="validateRequired('catalog_industry_id')">
                                        <option value="">Select</option>
                                        @foreach ($industries as $obj)
                                            <option value="{{ $obj->id }}">
                                                {{ $obj->id_code . ' ' . $obj->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <div id="div_catalog_industry_id">
                                        <label for="exampleInputUsername1"
                                            style="background-color: #FF9696; color: red; width: 100%; height: 40px; padding: 10px">This
                                            field is required</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Password *</label>
                                    <input id="password" name="password" type="password" minlength="8" maxlength="20"
                                        class="form-control" required onblur="validateRequired('password')">
                                    <div id="div_password">
                                        <label for="exampleInputUsername1"
                                            style="background-color: #FF9696; color: red; width: 100%; height: 40px; padding: 10px">This
                                            field is required</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Confirm Password *</label>
                                    <input type="password" name="password_confirmation" minlength="8" maxlength="20"
                                        id="confirm_pass" class="form-control" required
                                        onblur="validateRequired('confirm_pass')">
                                    <div id="div_confirm_pass">
                                        <label for="exampleInputUsername1"
                                            style="background-color: #FF9696; color: red; width: 100%; height: 40px; padding: 10px">This
                                            field is required</label>
                                    </div>
                                </div>

                                <div id="alert_pass" class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                    error, The passwords do not match.
                                </div>
                            </div>



                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">Sign me up</button>
                            </div>


                            <div class="col-md-12">
                                <p>Already have an account? <a class="text-primary" href="{{ url('login') }}">Sign
                                        in</a></p>
                            </div>

                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>


    <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $('form').submit(function(event) {
            if (document.getElementById('primary_contact_name').value == '') {
                validateRequired('primary_contact_name');
                event.preventDefault();
                return;
            }

            if (document.getElementById('primary_contact_last_name').value == '') {
                validateRequired('primary_contact_last_name');
                event.preventDefault();
                return;
            }

            if (document.getElementById('primary_contact_job_title').value == '') {
                validateRequired('primary_contact_job_title');
                event.preventDefault();
                return;
            }

            if (document.getElementById('name').value == '') {
                validateRequired('name');
                event.preventDefault();
                return;
            }

            if (document.getElementById('email').value == '') {
                validateRequired('email');
                event.preventDefault();
                return;
            }

            if (document.getElementById('primary_business_phone').value == '') {
                validateRequired('primary_business_phone');
                event.preventDefault();
                return;
            }

            if (document.getElementById('company_website').value == '') {
                validateRequired('company_website');
                event.preventDefault();
                return;
            }

            if (document.getElementById('catalog_industry_id').value == '') {
                validateRequired('catalog_industry_id');
                event.preventDefault();
                return;
            }

            if (document.getElementById('password').value == '') {
                validateRequired('password');
                event.preventDefault();
                return;
            }

            if (document.getElementById('confirm_pass').value == '') {
                validateRequired('confirm_pass');
                event.preventDefault();
                return;
            }

            // $("span").text("Not valid!").show().fadeOut(1000);
            // event.preventDefault();
        });



        $("#email").blur(function() {
            var email = $(this).val();
            $.get("{{ url('validate_email') }}" + '/' + email, function(data) {
                console.log(data);
                if (data != '0') {
                    $('#alert_email').show();
                } else {
                    $('#alert_email').hide();
                }
            });
        });


        $("#password").blur(function() {
            validate_pass();
        });

        $("#confirm_pass").blur(function() {

            validate_pass();
        });




        function validate_pass() {
            // console.log("pass " + document.getElementById('password').value.trim());
            //  console.log("confirm " + document.getElementById('confirm_pass').value.trim());
            if (document.getElementById('password').value.trim() != '' && document.getElementById('confirm_pass').value
                .trim() != '') {
                if (document.getElementById('password').value.trim() != document.getElementById('confirm_pass').value
                    .trim()) {
                    $('#alert_pass').show();
                } else {
                    $('#alert_pass').hide();
                }
            }
        }



        function validateRequired(nombre_field) {

            elemento = document.getElementById(nombre_field);

            if (elemento.value == '') {
                elemento.style.backgroundColor = '#FF9696';
                elemento.focus();
                $('#div_' + nombre_field).show();
            } else {
                elemento.style.backgroundColor = '#FFFFFF';
                $('#div_' + nombre_field).hide();
            }




        }



        $(document).ready(function() {
            $('#alert_email').hide();
            $('#alert_pass').hide();


            //validando divs required
            $('#div_primary_contact_name').hide();
            $('#div_primary_contact_last_name').hide();
            $('#div_primary_contact_job_title').hide();
            $('#div_name').hide();
            $('#div_email').hide();
            $('#div_primary_business_phone').hide();
            $('#div_company_website').hide();
            $('#div_catalog_industry_id').hide();
            $('#div_password').hide();
            $('#div_confirm_pass').hide();

        });
    </script>
@endsection
