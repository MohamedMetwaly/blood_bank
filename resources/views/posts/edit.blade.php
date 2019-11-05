@extends('layouts.app')

@inject('category','App\Models\Category')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           تعديل
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i>الرئسية</a></li>
            <li class="active">تعديل</li>
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
                    'action' => ['PostController@update',$model->id],
                    'files' => true,
                    'method' => 'put'
                ])!!}

                    <div class="form-group">
                        <label for="title">العنوان</label>
                        {!!Form::text('title',old('title'),[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                    <div class="form-group">
                        <label for="content">المحتوى</label>
                        {!!Form::text('content',old('content'),[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                    <div class="form-group">
                        <label for="category_id">الفئه</label>
                        {!!Form::select('category_id',$category->pluck('name','id')->toArray(),old('category_id'),[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                    <div class="form-group">
                        <label for="image">الصوره</label>
                        {!!Form::file('image',[
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
