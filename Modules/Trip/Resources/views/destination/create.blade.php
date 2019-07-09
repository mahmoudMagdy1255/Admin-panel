@extends('commonmodule::layouts.master')
@section('title') {{__('tripmodule::trip.destination')}}
@endsection

@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{adminurl('bower_components/select2/dist/css/select2.min.css')}}"> {{-- Metro CSS --}}
<link rel="stylesheet" href="{{adminurl('treeview.css')}}">
@endsection

@section('content-header')
<section class="content-header">
    <h1> {{__('tripmodule::trip.destination')}} </h1>

</section>
@endsection

@section('content')
<section class="content">
    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('tripmodule::trip.destination')}}</h3>
        </div>
        @if (count($errors) > 0) @foreach ($errors->all() as $item)
        <p class="alert alert-danger">{{$item}}</p>
        @endforeach @endif
        <!-- /.box-header -->
        <form class="form-horizontal" action="{{url('/admin-panel/destination')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="box-body">

                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            @foreach($activeLang as $lang)
                            <li @if($loop->first) class="active" @endif >
                                <a href="#{{ $lang->display_lang }}" data-toggle="tab">{{ $lang->display_lang }}</a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach($activeLang as $lang)
                            <div class="tab-pane @if($loop->first) active @endif" id="{{ $lang->display_lang }}">

                                <div class="form-group">
                                    {{-- title --}}
                                    <label class="control-label col-sm-2" for="title">{{__('tripmodule::trip.title')}}({{ $lang->display_lang }}) :</label>
                                    <div class="col-sm-8">
                                        <input type="text" autocomplete="off" class="form-control" name="{{$lang->lang}}[title]" @if($loop->first) required @endif>
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{-- Description --}}
                                    <label class="control-label col-sm-2" for="title">{{__('tripmodule::trip.desc')}}({{ $lang->display_lang }}) :</label>
                                    <div class="col-sm-8">
                                        <textarea id="editor{{ $lang->id }}" name="{{$lang->lang}}[description]" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->


                </div>

                <div class="form-group">
                    {{-- Parent Category --}}
                    <label class="control-label col-sm-2" for="title">{{trans('tripmodule::trip.parent')}}:</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="parent_id">
                            <option value=""> Parent Destination </option>
                            @foreach($destinations as $dest)
                                <option value="{{ $dest->id }}">{{ $dest->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Upload photo --}}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="photo">{{__('tripmodule::trip.photo')}} :</label>
                    <div class="col-sm-4">
                        <input data-validation="required" type="file" autocomplete="off" name="photo">
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{url('/admin-panel/destination')}}" type="button" class="btn btn-default">{{__('tripmodule::trip.cancel')}} &nbsp; <i class="fa fa-remove" aria-hidden="true"></i> </a>

                <button type="submit" class="btn btn-primary pull-right">{{__('tripmodule::trip.submit')}} &nbsp; <i class="fa fa-save"></i></button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
</section>
@endsection

@section('javascript') {{-- Treeview --}}
<script src="{{adminurl('metro.js')}}">

</script>

<!-- CK Editor -->
<script src="{{adminurl('bower_components/ckeditor/ckeditor.js')}}"></script>

<!-- Select2 -->
<script src="{{adminurl('bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script>
    //Initialize Select2 Elements
  $('.select2').select2();

</script>

@foreach ($activeLang as $lang)
    <script>
        $(function () {
            CKEDITOR.replace('editor' + "{{ $lang->id }}");
        });
    </script>
@endforeach
@endsection
