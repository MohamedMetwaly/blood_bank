@extends('front.index')
@push('title')
    بنك الدم الرئيسية
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

        <img class="article-img shadow p-3 mb-5 " src="{{asset($detail->image)}}">
            <div class="artilce-head">
                <p class="article-name">{{$detail->title}}</p>
            </div>
            <div class="article-content shadow">
                <p class="card-text">{{$detail->content}}</p>
                <img class="share-icon custom-position" src="{{asset('public/client/imgs/social-share-symbol.png')}}">
                <p class="custom-position2">شارك هذه المقاله :</p>
                <div class="social-share">
                  <a href="{{$settings->fb_link}}" target="_blank"><i class="fab fa-facebook-square"></i></a>
                  <a href="{{$settings->tw_link}}" target="_blank"><i class="fab fa-twitter-square"></i></a>
                  <a href="{{$settings->google_link}}" target="_blank"><i class="fab fa-google-plus-square"></i></a>


                </div>

            </div>


        </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <section id="articles">
                <h2 class="articles-relative">مقالات ذات صلة  </h2>
                <div class="container custom" style="direction: ltr">
                  <div class="owl-carousel owl-theme" id="owl-articles">
                      @foreach($posts as $post)
                        <div class="item">
                          <div class="card" style="width: 22rem;">
                              <i id="{{$post->id}}" onclick="toggleFavourite(this)"  class="fab fa-gratipay first-heart {{
                                $post->is_favourite ? 'second-heart' : 'first-heart'}}">
                              </i>
                            <img class="card-img-top" src="{{asset($post->image)}}" alt="Card image cap">
                            <div class="card-body">
                              <h5 class="card-title">{{$post->title}}</h5>
                                <p class="card-text">{{$post->content}}</p>
                              <a href="article.html"><button class="btn details-btn">التفاصيل </button></a>
                            </div>
                          </div>
                        </div>
                      @endforeach
                  </div>

                </div>
                </section>

            </div>

          </div>
      </div>

</section>

     @push('script')
         <script>
             function toggleFavourite(heart) {
                 var post_id = heart.id;
                 $.ajax({
                     url : '{{url('user/toggle')}}',
                     type : 'post',
                     data : { _token : ' {{csrf_token()}}',post_id:post_id},
                     success : function (data) {
                         if (data.status == 1)
                         {
                             var currentClass = $(heart).attr('class');
                             if (currentClass.includes('first')) {
                                 $(heart).removeClass('first-heart').addClass('second-heart');
                             } else {
                                 $(heart).removeClass('second-heart').addClass('first-heart');
                             }
                         }
                     }
                 });

             }
         </script>
     @endpush

@endsection

