<html>

<head>
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">
    <style>
        .head_p {
            position: absolute;

            top: 50.09%;
            bottom: 98.7%;

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 800;
            font-size: 20px;
            line-height: 24px;

            color: #FFFFFF;
        }
    </style>

</head>

<body>
    <div class="col-xl-12 row" style="Height: 40px">&nbsp;</div>
    <div class="col-xl-12 row">
        <div class="col-xl-1">
            <p class="head_p">&nbsp;</p>
        </div>
        <div class="col-xl-1">
            <img class="logo-compact" src="{{ asset('img/logo_white.png') }}" alt="">
        </div>
        <div class="col-xl-1">
            <p class="head_p">&nbsp;</p>
        </div>
        <div class="col-xl-1">
            <p class="head_p">HOME</p>
        </div>
        <div class="col-xl-1">
            <p class="head_p">ABOUT US</p>
        </div>
        <div class="col-xl-1">
            <p class="head_p">CONTACT US</p>
        </div>
        <div class="col-xl-1">
            <p class="head_p">QUICK LINKS</p>
        </div>
        <div class="col-xl-1">
            <p class="head_p">SERVICES</p>
        </div>
        <div class="col-xl-1">
            <p class="head_p">H2B Info</p>
        </div>

        <div class="col-xl-1">
            <p class="head_p">&nbsp;</p>
        </div>


        <div class="col-xl-1">
            <a href="{{ route('login') }}"> <p class="head_p">Log in</p></a>
        </div>
        <div class="col-xl-1">
            <a href="{{ route('register') }}"><p class="head_p">Register</p></a>
        </div>


    </div>
    <div class="col-xl-12 row" style="Height: 40px">&nbsp;</div>

</body>

</html>
