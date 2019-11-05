@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            تفاصيل
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i>الرئسية</a></li>
            <li class="active">تفاصيل</li>
        </ol>
    </section>



    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
            <div class="card-body">      
                @include('flash::message')
                <article class="col-lg-9">
      <div class="col-md-1"></div>
           <div class="col-md-10">

              <div class="panel panel-info">
              <div class="panel-heading"></div>
              <div class="panel-body">

                <div class="col-md-9">
                    <p><b>الاسم : {{$record->name}}</b></p>
                    <p><b>السن : {{$record->age}}</b></p>
                    <p><b>عدد الأكياس : {{$record->bags_num}}</b></p>
                    <p><b>فصيله الد : {{optional($record->bloodtype)->name}}</b></p>
                    <p><b>المدينه : {{optional($record->city)->name}}</b></p>
                    <p><b>الزبون : {{optional($record->client)->name}}</b></p>
                    <p><b>اسم المستشفى : {{$record->hospital_name}}</b></p>
                    <p><b>عنوان المستشفى : {{$record->hospital_address}}</b></p>
                    <p><b>ملاحضات : {{$record->notes}}</b></p>
                </div>
              </div>
              </div>
            </div>
</article>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
