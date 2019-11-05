@extends('front.index')
@push('title')
    من نحن
@endpush
@push('href')
    @if(auth()->guard('client')->check())
        <a href="{{url('user/signout')}}"><button class="btn login-btn shadow">خروج</button></a>
   @else
       <a  class="new-account"href="{{url('user/signup')}}">انشاء حــساب جديد</a>
       <a href="{{url('user/signin')}}"><button class="btn login-btn shadow">دخول</button></a>
   @endif
@endpush
@section('content')

<!-- breedcrumb-->

<section id="breedcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                  <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('homepage')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">من نحن </li>
                          </ol>
                        </nav>

            </div>
            <div class="col-md-12">
                <div class="who-are-we shadow">
                <img class="we-logo" src="{{asset('public/client/imgs/logo.png')}}">

                <p class="who-text">{{$settings->about_app}}</p>


                </div>


            </div>
        </div>
        </div>
    @endsection
