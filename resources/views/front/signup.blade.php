@extends('front.index')

@push('title')
انشاء حساب جديد
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
                            <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
                        </ol>
                    </nav>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12 signup-form">
                    {!! Form::open(['action'=> 'client\AuthController@PostRegister', 'method' => 'POST']) !!}
                    <div class="form-row">

                        <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror"  placeholder="الاسم">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="text" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" placeholder="البريد الاكتروني">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="text" name="d_o_b" value="{{old('d_o_b')}}" class="form-control @error('d_o_b') is-invalid @enderror" placeholder="تاريخ الميلاد">
                        @error('d_o_b')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="كلمه المرور">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="تأكيد كلمه المرور">
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @inject('types','App\Models\BloodType')

                        <select name="blood_type_id" class="custom-select custom-select-lg mb-3 mt-3 custom-width @error('blood_type_id') is-invalid @enderror">
                            <option selected>فصيلة الدم</option>
                            @foreach($types->all() as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                        @error('blood_type_id')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @inject('governorate','App\Models\Governorate')

                        {!!Form::select('governorate_id',$governorate->pluck('name','id')->toArray(),null,[
                           'class' => 'custom-select custom-select-lg mb-3 mt-3 custom-width',
                           'id' => 'governorates',
                           'placeholder'=>'المحافظة'
                        ])!!}
                        {!!Form::select('city_id',[],null,[
                            'class' => 'custom-select custom-select-lg mb-3 mt-3 custom-width',
                            'id' => 'cities',
                            'placeholder'=>'المدينة'
                        ])!!}


                        <input type="text" name="phone" value="{{old('phone')}}" class="form-control @error('phone') is-invalid @enderror" placeholder="رقم الهاتف">
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="text" name="donation_last_date" value="{{old('donation_last_date')}}" class="form-control @error('donation_last_date') is-invalid @enderror" placeholder=" اخر تاريخ تبرع">
                        @error('donation_last_date')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" >
                            <label class="form-check-label" for="invalidCheck">
                                Agree to terms and conditions
                            </label>
                            <div class="invalid-feedback">
                                You must agree before submitting.
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-create shadow" type="submit">انــشاء  </button>
                    {!! Form::close() !!}



                </div>

            </div>
        </div>
    </section>

    @push('script')

        <script>
            $("#governorates").change(function(e){
                e.preventDefault();
                var governorate_id = $("#governorates").val();
                if(governorate_id)
                {
                    $.ajax({
                        url : '{{url('api/v1/cities?governorate_id=')}}'+governorate_id,
                        type : 'get',
                        success :function(data){
                            if(data.status == 1){
                                $("#cities").empty();
                                $("#cities").append('<option value="">المدينة</option>');
                                console.log(data);
                                $.each(data.data,function(index, city){

                                    $("#cities").append('<option value="'+city.id+'">'+city.name+'</option>');
                                });
                            }
                        },
                        error : function (jqXhr, textStatus, errorMessage){
                            alert(errorMessage);
                        }
                    });
                }else{
                    $("#cities").empty();
                    $("#cities").append('<option value="">المدينة</option>');
                }
            });
        </script>
@endpush
@endsection
