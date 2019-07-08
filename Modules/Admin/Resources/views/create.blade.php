@extends('adminpanel::layouts.master')

@section('content')

<div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $title }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open(['route' => 'admins.store' , 'files' => true]) !!}
              <div class="form-group">
                {!! Form::label('full_name' ,  trans('admin::admin.full_name')) !!}
                {!! Form::text('full_name' , old('full_name') , ['class' => 'form-control'] ) !!}
              </div>

              <div class="form-group">
                {!! Form::label('email' ,  trans('admin::admin.email') ) !!}
                {!! Form::email('email' , old('email') , ['class' => 'form-control'] ) !!}
              </div>

              <div class="form-group">
                {!! Form::label('password' ,  trans('admin::admin.password') ) !!}
                {!! Form::password('password' , ['class' => 'form-control'] ) !!}
              </div>

              <div class="form-group">
                {!! Form::label('image' ,  trans('admin::admin.image') ) !!}
                {!! Form::file('image' , ['id' => 'image' , 'class' => 'form-control'] ) !!}
              </div>

              <div class="form-group">
                <img id="blah" width="100px" height="100px" class="img-thumbnail" src="{{ url('public/upload/admins/default.png') }}" alt="your image" />
              </div>

              {!! Form::submit( trans('adminpanel::adminpanel.add_new') , ['class' => 'btn btn-primary'] ) !!}
              {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
          </div>
@endsection