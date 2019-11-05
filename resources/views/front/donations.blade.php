@extends('front.index')
@push('title')
    بنك الدم الرئيسية
@endpush
@push('href')
    @if(auth()->guard('client')->check())
        <a href="{{url('user/signout')}}"><button class="btn login-btn shadow">خروج</button></a>
        <a href="{{url('user/donation')}}"><button class="btn login-btn shadow">طلب تبرع</button></a>
   @else
        <a href="{{url('user/donation')}}"><button class="btn login-btn shadow">طلب تبرع</button></a>
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
                            <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
                          </ol>
                        </nav>

            </div>
        </div>
        </div>

<h2 class="donations-head horizntal-line">طلبات التبرع </h2>

 <!-- Donations offers  -->
<section id="donations">
<div class="container custom-position">
<div class="row  dropdown">
<div class="col-md-5">
    <select class="custom-select">
        <option selected>اختر فصيلة الدم </option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
</div>

<div class="col-md-5">
    <select class="custom-select">
        <option selected>اختر المدينة </option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>

</div>
<div class="col-md-2 search">
<div class="circle search-icon"><i class="fas fa-search search-icon"></i></div>

</div>

</div>
    @foreach($donations as $donation)
        <div class="row background-div ">
            <div class="col-lg-2">
            <div class="blood-type border-circle">
            <div class="blood-txt">
                {{$donation->bloodtype->name}}
            </div>

            </div>
            </div>
            <div class="col-lg-7">
            <ul class="order-details">
              <li class="cutom-display">   اسم الحالة:</li>
              <span class="cutom-display">{{$donation->name}}</span> <br>

              <li class="cutom-display custom-padding" >  مستشفي:</li>
              <span class="cutom-display custom-padding">{{$donation->hospital_name}}</span> <br>
              <div class="adjust-position">  <li class="cutom-display ">  المدينة:</li>
                <span class="cutom-display ">{{$donation->city->name}}</span></div>


            </ul>

            </div>
            <div class="col-lg-3">
                <a href="{{url('user/donation/'.$donation->id)}}"><button class="btn more2-btn">التفاصيل </button></a>
            </div>

        </div>
    @endforeach
            <nav class="pagi" aria-label="Page navigation example" style="

            display: -webkit-box;
            text-align: -webkit-center;
            margin-top: 3rem;
        ">

                <ul class="pagination  pagination-lg ">
                  <li class="page-item">
                    {{$donations->render()}}
                  </li>
                </ul>
              </nav>
</div>
</section>

@endsection
