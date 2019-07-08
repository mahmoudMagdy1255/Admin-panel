@extends('adminpanel::layouts.master')

@section('content')


	<div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $title }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open(['route' => ['admins.update' , $user->id]  , 'files' => true, 'method' => 'PUT']) !!}
              <div class="form-group">
                {!! Form::label('full_name' ,  trans('user::user.full_name')) !!}
                {!! Form::text('full_name' , $user->full_name , ['class' => 'form-control'] ) !!}
              </div>

                {!! Form::hidden('id' ,  $user->id ) !!}

              <div class="form-group">
                {!! Form::label('email' ,  trans('user::user.email') ) !!}
                {!! Form::email('email' , $user->email , ['class' => 'form-control'] ) !!}
              </div>

              <div class="form-group">
                {!! Form::label('image' ,  trans('user::user.image') ) !!}
                {!! Form::file('image' , ['id' => 'image' , 'class' => 'form-control'] ) !!}
              </div>

              <div class="form-group">
                <img id="blah" width="100px" height="100px" class="img-thumbnail" src="{{ asset($user->image) }}" alt="your image" />
              </div>

              <div class="form-group">
                {!! Form::label('password' ,  trans('user::user.password') ) !!}
                {!! Form::password('password' , ['class' => 'form-control'] ) !!}
              </div>

              {!! Form::submit( trans('adminpanel::adminpanel.edit') , ['class' => 'btn btn-primary'] ) !!}
              {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
    </div>

@stop