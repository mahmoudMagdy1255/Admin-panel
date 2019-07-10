@extends('commonmodule::layouts.master')
@section('title') {{__('tripmodule::trip.trips')}}
@endsection

@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{adminurl('bower_components/select2/dist/css/select2.min.css')}}"> {{-- Metro CSS --}}
<link rel="stylesheet" href="{{adminurl('treeview.css')}}">
@endsection

@section('content-header')
<section class="content-header">
    <h1> {{__('tripmodule::trip.trips')}} </h1>

</section>
@endsection

@section('content')
<section class="content">
    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('tripmodule::trip.trips')}}</h3>
        </div>
        @if (count($errors) > 0) @foreach ($errors->all() as $item)
        <p class="alert alert-danger">{{$item}}</p>
        @endforeach @endif
        <!-- /.box-header -->
        <form class="form-horizontal" action="{{url('/admin-panel/trip')}}/{{ $trip->id }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }} {{ method_field('PUT') }}

            <div class="box-body">

                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            @foreach($activeLang as$lang)
                            <li @if($loop->first) class="active" @endif >
                                <a href="#{{ $lang->display_lang }}" data-toggle="tab">{{ $lang->display_lang }}</a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach($activeLang as $key=>$lang)
                            <div class="tab-pane @if($loop->first) active @endif" id="{{ $lang->display_lang }}">

                                <div class="form-group">
                                    {{-- title --}}
                                    <label class="control-label col-sm-2" for="title">{{__('tripmodule::trip.title')}} :</label>
                                    <div class="col-sm-8">
                                        <input id="title" type="text" autocomplete="off" class="form-control" name="{{ $lang->lang }}[title]" @if($loop->first) required @endif value="{{ ValueOf($trip, $lang, 'title') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{-- Description --}}
                                    <label class="control-label col-sm-2" for="title">{{__('tripmodule::trip.desc')}}:</label>
                                    <div class="col-sm-8">
                                        <textarea id="desc{{ $lang->id }}" name="{{ $lang->lang }}[description]" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ ValueOf($trip, $lang, 'description') }}</textarea>
                                    </div>
                                </div>


                                <div class="form-group">
                                    {{-- Short Description --}}
                                    <label class="control-label col-sm-2" for="title">{{__('tripmodule::trip.short_desc')}}:</label>
                                    <div class="col-sm-8">
                                        <textarea id="short_desc{{ $lang->id }}" name="{{ $lang->lang }}[short_desc]" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ ValueOf($trip, $lang, 'short_desc') }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{-- include --}}
                                    <label class="control-label col-sm-2" for="title">{{__('tripmodule::trip.include')}}:</label>
                                    <div class="col-sm-8">
                                        <textarea id="include{{ $lang->id }}" name="{{ $lang->lang }}[include]" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ ValueOf($trip, $lang, 'include') }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{-- Not include --}}
                                    <label class="control-label col-sm-2" for="title">{{__('tripmodule::trip.not_include')}}:</label>
                                    <div class="col-sm-8">
                                        <textarea id="not_include{{ $lang->id }}" name="{{ $lang->lang }}[not_include]" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ ValueOf($trip, $lang, 'not_include') }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{-- Note --}}
                                    <label class="control-label col-sm-2" for="title">{{__('tripmodule::trip.note')}}:</label>
                                    <div class="col-sm-8">
                                        <textarea id="note{{ $lang->id }}" name="{{ $lang->lang }}[note]" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ ValueOf($trip, $lang, 'note') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->

                    {{-- Upload photo --}}
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="photo">{{__('tripmodule::trip.photo')}} :</label>
                        <div class="col-sm-4">
                            <input data-validation="required" type="file" autocomplete="off" name="photo"> @if ($trip->photo)
                            <br>
                            <img src={{ asset( "public/images/trip/thumb/".$trip->photo) }}>
                            <br> @else
                            <br>
                            <strong>"No Photo"</strong>
                            <br> @endif
                        </div>
                    </div>

                    <div class="form-group">
                        {{-- Price --}}
                        <label class="control-label col-sm-2" for="title">{{__('tripmodule::trip.price')}} :</label>
                        <div class="col-sm-3">
                            <input id="price" type="text" value="{{ $trip->price }}" autocomplete="off" class="form-control" name="price"
                                   required>
                        </div>

                        <label class="control-label col-sm-2" for="title">{{__('tripmodule::trip.days')}} :</label>
                            <div class="col-sm-3">
                                <input id="days" type="text" value="{{ $trip->days }}" autocomplete="off" class="form-control" name="days" required>
                            </div>

                    </div>


                    {{-- Select Category --}}
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">{{trans('tripmodule::trip.category')}}:</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="categories[]" multiple>
                            @foreach($categs as $cat)
                                <option value="{{ $cat->id }}" @if( in_array($cat->id , $trip->categories()->get()->pluck('id')->toArray()) ) selected @endif>{{ $cat->title }}</option>
                            @endforeach
                            </select>
                        </div>

                    </div>


