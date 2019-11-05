@extends('front.index')
@push('title')
    اتصل بنا
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
                              <li class="breadcrumb-item active " aria-current="page">تواصل معنا  </li>
                            </ol>
                          </nav>

              </div>
          </div>
          <div class="row some-breathing-room">

            <div class="col-md-6">
                <div class="call-us-div shadow">
                    <div class="div-bg"><p>اتصل بنا </p></div>
                    <img class="logo-in-call" src="{{asset('public/client/imgs/logo.png')}}">
                    <hr class="line">
                    <ul class="list-call">
                        <li>الجوال:{{$settings->phone}}</li>
                        <li>فاكس :+24556646</li>
                        <li>البريد الاكتروني :{{$settings->email}}</li>
                    </ul>
                    <p class="call-us-head2">تواصل معنا</p>
                    <div class="social-icons">
                            <a href="{{$settings->fb_link}}" target="_blank"><i class="fab fa-facebook-square hvr-forward"></i>
                            <a href="{{$settings->tw_link}}" target="_blank"><i class="fab fa-twitter-square hvr-forward"></i>
                            <a href="{{$settings->yt_link}}" target="_blank"><i class="fab fa-youtube-square hvr-forward"></i>
                            <a href="{{$settings->google_link}}" target="_blank"><i class="fab fa-google-plus-square hvr-forward"></i></a>
                    </div>
                            
                </div>

            </div>
            <div class="col-md-6">
                    <div class="call-us-div shadow">
                            <div class="div-bg"><p>اتصل بنا </p></div>
                        <center> @include('flash::message')</center>
                            {!! Form::open(['action' => 'client\MainController@PostContact', 'method' => 'post']) !!}
                                    <div class="form-group some-space">

                                            <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" placeholder="الاسم">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                          </div>
                                    <div class="form-group">

                                      <input type="email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" placeholder="البريد الاكتروني">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">

                                            <input type="text" name="phone" value="{{old('phone')}}" class="form-control @error('phone') is-invalid @enderror" placeholder="الجوال">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                          </div>
                                          <div class="form-group">

                                                <input type="text" name="subject" value="{{old('subject')}}" class="form-control @error('subject') is-invalid @enderror" placeholder="عنوان الرساله">
                                              @error('subject')
                                              <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                              @enderror
                                              </div>
                                              <div class="form-group">

                                                <textarea class="form-control @error('message') is-invalid @enderror" name="message" placeholder="نص الرساله" rows="3"></textarea>
                                                  @error('message')
                                                  <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                  @enderror
                                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                            </div>
                                    <button type="submit" class="btn btn-send-call hvr-float">ارسال</button>
                                  {!! Form::close() !!}


                        </div>

            </div>


          </div>
      </div>
</section>
   @endsection
