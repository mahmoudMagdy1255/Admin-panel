@extends('commonmodule::layouts.master')

@section('title')
 {{__('tripmodule::trip.destination')}}
@endsection

@section('css')
<link rel="stylesheet" href="{{ adminurl('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content-header')
<section class="content-header">
    <h1> {{__('tripmodule::trip.destination')}} </h1>
</section>
@endsection

@section('content')
<section class="content">
    <!-- Content Here -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('tripmodule::trip.destination')}}</h3>
                    {{-- Add New --}}
                    <a href="{{url('admin-panel/destination/create')}}" type="button" class="btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp; {{__('tripmodule::trip.addnew')}}</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="categIndex" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{{__('tripmodule::trip.id')}}</th>
                                <th>{{__('tripmodule::trip.title')}}</th>
                                <th>{{__('tripmodule::trip.photo')}}</th>
                                <th>{{__('tripmodule::trip.operations')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($destinations as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>

                                    <td>{{ $item->title }}</td>

                                    <td>
                                        @if($item->photo)
                                            <img src="{{asset('public/images/destination/' . $item->photo)}}" height="70" width="100">
                                        @else
                                            <strong>No Photo</strong>
                                        @endif
                                    </td>

                                    <td>
                                        {{-- Edit --}}
                                        @role('admin|superadmin')
                                        <a title="Edit" href="{{url('admin-panel/destination/' . $item->id . '/edit')}}" type="button" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        @endrole
                                            {{-- Delete --}}
                                        @role('superadmin')
                                        <form class="inline" action="{{url('admin-panel/destination/delete/' . $item->id)}}" method="POST">
                                            {{ method_field('DELETE') }} {!! csrf_field() !!}
                                            <button title="Delete" type="submit" onclick="return confirm('Are you sure, You want to delete Category?')" type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </form>
                                        @endrole
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

@endsection
