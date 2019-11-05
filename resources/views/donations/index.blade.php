@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            طلبات التبرع
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">طلبات التبرع</li>
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
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>السن</th>
                                    <th>عدد الاكياس</th>
                                    <th>فصيلة الدم</th>
                                    <th>المدينه</th>
                                    <th>الزبون</th>
                                    <th>اسم المستشفى</th>
                                    <th>عموان المستشفى</th>
                                    <th>ملاحظات</th>                                    
                                    <th class="text-center">عرض</th>
                                    <th class="text-center">حذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($records as $record)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$record->name}}</td>
                                    <td>{{$record->age}}</td>
                                    <td>{{$record->bags_num}}</td>
                                    <td>{{optional($record->bloodtype)->name}}</td>
                                    <td>{{optional($record->city)->name}}</td>
                                    <td>{{optional($record->client)->name}}</td>
                                    <td>{{$record->hospital_name}}</td>
                                    <td>{{$record->hospital_address}}</td>
                                    <td>{{$record->notes}}</td>
                                    <td class="text-center">
                                        <a href="{{url(route('donation.show',$record->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td class="text-center">
                                        {!! Form::open([
                                            'action' => ['DonationController@destroy',$record->id],
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
