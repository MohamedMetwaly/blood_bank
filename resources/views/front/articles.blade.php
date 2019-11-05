@extends('front.index')
@push('title')
    المقالات
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

      <section id="breedcrumb" style="
      padding-bottom: 2rem;
  ">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('homepage')}}">الرئيسية</a></li>
                              <li class="breadcrumb-item active" aria-current="page">المقالات</li>
                            </ol>
                          </nav>

              </div>
          </div>
          <div class="row">
        <div class="col-md-12">
            @foreach($details as $detail)
        <img class="article-img shadow p-3 mb-5 " src="{{asset($detail->image)}}">
            <div class="artilce-head">
                <p class="article-name">{{$detail->title}}</p>
            </div>
            <div class="article-content shadow">
                <p class="card-text">{{$detail->content}}</p>
                <img class="share-icon custom-position" src="{{asset('public/client/imgs/social-share-symbol.png')}}">
                <p class="custom-position2">شارك هذه المقاله :</p>
                <div class="social-share">
                  <i class="fab fa-facebook-square"></i>
                  <i class="fab fa-twitter-square"></i>

                  <i class="fab fa-google-plus-square"></i>


                </div>

            </div>
            @endforeach

        </div>
        <nav class="pagi" aria-label="Page navigation example" style="

            display: -webkit-box;
            text-align: -webkit-center;
            margin-top: 3rem;
        ">

                <ul class="pagination  pagination-lg ">
                  <li class="page-item">
                    {{$details->render()}}
                  </li>
                </ul>
              </nav>
          </div>

      </div>

</section>

@endsection

