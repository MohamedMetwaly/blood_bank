@extends('front.index')

@push('title')
طلب تبرع
@endpush
@push('href')
        <a href="{{url('user/signout')}}"><button class="btn login-btn shadow">خروج</button></a>
@endpush
@section('content')


    @inject('cities','App\Models\City')
    @inject('types','App\Models\BloodType')


    <!-- breedcrumb-->

    <section id="breedcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('homepage')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">طلب تبرع</li>
                        </ol>
                    </nav>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12 signup-form">
                    {!! Form::open(['action'=> 'client\MainController@DonationRequest', 'method' => 'POST']) !!}
                    <center>@include('flash::message')</center>
                    <div class="form-row">

                        <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror"  placeholder="الاسم">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="text" name="age" value="{{old('age')}}" class="form-control @error('age') is-invalid @enderror" placeholder="العمر ">
                        @error('age')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="text" name="bags_num" value="{{old('bags_num')}}" class="form-control @error('bags_num') is-invalid @enderror" placeholder="عدد الأكياس ">
                        @error('bags_num')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="text" name="hospital_name" class="form-control @error('hospital_name') is-invalid @enderror" placeholder=" اسم المستشفى">
                        @error('hospital_name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="text" name="hospital_address" class="form-control @error('hospital_address') is-invalid @enderror" placeholder="  عنوان المستشفى">
                        @error('hospital_address')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

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

                        <select  name="city_id" class="custom-select custom-select-lg mb-3 mt-3 custom-width @error('city_id') is-invalid @enderror">
                            <option selected>المدينة</option>
                            @foreach($cities->all() as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                        @error('city_id')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="text" name="phone" value="{{old('phone')}}" class="form-control @error('phone') is-invalid @enderror" placeholder="رقم الهاتف">
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="text" name="notes" value="{{old('notes')}}" class="form-control @error('notes') is-invalid @enderror" placeholder=" ملاحظات  ">
                        @error('notes')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <button class="btn btn-create shadow" type="submit">انــشاء  </button>
                    {!! Form::close() !!}



                </div>

            </div>
        </div>
    </section>

@endsection
