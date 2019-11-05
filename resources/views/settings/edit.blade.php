@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           الإعدادات
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> الرئسية</a></li>
            <li class="active">الإعدادات</li>
        </ol>
    </section>



    <!-- Main content -->
    <section class="content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                {!!Form::model($model,[
                    'action' => ['SettingController@update',$model->id],
                    'method' => 'put'
                ])!!}

                    <div class="form-group">
                        <label for="fb_link">رابط فيس بوك</label>
                        {!!Form::text('fb_link',old('fb_link'),[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                    <div class="form-group">
                        <label for="tw_link">رابط تويتر</label>
                        {!!Form::text('tw_link',old('tw_link'),[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                    <div class="form-group">
                        <label for="yt_link">رابط يوتيوب</label>
                        {!!Form::text('yt_link',old('yt_link'),[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                    <div class="form-group">
                        <label for="insta_link">رابط انستجرام</label>
                        {!!Form::text('insta_link',old('insta_link'),[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                    <div class="form-group">
                        <label for="google_link">رابط جوجل بلس</label>
                        {!!Form::text('google_link',old('google_link'),[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                    <div class="form-group">
                        <label for="phone">الهاتف</label>
                        {!!Form::text('phone',old('phone'),[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                    <div class="form-group">
                        <label for="email">الإيميل</label>
                        {!!Form::text('email',old('email'),[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                    <div class="form-group">
                        <label for="about_app">معلومات عن التطبيق</label>
                        {!!Form::text('about_app',old('about_app'),[
                            'class' => 'form-control'
                        ])!!}
                    </div>                 
                    <div class="form-group">
                        <button class="btn btn-success" type="Submit">حفظ</button>
                    </div>

                {!!Form::close()!!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
