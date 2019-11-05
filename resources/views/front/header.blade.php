<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"
          integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- custom CSS -->
    <link rel="stylesheet" href="{{asset('public/client/css/owl.carousel.min.css')}}">
    <link rel=stylesheet href="{{asset('public/client/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/client/css/hover-min.css')}}">
    <link rel="stylesheet" href="{{asset('public/client/css/style.css')}}">
    <!-- custom font -->
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

    <title>@stack('title')</title>
</head>
<body>
<!-- top nav section -->
<section id="top-nav">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="lang">
                    <span><a href="#" id="arabic">عربى</a></span>
                    <span><a href="#" id="en">EN</a></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="social-media">
                    <a href="{{$settings->fb_link}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{$settings->insta_link}}" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="{{$settings->tw_link}}" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="{{$settings->google_link}}" target="_blank"><i class="fab fa-google"></i></a>

                </div>

            </div>
            <div class="col-md-4">
                <div class="contact">

                    <p class="email"> {{$settings->email}}</p>

                    <i class="fas fa-envelope-square email "></i>
                    <p class="phone "> {{$settings->phone}}
                    </p>
                    <i class="fas fa-phone-volume phone hvr-buzz"></i>
                </div>

            </div>
        </div>

    </div>
</section>
<!-- oradaniry nav section -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="nav-logo " href="{{route('homepage')}}"><img class="logo" src="{{asset('public/client/imgs/logo.png')}}"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">

                <a class="nav-link " href="{{route('homepage')}}">الرئيسية   </a>
                <span class="test"></span>



            </li>
            <li class="nav-item">
                <a class="nav-link border-left" href="{{url('user/articles')}}">المقالات</a>
            </li>
            <li class="nav-item">
                <a class="nav-link border-left" href="{{url('user/donations')}}">طلبات التبرع</a>
            </li>
            <li class="nav-item">
                <a class="nav-link border-left" href="{{url('user/about')}}">من نحن</a>

            </li>
            <li class="nav-item">
                <a class="nav-link border-left" href="{{url('user/contact')}}">اتصل بنا </a>
            </li>
        </ul>
        <span class="navbar-text">
            @stack('href')
          </span>
    </div>
</nav>
