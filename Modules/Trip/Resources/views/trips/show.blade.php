@extends('commonmodule::layouts.master')
@section('title') {{__('tripmodule::trip.trips')}}
@endsection

@section('css')
<link rel="stylesheet" href="{{ adminurl('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content-header')
<section class="content-header">
    <h1> {{__('tripmodule::trip.trips')}} </h1>
</section>
@endsection

@section('content')
<section class="content">
    <!-- Content Here -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('tripmodule::trip.trips')}}</h3>
                    {{-- Add New --}}
                    <a href="{{url('admin-panel/trip/create')}}" type="button" class="btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp; {{__('tripmodule::trip.addnew')}}</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="container">
                        <div class="col">

                            <img class="card-img-top" src="{{ asset('public/images/trip/thumb/' . $trip->photo) }}" alt="">
                            <div class="card-body">
                                <h4 class="card-title">{{ $trip->title }}</h4>
                                <p class="card-text">{{ $trip->price }} &#36;</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <h3>@lang('tripmodule::trip.desc')</h3>
                        {!! $trip->description !!}
                    </div>

                    <div class="col">
                        <h3>@lang('tripmodule::trip.days')</h3>
                        {{ $trip->days }}
                    </div>

                    <br>
                    <hr>

                <table id="tripAlbum" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>{{__('tripmodule::trip.photo')}}</th>
                            <th>{{__('tripmodule::trip.delete')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trip->photos as $item)
                        <tr>
                            <td></td>
                            <td><img src="{{ asset('public/images/trips/' . $item->photo) }}" width="100" height="100"></td>
                            <td>
                                @role('superadmin')
                                <form class="inline" action="{{ url('admin-panel/trip-photos/delete/' . $item->id)}}" method="POST">
                                    {{ method_field('DELETE') }} {!! csrf_field() !!}
                                    <button title="Delete" type="submit" onclick="return confirm('Are you sure, You want to delete Category?')" type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                                @endrole
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <form action="{{ url('/admin-panel/trip-photos') }}" method="POST" id="createform" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="photo">Upload New photo/s :</label>
                            <div class="col-sm-4">
                                <input data-validation="required" multiple="multiple" type="file" autocomplete="off" name="photos[]">
                            </div>
                            <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                        </div>
                        <br>
                        <hr>
                        <div class="box-footer">
                                <a href="{{url('/admin-panel/trip')}}" type="button" class="btn btn-default">{{__('tripmodule::trip.cancel')}} &nbsp; <i class="fa fa-remove" aria-hidden="true"></i> </a>

                                <button type="submit" class="btn btn-primary pull-right">{{__('tripmodule::trip.submit')}} &nbsp; <i class="fa fa-save"></i></button>
                            </div>
                    </div>
                </form>
                <br>
            </div>
        </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection

@section('javascript')
    @include('commonmodule::includes.swal')

    <!-- jQuery form validator -->
    <script src="{{adminurl('plugins/jquery_form_validator/jquery.form-validator.min.js')}}"></script>
    <script>
            $.validate({
                form : '#createform',
            onError : function($form) {
                alert('Error, Make sure of your Data, Validation failed!');
                return false;
            },
            // onSuccess : function($form) {
            //     alert('The form'+' is valid!');
            //     return false; // Will stop the submission of the form
            // },
            // onValidate : function($form) {
            //     return {
            //         element : $('#some-input'),
            //         message : 'This input has an invalid value for some reason'
            //     }
            // },
            // onElementValidate : function(valid, $el, $form, errorMess) {
            //     console.log('Input ' +$el.attr('name')+ ' is ' + ( valid ? 'VALID':'NOT VALID') );
            // }
        });
        </script>
@endsection
