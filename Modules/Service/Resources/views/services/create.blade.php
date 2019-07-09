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

  $('#jstree').jstree({

    "core" : {
      "data":{!! load_services_categories() !!},
      "themes" : {
        "variant" : "large"
      }
    },
    "checkbox" : {
      "keep_selected_style" : false
    },
    "plugins" : [ "wholerow", "checkbox" ]

  });

 })
</script>

@endpush




                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">{{ $title }}</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    {!! Form::open(['route' => 'service-categories.store' , 'files' => true]) !!}


                    <div class="form-group">
                      {!! Form::label('title' ,  trans('service::category.title')  ) !!}
                      {!! Form::text( 'title' , old('title') , ['class' => 'form-control'] ) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::label('desc' ,  trans('service::category.desc') ) !!}
                      {!! Form::textarea('desc' , old('desc') , ['id' => 'desc' , 'class' => 'form-control'] ) !!}
                    </div>

                  </div>
                  <!-- /.box-body -->
                </div>



                    <div id="jstree"></div>

                    <div class="form-group">
                      {!! Form::label('image' ,  trans('service::category.image') ) !!}
                      {!! Form::file('image' , ['id' => 'image' , 'class' => 'form-control'] ) !!}
                    </div>

                    <div class="form-group">
                      <img id="blah" width="100px" height="100px" class="img-thumbnail" src="{{ url('public/upload/services/categories/default.png') }}" alt="your image" />
                    </div>

                    {!! Form::submit( trans('adminpanel::adminpanel.add') , ['class' => 'btn btn-primary'] ) !!}
                    {!! Form::close() !!}



@endsection