@extends('adminpanel::layouts.master')

@section('content')

@push('css')
    <link rel="stylesheet" href="{{ admin_design('/bower_components/select2/dist/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ admin_design('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">


    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">


@endpush

@push('js')


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

<script src="{{ admin_design('bower_components/fastclick/lib/fastclick.js')}}"></script>

<script src="{{ admin_design('bower_components/ckeditor/ckeditor.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ admin_design('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>

<script src="{{ admin_design('bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script>
  $(function () {
    CKEDITOR.replace('desc')
      $('.textarea').wysihtml5();

    CKEDITOR.replace('include')
    $('.textarea').wysihtml5();

    CKEDITOR.replace('not_include')
    $('.textarea').wysihtml5();

    CKEDITOR.replace('note')
    $('.textarea').wysihtml5();

    CKEDITOR.config.language = "{{ app()->getLocale() }}";

    $('.select2').select2();

    // Dropzone.autoDiscover = false;

    // $('#album').dropzone({

    //     paramName:'image',
    //     uploadMultiple:true,
    //     maxFileSize:5,
    //     acceptedFiles:'images/*',
    //     addRemoveLinks:true,
    //     dictDefaultMessage:@lang('trip::trip.album_default_message'),
    //     dictRemoveFile:'{{ trans('adminpanel::adminpanel.delete')}}',
    //     params:{
    //         _token:"{{ csrf_token() }}"
    //     }

    // });

 })
</script>

@endpush




<div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                  <a  class="btn btn-warning" href="#title_and_desc" data-toggle="tab">
                    @lang('trip::trip.title_and_desc')
                  </a>
                </li>


                <li>
                  <a  class="btn btn-warning" href="#include_data" data-toggle="tab">
                    @lang('trip::trip.include')
                  </a>
                </li>

                <li>
                  <a  class="btn btn-warning" href="#other_data" data-toggle="tab">
                    @lang('trip::trip.other_data')
                  </a>
                </li>

            </ul>


            <div class="tab-content">

                <div class="tab-pane active" id="title_and_desc">


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


                <div class="tab-pane" id="include_data">


                            <div class="form-group">
                                {!! Form::label('include' ,  trans('trip::trip.include') ) !!}
                                      {!! Form::textarea('include' , old('include') , ['id' => 'include' , 'class' => 'form-control'] ) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('not_include' ,  trans('trip::trip.not_include') ) !!}
                                {!! Form::textarea('not_include' , old('not_include') , ['id' => 'not_include' , 'class' => 'form-control'] ) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('note' ,  trans('trip::trip.note') ) !!}
                                {!! Form::textarea('note' , old('note') , ['id' => 'note' , 'class' => 'form-control'] ) !!}
                            </div>

                </div>

                <div class="tab-pane" id="other_data">


                            <div class="form-group">
                                {!! Form::label('categories' ,  trans('trip::category.categories') ) !!}

                                {!! Form::select('categories[]', $categories->pluck('title' , 'id')->toArray()  , old('categories[]') , [ 'data-placeholder' => trans('trip::category.categories') , 'class' => 'form-control select2' , 'multiple' => "multiple" , 'style' => 'width:100%' ]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('destinations' ,  trans('trip::destination.destinations') ) !!}

                                {!! Form::select('destinations[]', $destinations->pluck('title' , 'id')->toArray()  , old('destinations[]') , [ 'data-placeholder' => trans('trip::destination.destinations') , 'class' => 'form-control select2' , 'multiple' => "multiple" , 'style' => 'width:100%' ]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('price' ,  trans('trip::trip.price') ) !!}
                                {!! Form::number('price' , old('price') , ['placeholder' => trans('trip::trip.price') ,'id' => 'price' , 'class' => 'form-control'] ) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('days' ,  trans('trip::trip.days') ) !!}
                                {!! Form::number('days' , old('days') , ['placeholder' => trans('trip::trip.days') ,'id' => 'days' , 'class' => 'form-control'] ) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('image' ,  trans('trip::trip.image') ) !!}
                                {!! Form::file('image' , ['id' => 'image' , 'class' => 'form-control'] ) !!}
                            </div>

                             <div class="form-group">
                                {!! Form::label('user_id' ,  trans('user::user.user') ) !!}
                                {!! Form::number('user_id' , old('user_id') , ['placeholder' => trans('user::user.user') , 'id' => 'user_id' , 'class' => 'form-control'] ) !!}
                            </div>
{{--

                            <div class="form-group">
                                {!! Form::label('album' ,  trans('trip::trip.album') ) !!}
                                <div class="dropzone" id="album"></div>
                            </div>
 --}}



                            {!! Form::submit( trans('adminpanel::adminpanel.add') , ['class' => 'btn btn-primary'] ) !!}
                            {!! Form::close() !!}
                </div>


            </div>

          </div>
          <!-- nav-tabs-custom -->
        </div>

</div>



















@endsection