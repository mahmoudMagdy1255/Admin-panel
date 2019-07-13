@extends('adminpanel::layouts.master')

@push('css')
  <link rel="stylesheet" href="{{ admin_design('/jstree/themes/default/style.css') }}">

  <link rel="stylesheet" href="{{ admin_design('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

@endpush

@push('js')
<script src="{{ admin_design('bower_components/fastclick/lib/fastclick.js')}}"></script>

<script src="{{ admin_design('bower_components/ckeditor/ckeditor.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ admin_design('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>

<script>
  $(function () {
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      CKEDITOR.replace('{{ $localeCode .'[desc]' }}')
      $('.textarea').wysihtml5();

    @endforeach
    CKEDITOR.config.language = "{{ app()->getLocale() }}";

 })
</script>

@endpush



@section('content')


    <div class="side-body padding-top">

        <h1 class="page-title">
            <i class="fa fa-settings"></i> {{ $title }}
        </h1>


    <div class="page-content settings container-fluid">
        <form action="{{ route('configs.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="panel">

                <div class="page-content settings container-fluid">

                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#site">@lang('config::config.about')</a>
                        </li>

                        <li>
                            <a data-toggle="tab" href="#admin">@lang('config::config.other')</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="site" class="tab-pane fade in  active ">



                            <ul class="nav nav-tabs">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li class="{{ $loop->first ? 'active' : '' }}">
                                      <a  class="btn btn-danger" href="#tab_{{ $localeCode }}" data-toggle="tab">
                                        {{ $properties['native'] }}
                                      </a>
                                    </li>
                                @endforeach
                            </ul>


                            <div class="tab-content">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)


                                    <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="tab_{{ $localeCode }}">


                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                <code>
                                                    @lang('config::config.title')
                                                    ( {{ $properties['native'] }} )
                                                </code>
                                            </h3>
                                        </div>

                                        <div class="panel-body no-padding-left-right">
                                            <div class="col-md-10 no-padding-left-right">

                                                <input type="text" value="{{ $config ? $config->translate($localeCode)->title : old($localeCode.'[title]') }}" class="form-control" placeholder="@lang('config::config.title')" name="{{ $localeCode }}[title]">
                                            </div>

                                        </div>
                                        <hr>

                                        <div class="panel-heading">

                                            <h3 class="panel-title">
                                                <code>
                                                    @lang('config::config.desc')
                                                    ( {{ $properties['native'] }} )
                                                </code>
                                            </h3>
                                        </div>

                                        <div class="panel-body no-padding-left-right">
                                            <div class="col-md-10 no-padding-left-right">

                                                <textarea class="form-control" name="{{ $localeCode }}[desc]" placeholder="@lang('config::config.desc')">
                                                     {{ $config ? $config->translate($localeCode)->desc : old($localeCode."[desc]") }}
                                                </textarea>
                                            </div>

                                        </div>


                                        <hr>

                                        <div class="panel-heading">

                                            <h3 class="panel-title">
                                                <code>
                                                    @lang('config::config.address')
                                                    ( {{ $properties['native'] }} )
                                                </code>
                                            </h3>
                                        </div>

                                        <div class="panel-body no-padding-left-right">
                                            <div class="col-md-10 no-padding-left-right">

                                                <input type="text" class="form-control" name="{{ $localeCode }}[address]"  value="{{ $config ? $config->translate($localeCode)->address :  old( $localeCode.'[address]') }}"  placeholder="@lang('config::config.address')">
                                            </div>

                                        </div>

                                        <hr>


                                    </div>

                                @endforeach


                            </div>




                        </div>

                        <div id="admin" class="tab-pane fade in ">

                            <div class="panel-heading">

                                <h3 class="panel-title">
                                    <code>
                                        @lang('config::config.phone')
                                        ( {{ $properties['native'] }} )
                                    </code>
                                </h3>
                            </div>

                            <div class="panel-body no-padding-left-right">
                                <div class="col-md-10 no-padding-left-right">

                                    <input type="text"   value="{{ $config->phone ?? old('phone') }}" class="form-control" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="phone" placeholder="@lang('config::config.phone')">
                                </div>

                            </div>

                            <hr>

                          <div class="panel-heading">
                                <h3 class="panel-title">
                                    <code>@lang('config::config.logo')</code>
                                </h3>

                            </div>

                            <div class="panel-body no-padding-left-right">
                                <div class="col-md-10 no-padding-left-right">
                                    <input id="image" type="file" name="logo">
                                </div>
                            </div>


                            @if($config and $config->logo)
                                <div class="form-group">
                                    <img width="100px" height="100px" class="img-thumbnail" src="{{ asset($config->logo) }}" alt="your image" />
                                </div>
                            @endif

                            <hr>

                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <code>@lang('config::config.background')</code>
                                </h3>

                            </div>

                            <div class="panel-body no-padding-left-right">
                                <div class="col-md-10 no-padding-left-right">
                                    <input type="file" name="background">
                                </div>
                            </div>

                            @if($config and $config->background)
                                <div class="form-group">
                                    <img width="100px" height="100px" class="img-thumbnail" src="{{ asset($config->background) }}" alt="your image" />
                                </div>
                            @endif



                            <div class="form-group">


                                <button type="submit" class="btn btn-primary pull-right">@lang('adminpanel::adminpanel.save')</button>

                            </div>

                            <hr>



                        </div>
                    </div>
                </div>
            </div>

        </div>
        </form>



            </div>



            </div>
@stop
