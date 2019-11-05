@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            العملاء
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i>الرئسية</a></li>
            <li class="active">العملاء</li>
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
                @include('flash::message')
                {!! Form::open([
                    'action' => 'ClientController@search'
                ]) !!}

                    <div class="form-group">
                        <label for="search">بحث</label>
                        {!!Form::text('search',null,[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="Submit">بحث</button>
                    </div>

                {!! Form::close() !!}
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>الايميل</th>
                                    <th>تاريخ الميلاد</th>
                                    <th>فصيلة الدم</th>
                                    <th>المدينه</th>
                                    <th>المحافظه</th>
                                    <th>الهاتف</th>
                                    <th>تاريخ اخر تبرع</th>
                                    <th class="text-center">مفعل</th>
                                    <th class="text-center">حذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($records as $record)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$record->name}}</td>
                                    <td>{{$record->email}}</td>
                                    <td>{{$record->d_o_b}}</td>
                                    <td>{{optional($record->bloodtype)->name}}</td>
                                    <td>{{optional($record->city)->name}}</td>
                                    <td>{{optional($record->city->governorate)->name}}</td>
                                    <td>{{$record->phone}}</td>
                                    <td>{{$record->donation_last_date}}</td>
                                    <td class="text-center">
                                        @if($record->active == 1)
                                           {!! Form::open([
                                            'action' => ['ClientController@active',$record->id]
                                            ]) !!}
                                            <button type="Submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                                            {!! Form::close() !!}
                                        @else
                                            {!! Form::open([
                                            'action' => ['ClientController@active',$record->id]
                                        ]) !!}
                                            <button type="Submit" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button>
                                        {!! Form::close() !!}
                                        @endif
                                        
                                    </td>
                                    <td class="text-center">
                                        {!! Form::open([
                                            'action' => ['ClientController@destroy',$record->id],
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
