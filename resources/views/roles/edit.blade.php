@extends('layouts.app')

@inject('perms','App\Permission')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           تعديل
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> الرئسية</a></li>
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
                    'action' => ['RoleController@update',$model->id],
                    'method' => 'put'
                ])!!}

                    <div class="form-group">
                        <label for="name">الاسم</label>
                        {!!Form::text('name',old('name'),[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                    <div class="form-group">
                        <label for="display_name">الاسم العروض</label>
                        {!!Form::text('display_name',old('display_name'),[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                    <div class="form-group">
                        <label for="description">الوصف</label>
                        {!!Form::textarea('description',old('description'),[
                            'class' => 'form-control'
                        ])!!}
                    </div>
                    <div class="form-group">
                        <label for="permissions_list">الإذن</label><br>
                        <input id="select-all" type="checkbox"><label for='select-all'>اختيار الكل</label><br>
                        <div class="row">
                            @foreach($perms->all() as $perm)
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions_list[]" value="{{$perm->id}}" 

                                            @if($model->hasPermission($perm->name))
                                                checked
                                            @endif

                                            > {{$perm->display_name}}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="Submit">حفظ</button>
                    </div>

                {!!Form::close()!!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
@push('scripts')
        $("#select-all").click(function(){
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
        });
    @endpush
    </section>
    <!-- /.content -->
    
@endsection
