<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Bootstrap Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">

    <style>
        body {
            background-image: url("{{ asset('img/background.png') }}");
        }
    </style>
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <form action="{{ url('register') }}" method="POST">
                                        @csrf
                                        <h4 class="text-center mb-4">Sign up your account</h4>

                                        <div class="form-group">
                                            <label><strong>{!! trans('employer.LegalName') !!}</strong></label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                required>
                                        </div>
                                        <div id="alert_email" class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">&times;</button>
                                            <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                            error, there is already a user with this email.
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input id="password" name="password" type="password" minlength="8"
                                                maxlength="20" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Confirm Password</strong></label>
                                            <input type="password" name="password_confirmation" minlength="8"
                                                maxlength="20" id="confirm_pass" class="form-control" required>
                                        </div>
                                        <div id="alert_pass" class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">&times;</button>
                                            <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                            error, The passwords do not match.
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">Sign me up</button>
                                        </div>


                                        <div class="new-account mt-3">
                                            <p>Already have an account? <a class="text-primary"
                                                    href="{{ url('login') }}">Sign
                                                    in</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('template/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('template/js/quixnav-init.js') }}"></script>
    <!--endRemoveIf(production)-->
</body>

<script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript">
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



    $(document).ready(function() {
        $('#alert_email').hide();
        $('#alert_pass').hide();
    });
</script>

</html>
