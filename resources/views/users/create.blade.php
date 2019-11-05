@extends('layouts.app')

@inject('model','App\User')
@inject('role','App\Role')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           إضافه مستخدم
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> الرئسية</a></li>
            <li class="active">إضافه مستخدم</li>
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
                    'action' => 'UserController@store'
                ])!!}

                    <div class="form-group">
                        <label for="name">الاسم</label>
                        {!!Form::text('name',null,[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                    <div class="form-group">
                        <label for="email">الايميل</label>
                        {!!Form::text('email',null,[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                    <div class="form-group">
                        <label for="password">كلمه المرور</label><br>
                        {!!Form::password('password',[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">تأكيد كلمه المرور</label><br>
                        {!!Form::password('password_confirmation',[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                    <div class="form-group">
                        <label for="roles_list">تحديد الرتبه</label>
                        {!!Form::select('roles_list[]',$role->pluck('display_name','id')->toArray(),null,[
                            'class' => 'form-control',
                            'multiple' => 'multiple'
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
