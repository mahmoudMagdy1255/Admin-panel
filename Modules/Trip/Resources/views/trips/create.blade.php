@extends('adminpanel::layouts.master')

@section('content')

@push('css')
  <link rel="stylesheet" href="{{ admin_design('/bower_components/select2/dist/css/select2.min.css') }}">

  <link rel="stylesheet" href="{{ admin_design('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

@endpush

@push('js')
<script src="{{ admin_design('bower_components/fastclick/lib/fastclick.js')}}"></script>

<script src="{{ admin_design('bower_components/ckeditor/ckeditor.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ admin_design('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>

<script src="{{ admin_design('bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script>
  $(function () {
    CKEDITOR.replace('desc')
      $('.textarea').wysihtml5();

    CKEDITOR.config.language = "{{ app()->getLocale() }}";

    $('.select2').select2();


 })
</script>

@endpush


<div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <div class="tab-content">

                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">{{ $title }}</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    {!! Form::open(['route' => 'trips.store' , 'files' => true]) !!}


                    <div class="form-group">
                      {!! Form::label('title' ,  trans('trip::trip.title')  ) !!}
                      {!! Form::text( 'title' , old('title') , ['class' => 'form-control'] ) !!}
                    </div>

                    <div class="form-group">
                      {!! Form::label('desc' ,  trans('trip::trip.desc') ) !!}
                      {!! Form::textarea('desc' , old('desc') , ['id' => 'desc' , 'class' => 'form-control'] ) !!}
                    </div>

                  </div>
                  <!-- /.box-body -->
                </div>


              <div class="form-group">
                {!! Form::label('categories' ,  trans('trip::category.categories') ) !!}

                 {!! Form::select('categories', $categories->pluck('title' , 'id')->toArray()  , old('categories') , [ 'data-placeholder' => trans('trip::category.categories') , 'class' => 'form-control select2' , 'multiple' => "multiple" ]) !!}
              </div>
              <!-- /.form-group -->

              <div class="form-group">
                {!! Form::label('destinations' ,  trans('trip::destination.destinations') ) !!}

                 {!! Form::select('destinations', $destinations->pluck('title' , 'id')->toArray()  , old('destinations') , [ 'data-placeholder' => trans('trip::destination.destinations') , 'class' => 'form-control select2' , 'multiple' => "multiple" ]) !!}
              </div>

            <div class="form-group">
                {!! Form::label('price' ,  trans('trip::trip.price') ) !!}
                {!! Form::number('price' , old('price') , ['id' => 'price' , 'class' => 'form-control'] ) !!}
            </div>

            <div class="form-group">
                {!! Form::label('image' ,  trans('trip::trip.image') ) !!}
                {!! Form::file('image' , ['id' => 'image' , 'class' => 'form-control'] ) !!}
            </div>


            {!! Form::submit( trans('adminpanel::adminpanel.add') , ['class' => 'btn btn-primary'] ) !!}
            {!! Form::close() !!}
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>

      </div>




@endsection