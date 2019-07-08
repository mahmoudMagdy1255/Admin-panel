@extends('adminpanel::layouts.master')

@section('content')

@push('css')

  <link rel="stylesheet" href="{{ admin_design('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

@endpush

@push('js')
<script src="{{ admin_design('bower_components/fastclick/lib/fastclick.js')}}"></script>

<script src="{{ admin_design('bower_components/ckeditor/ckeditor.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ admin_design('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>

<script src="{{ admin_design('jstree/jstree.js') }}"></script>
<script src="{{ admin_design('jstree/jstree.checkbox.js') }}"></script>
<script src="{{ admin_design('jstree/jstree.wholerow.js') }}"></script>

<script>
  $(function () {
    CKEDITOR.replace('desc')
    $('.textarea').wysihtml5()
  })

  $('#jstree').jstree({

    "core" : {
    "themes" : {
      "variant" : "large"
    }
    },
    "checkbox" : {
      "keep_selected_style" : false
    },
    "plugins" : [ "wholerow", "checkbox" ]

  });


</script>

@endpush

	<div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $title }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open(['route' => ['admins.update' , $category->id]  , 'files' => true, 'method' => 'PUT']) !!}
              <div class="form-group">
                {!! Form::label('full_name' ,  trans('service::category.title')) !!}
                {!! Form::text('full_name' , $category->title , ['class' => 'form-control'] ) !!}
              </div>

                {!! Form::hidden('id' ,  $category->id ) !!}

              <div class="form-group">
                {!! Form::label('desc' ,  trans('service::category.desc') ) !!}
                {!! Form::textarea('desc' , $category->desc , ['id' => 'desc' , 'class' => 'form-control'] ) !!}
              </div>

              <div class="form-group">
                {!! Form::label('image' ,  trans('service::category.image') ) !!}
                {!! Form::file('image' , ['id' => 'image' , 'class' => 'form-control'] ) !!}
              </div>

              <div class="form-group">
                <img id="blah" width="100px" height="100px" class="img-thumbnail" src="{{ asset($category->image) }}" alt="your image" />
              </div>



              {!! Form::submit( trans('adminpanel::adminpanel.edit') , ['class' => 'btn btn-primary'] ) !!}
              {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
    </div>

@stop