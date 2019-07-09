@extends('commonmodule::layouts.master')

@section('title')
 {{__('tripmodule::trip.program')}}
@endsection

@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{adminurl('bower_components/select2/dist/css/select2.min.css')}}"> {{-- Metro CSS --}}
<link rel="stylesheet" href="{{adminurl('treeview.css')}}">
@endsection

@section('content-header')
<section class="content-header">
    <h1> {{__('tripmodule::trip.program')}} </h1>

</section>
@endsection

@section('content')
<section class="content">
    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('tripmodule::trip.program')}} of {{$trip->title}}</h3>
        </div>
        @if (count($errors) > 0) @foreach ($errors->all() as $item)
        <p class="alert alert-danger">{{$item}}</p>
        @endforeach @endif
        <!-- /.box-header -->
        <form class="form-horizontal" action="{{url('/admin-panel/trip-program')}}" method="POST">
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
                                    <label class="control-label col-sm-2" for="title">{{__('tripmodule::trip.day')}} ({{ $lang->display_lang }}) :</label>
                                    <div class="col-sm-8">
                                        <input id="title" type="text" autocomplete="off" class="form-control" name="{{$lang->lang}}[title]" @if($loop->first)
                                        required @endif>
                                    </div>
                                </div>

                                <input type="hidden" name="trip_id" value="{{ $trip->id }}">

                                <div class="form-group">
                                    {{-- Description --}}
                                    <label class="control-label col-sm-2" for="title">{{__('tripmodule::trip.desc')}} ({{ $lang->display_lang }}) :</label>
                                    <div class="col-sm-8">
                                        <textarea id="desc{{ $lang->id }}" name="{{$lang->lang}}[description]" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
            </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{url('/admin-panel/trip')}}" type="button" class="btn btn-default">{{__('tripmodule::trip.cancel')}} &nbsp; <i class="fa fa-remove" aria-hidden="true"></i> </a>

                    <button type="submit" class="btn btn-primary pull-right">{{__('tripmodule::trip.submit')}} &nbsp; <i class="fa fa-save"></i></button>
                </div>
                <!-- /.box-footer -->
        </form>
    </div><br>

        <div class="box box-info">
            <div class="box-header with-border">
                <div class="box-header with-border">
                    <h3 class="box-title">List of Trip Program</h3>
                </div>
                <br>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Day</th>
                            <th>Description</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trip->program as $program)
                        <tr>
                            <td>{{ $program->id }}</td>
                            <td>{{ $program->title }}</td>
                            <td>
                                {!! $program->description !!}
                            </td>
                            <td>
                                {{-- Edit --}} @role('admin|superadmin')
                                <a title="Edit" href="{{url('admin-panel/trip-program/' . $program->id . '/edit')}}" type="button" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>                        @endrole &nbsp; {{-- Delete --}} @role('superadmin')
                                <form class="inline" action="{{url('admin-panel/trip-program/delete/' . $program->id)}}" method="POST">
                                    {{ method_field('DELETE') }} {!! csrf_field() !!}
                                    <button title="Delete" type="submit" onclick="return confirm('Are you sure, You want to delete this Data?')" type="button"
                                        class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                                @endrole
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</section>
@endsection

@section('javascript')

@include('commonmodule::includes.swal')

<!-- CK Editor -->
<script src="{{adminurl('bower_components/ckeditor/ckeditor.js')}}"></script>

@foreach ($activeLang as $lang)
<script>
    $(function () {
    CKEDITOR.replace('desc' + '{{ $lang->id }}');
  });

</script>
@endforeach
@endsection
