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
        <!-- Default box -->
            <div class="card-body">      
                @include('flash::message')
                <article class="col-lg-9">
      <div class="col-md-1"></div>
           <div class="col-md-10">

              <div class="panel panel-info">
              <div class="panel-heading"></div>
              @foreach($records as $record)
              <div class="panel-body">

                <div class="col-md-9">
                    <p><b>الهاتف : {{$record->phone}}</b></p>
                    <p><b>الايميل : {{$record->email}}</b></p>
                    <p><b>روابط التواصل : <a href="{{$record->fb_link}}" target="_blank" ><i class="fa fa-facebook-square fa-lg"></i></a>
                    <a href="{{$record->tw_link}}" target="_blank" ><i class="fa fa-twitter-square fa-lg"></i></a>
                    <a href="{{$record->insta_link}}" target="_blank" ><i class="fa fa-instagram fa-lg"></i></a>
                    <a href="{{$record->yt_link}}" target="_blank" ><i class="fa fa-youtube"></i></a>
                    <a href="{{$record->phone}}" target="_blank" ><i class="fa fa-whatsapp fa-lg"></i></a>
                    <a href="{{$record->google_link}}" target="_blank" ><i class="fa fa-google fa-lg"></i></a>
                  </b></p>
                </div>

                <div class="col-md-12">
                    <hr/>
                    <p><b></b></p>
                    <p></p>
                    <a href="{{url(route('setting.edit',$record->id))}}" class="btn btn-primary pull-left">تعديل</a>
                </div>
              </div>
              @endforeach
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
