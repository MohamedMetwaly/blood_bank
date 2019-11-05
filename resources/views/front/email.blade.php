@extends('front.index')

@push('title')
ارسال بريد الالكترونى
@endpush

@section('content')

    <!-- breedcrumb-->

    <section id="breedcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12 signup-form">
                    {!! Form::open(['action'=> 'client\AuthController@SendEmail', 'method' => 'POST']) !!}
                    <div class="form-row">

                        <input type="text" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" placeholder="البريد الاكتروني">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <button class="btn btn-create shadow" type="submit">ارسال</button>
                    {!! Form::close() !!}



                </div>

            </div>
        </div>
    </section>

@endsection
