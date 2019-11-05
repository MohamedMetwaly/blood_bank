@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
@include('flash::message')
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">تغيير كلمه المرور :: {{auth()->user()->name}}</div>

                    <div class="panel-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form class="form-horizontal" method="post" action="{{ route('postChangePassword') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('old-password') ? ' has-error' : '' }}">
                                <label for="old-password" class="col-md-4 control-label">كلمه المرور الحاليه</label>

                                <div class="col-md-6">
                                    <input id="old-password" type="password" class="form-control" name="old-password" required>

                                    @if ($errors->has('old-password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('old-password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">كلمه المرور الجديده</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password confirmation" class="col-md-4 control-label">تاكيد كلمه المرور الجديده</label>

                                <div class="col-md-6">
                                    <input id="password confirmation" type="password" class="form-control" name="password confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        تغيير كلمه المرور
                                    </button>
                                    @foreach($errors as $error)
                                        {{ error }}
                                     @endforeach
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection