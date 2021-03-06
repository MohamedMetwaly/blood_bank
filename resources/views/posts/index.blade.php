@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            المنشورات
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i>الرئسية</a></li>
            <li class="active">المنشورات</li>
        </ol>
    </section>



    <!-- Main content -->
    <section class="content">
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
                <a href="{{url(route('post.create'))}}" class="btn btn-primary"><i class="fa fa-plus"></i>إضافه منشور</a>
                @include('flash::message')
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>العنوان</th>
                                    <th>المحتوى</th>
                                    <th>الفئه</th>
                                    <th>صوره</th>
                                    <th class="text-center">التعديل</th>
                                    <th class="text-center">الحذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($records as $record)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$record->title}}</td>
                                    <td>{{$record->content}}</td>
                                    <td>{{optional($record->category)->name}}</td>
                                    <td>
                                        <img src="{{asset($record->image)}}" width="150">
                                    </td>
                                    <td class="text-center">
                                        <a href="{{url(route('post.edit',$record->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td class="text-center">
                                        {!! Form::open([
                                            'action' => ['PostController@destroy',$record->id],
                                            'method' => 'delete'
                                        ]) !!}
                                            <button type="Submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                  <div class="alert alert-danger" role="alert">
                        No Data
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
