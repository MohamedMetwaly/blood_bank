@extends('front.index')
@push('title')
    تفاصيل الطلب
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
              <div class="col-md-12" style="padding: 0;">
                    <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('homepage')}}">الرئيسية</a></li>
                              <li class="breadcrumb-item active" aria-current="page">طلب التبرع:احمد محمد</li>
                            </ol>
                          </nav>

              </div>
          </div>

          <div class="row bg-for-details">
              <div class="col-md-6">

              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text">الاسم</div>
                </div>
                <input type="text" class="form-control bg-white" id="inlineFormInputGroup" value="{{$detail->name}}" disabled>
              </div>
              <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">العمر</div>
                  </div>
                  <input type="text" class="form-control bg-white" id="inlineFormInputGroup" value="{{$detail->age}}" disabled>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">المشفي</div>
                    </div>
                    <input type="text" class="form-control bg-white" id="inlineFormInputGroup" value="{{$detail->hospital_name}}" disabled>
                  </div>
          </div>

          <div class="col-md-6">

              <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">فصيلة الدم</div>
                  </div>
                  <input type="text" class="form-control bg-white" id="inlineFormInputGroup" value="{{$detail->bloodtype->name}}" disabled>
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">عدد الاكياس المطلوبة</div>
                    </div>
                    <input type="text" class="form-control bg-white" id="inlineFormInputGroup" value="{{$detail->bags_num}}" disabled>
                  </div>
                  <div class="input-group mb-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">رقم الجوال</div>
                      </div>
                      <input type="text" class="form-control bg-white" id="inlineFormInputGroup" value="+{{$detail->phone}}" disabled>
                    </div>
            </div>
          </div>
<div class="row bg-white">
  <div class="col-md-12">
    <div class="input-group mb-2">
      <div class="input-group-prepend">
        <div class="input-group-text">عنوان المشفي </div>
      </div>
      <input type="text" class="form-control bg-white" id="inlineFormInputGroup" value="+{{$detail->hospital_address}}" disabled>
    </div>

  </div>

</div>

<div class="row bg-white">
<div class="col-md-12">
<P class="details-text">هذا النص هو مثال لنص يمكن ان يستبدل فى نفس المساحه, لقد تم توليد هذا النص من مولد النص العربى حيث يمكنك توليد مثل هذا النص أو العديد من النصوص الاخرى إضافة الى زيادة عدد الحروف التى يولدها التطبيق يطلع على صوره حقيقية للتصمصم هذا النص هو مثال لنص يمكن ان يستبدل فى نفس المساحه, لقد تم توليد هذا النص من مولد النص العربى حيث يمكنك توليد مثل هذا النص أو العديد من النصوص الاخرى إضافة الى زيادة عدد الحروف التى يولدها التطبيق يطلع على صوره حقيقية للتصمصم هذا النص هو مثال لنص يمكن ان يستبدل فى نفس المساحه, لقد تم توليد هذا النص من مولد النص العربى حيث يمكنك توليد مثل هذا النص أو العديد من النصوص الاخرى إضافة الى زيادة عدد الحروف التى يولدها التطبيق يطلع على صوره حقيقية للتصمصم</P>

</div>

</div>
<div class="row bg-white">
  <div class="col-md-12 map">
    <iframe src="https://www.google.com/maps/embed/v1/MODE?key=AIzaSyDAyV45F7BxlxyEYOZ-fcwSij0GYinnIJ0" width="1110" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>

  </div>
</div>




     </div>



</section>
@endsection