{{--                    <div class="form-group">--}}

{{--                        <label class="control-label col-sm-2" for="title">{{__('tripmodule::trip.child_price')}} :</label>--}}
{{--                        <div class="col-sm-3">--}}
{{--                            <input id="price" type="text" autocomplete="off" class="form-control"--}}
{{--                                   value="{{ $trip->child_price }}"--}}
{{--                                   name="child_price"--}}
{{--                                   required>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    {{-- Select destinations --}}
                    <div class="form-group">
                        <br>
                        <label class="control-label col-sm-2" for="title">{{trans('tripmodule::trip.destinations')}} :</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="destinations[]" multiple="multiple">
                                @foreach ($destinations as $item)
                                    <option value="{{ $item->id }}" @if(in_array($item->id, $selected_categ_ids)) selected @endif>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="box-header">
                            <pre><h4>SEO Columns : </h4></pre>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                @foreach($activeLang as $lang)
                                <li @if($loop->first) class="active" @endif >
                                    <a href="#seo{{ $lang->display_lang }}" data-toggle="tab">{{ $lang->display_lang }}</a>
                                </li>
                                @endforeach
                            </ul>

                            <div class="tab-content">
                                @foreach($activeLang as $lang)
                                <div class="tab-pane @if($loop->first) active @endif" id="seo{{ $lang->display_lang }}">


                                    <div class="form-group">
                                        {{-- Meta Title --}}
                                        <label class="control-label col-sm-2" for="title"> {{__('tripmodule::trip.mt')}} :</label>
                                        <div class="col-sm-8">
                                            <input id="countTitleLettrs" type="text"
                                            autocomplete="off" class="form-control" name="{{ $lang->lang }}[meta_title]" value="{{ ValueOf($trip, $lang, 'meta_title') }}">
                                            <span id="titleSpan"></span>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        {{-- Meta Description --}}
                                        <label class="control-label col-sm-2" for="desc"> {{__('tripmodule::trip.md')}} :</label>
                                        <div class="col-sm-8">
                                            <textarea id="countDescLettrs" class="form-control" autocomplete="off"
                                                name="{{ $lang->lang }}[meta_desc]" cols="15" rows="2">{{ ValueOf($trip, $lang, 'meta_desc') }}</textarea>
                                            <span id="descSpan"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {{-- Meta Keywords --}}
                                        <label class="control-label col-sm-2" for="tags"> Meta Keywords / {{__('tripmodule::trip.tags')}} :</label>
                                        <div class="col-sm-8">
                                            <input id="countKeyWords" autocomplete="off"
                                            type="text" class="form-control" name="{{ $lang->lang }}[meta_keywords]" value="{{ ValueOf($trip, $lang, 'meta_keywords') }}">
                                            <span id="tagsSpan"></span>
                                        </div>
                                    </div>

                                    <!-- Slug -->
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="slug">Slug : </label>
                                        <div class="col-sm-8">
                                            <input type="text" autocomplete="off" class="form-control"
                                            name="{{ $lang->lang }}[slug]" value="{{ ValueOf($trip, $lang, 'slug') }}">
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
        </div>
</section>
@endsection

@section('javascript') {{-- Treeview --}}
<script src="{{adminurl('metro.js')}}"></script>

{{-- jQuery Count letters --}}
    @include('tripmodule::Trip.js') {{-- jQuery Bind data --}}
    @include('tripmodule::Trip.copy')

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
    CKEDITOR.replace('desc' + "{{ $lang->id }}");
    CKEDITOR.replace('short_desc' + "{{ $lang->id }}");
    CKEDITOR.replace('include' + "{{ $lang->id }}");
    CKEDITOR.replace('not_include' + "{{ $lang->id }}");
  });

</script>
@endforeach
@endsection
