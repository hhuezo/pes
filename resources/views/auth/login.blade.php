<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Bootstrap Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('template/images/favicon.png') }}">
     <!-- Custom Stylesheet -->
     <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">

</head>

<body class="h-100">

    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12 row">
                                <div class="col-xl-6">
                                   <img src="{{ asset('img/pesimagen-30 1.png') }}" style="Width: 100%">
                                </div>
                                <div class="col-xl-6">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Login Account</h4>

                                    <p class="text-center mb-4" style="font-size: 8.785px;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nos</p>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email ID" id="email" name="email" :value="old('email')" required autofocus>
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" class="form-control" id="password" type="password" placeholder="********"
                                            name="password" required autocomplete="current-password" >
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <div class="form-check ml-2">
                                                    <input class="form-check-input" type="checkbox" id="basic_checkbox_1">
                                                    <label class="form-check-label" for="basic_checkbox_1">Keep me signed in</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <a href="page-forgot-password.html">Forgot your password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block btn-rounded">LOG IN</button>
                                        </div>
                                    </form>
                                    <div class="text-center">&nbsp;&nbsp;</div>
                                    <div class="text-center">
                                        <a href="{{url('register')}}"><button type="button" class="btn btn-primary btn-block btn-rounded">CREATE ACCOUNT</button></a>
                                    </div>
                                </div>
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
    <script src="{{ asset('template/js/custom.min.js') }}"></script>

</body>

</html>
