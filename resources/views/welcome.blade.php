<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    @laravelPWA
    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">

    <!-- Styles -->


    <style>
        body {
            font-family: 'Montserrat';
            background-image: url("{{ asset('img/background.png') }}");
        }

        .vector1 {
            position: absolute;
            left: 0%;
            right: 87.07%;
            top: 0%;
        }

        .vector2 {
            position: absolute;
            top: 0%;
        }


        .vector3 {
            position: absolute;
            right: 0%;
            top: 0%;
            left: 0.67%;
        }

        .p1 {
            position: absolute;
            left: 4.91%;
            right: 55.33%;
            top: 2.39%;
            bottom: 94.3%;

            font-family: 'Montserrat';
            font-style: normal;
            font-size: 140px;
            line-height: 90.9%;
            font-weight: 800;
            /* or 127px */


            color: #FFFFFF;
        }

        .p2 {
            position: absolute;
            margin-inline-start: 4%;
            font-size: 20px;
            margin-top: 6.99%;
            color: #FFFFFF;
        }

        .div_right {
            background: #FFFFFF;
            margin-top: 100px;
        }

        .img_right {
            width: 98%;
            margin: 20px;
        }
    </style>
</head>

<body class="antialiased">

    <img class="vector1" src="{{ asset('img/vector1.png') }}">
    <img class="vector2" src="{{ asset('img/vector2.png') }}">
    <img class="vector3" src="{{ asset('img/vector3.png') }}">

    <div class="col-xl-12 row">
        @include('header')
    </div>

    <div class="col-xl-12 row">

        <div class="col-xl-6 row">
            <div class="col-xl-1 row">
                &nbsp;
            </div>
            <div class="col-xl-11 row">
                <div class="col-xl-12">
                    <h1 class="p1">PRACTICAL
                        EMPLOYEE
                        SOLUTION</h1>
                </div>
                <div class="col-xl-12">
                    <p class="p2">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                        euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,
                        quis
                        nos</p>
                </div>
            </div>

        </div>
        <div class="col-xl-6 row div_right">
            <img class="img_right" src="{{ asset('img/Rectangle.png') }}">
        </div>
    </div>

</body>

</html>
