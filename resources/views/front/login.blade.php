@extends('front.index')
@push('title')
تسجيل الدخول
@endpush
@push('href')
    <a href="{{url('user/donation')}}"><button class="btn login-btn shadow">طلب تبرع</button></a>
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
                        <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول </li>
                    </ol>
                </nav>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="article-content shadow">
                    <p class="content">
                        <img  class="log-logo" src="{{asset('public/client/imgs/logo.png')}}">
                        {!! Form::open(['action' => 'client\AuthController@PostLogin', 'method' => 'POST']) !!}
                                <center>@include('flash::message')</center>
                            <div class="form-group">

                                <input type="text" name="phone" value="{{old('phone')}}" class="form-control @error('phone') is-invalid @enderror" placeholder="الجوال">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">

                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="كلمة المرور">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                     </span>
                                @enderror
                            </div>
                            <div class="form-check ">
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input type="checkbox" name="remember" class="custom-control-input" >
                                    <label class="custom-control-label">تذكرني</label>
                                </div>


                            </div>
                            <div class="did-u-forget clearfix">
                                <a class="forget-pass" href="{{url('user/resetPassword')}}"><p class="forget ">هل نسيت كلمة المرور</p></a>
                    <img class="complian forget"src="{{asset('public/client/imgs/complain.png')}}">

                </div>
                <div class="form-btns">
                    <button type="submit" class="btn btn-login">دخول </button>
                    <a href="{{url('user/signup')}}" class="btn btn-new">انشاء حساب جديد </a>
                </div>
                {!! Form::close() !!}

            </div>

        </div>

    </div>
    </div>
</section>
@endsection
