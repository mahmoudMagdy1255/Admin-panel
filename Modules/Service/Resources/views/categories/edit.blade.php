@extends('adminpanel::layouts.master')

@section('content')

@push('css')
  <link rel="stylesheet" href="{{ admin_design('/jstree/themes/default/style.css') }}">

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
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
    CKEDITOR.replace('{{ $localeCode .'[desc]' }}')
    $('.textarea').wysihtml5()

    @endforeach

    CKEDITOR.config.language = "{{ app()->getLocale() }}";

  $('#jstree').jstree({

      "core" : {
        'data' : {!! load_services_categories( $category->parent_id , $category->id ) !!},
        "themes" : {
          "variant" : "large"
        }
      },
      "checkbox" : {
        "keep_selected_style" : false
      },
      "plugins" : [ "wholerow"]
    });

  });

  $('#jstree').on('changed.jstree', function(e , data) {

    var categories = [];

    for (var i = 0 , j = data.selected.length ; i < j; i++) {

      selected_data = data.selected[i];

      categories.push( data.instance.get_node(selected_data).id );

    };

    $('#parent_id').val( categories.join(',') )

   });

</script>

@endpush


<div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li class="{{ $loop->first ? 'active' : '' }}">
                  <a  class="btn btn-warning" href="#tab_{{ $localeCode }}" data-toggle="tab">
                    {{ $properties['native'] }}
                  </a>
                </li>
              @endforeach
            </ul>

            <div class="tab-content">
              @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="tab_{{ $localeCode }}">

                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">{{ $title }}</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    {!! Form::open(['method' => 'PUT' , 'route' => ['service-categories.update' , $category->id] , 'files' => true]) !!}

                    {!! Form::hidden('id', $category->id) !!}
                    <div class="form-group">
                      {!! Form::label('title' ,  trans('service::category.title')  . ' ( ' . $properties['native'] . ' ) ' ) !!}
                      {!! Form::text( $localeCode.'[title]' , $category->translate($localeCode)->title , ['class' => 'form-control'] ) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::label('desc' ,  trans('service::category.desc') . ' ( ' . $properties['native'] . ' ) ' ) !!}
                      {!! Form::textarea($localeCode .'[desc]' , $category->translate($localeCode)->desc , ['id' => 'desc' , 'class' => 'form-control'] ) !!}
                    </div>

                  </div>
                  <!-- /.box-body -->
                </div>

              </div>
             @endforeach




            </div>
            <!-- /.tab-content -->

                    <input type="hidden" name="parent_id" id="parent_id" value="{{ old('parent_id') }}">

                    <div id="jstree"></div>

                    <div class="form-group">
                      {!! Form::label('image' ,  trans('service::category.image') ) !!}
                      {!! Form::file('image' , ['id' => 'image' , 'class' => 'form-control'] ) !!}
                    </div>

                    <div class="form-group">
                      <img id="blah" width="100px" height="100px" class="img-thumbnail" src="{{ url($category->image) }}" alt="your image" />
                    </div>

                    {!! Form::submit( trans('adminpanel::adminpanel.edit') , ['class' => 'btn btn-primary'] ) !!}
                    {!! Form::close() !!}
          </div>
          <!-- nav-tabs-custom -->
        </div>

      </div>




@endsection