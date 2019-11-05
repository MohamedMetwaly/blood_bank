@extends('front.index')

@push('title')
إعادة تعيين كلمه المرور
@endpush

@section('content')

    <!-- breedcrumb-->

    <section id="breedcrumb">
        
            <div class="row">
                <div class="col-md-12 signup-form">
                    {!! Form::open(['action'=> 'client\AuthController@NewPassword', 'method' => 'POST']) !!}
                    <div class="form-row">
                        <input type="text" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" placeholder="البريد الاكتروني">
                        @error('email')
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
                    <button class="btn btn-create shadow" type="submit">حفظ</button>
                    {!! Form::close() !!}



                </div>

            </div>
        </div>
    </section>

@endsection
