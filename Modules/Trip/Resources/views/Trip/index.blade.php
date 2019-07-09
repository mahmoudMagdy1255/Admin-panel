@extends('commonmodule::layouts.master')

@section('title')
 {{__('tripmodule::trip.trips')}}
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
                    <table id="tripIndex" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{{__('tripmodule::trip.id')}}</th>
                                <th>{{__('tripmodule::trip.title')}}</th>
                                <th>{{__('tripmodule::trip.price')}}</th>
                                <th>Category</th>
                                <th>{{__('tripmodule::trip.destination')}}</th>
                                <th>{{__('tripmodule::trip.days')}}</th>
                                <th>{{__('tripmodule::trip.photo')}}</th>
                                <th>{{__('tripmodule::trip.operations')}}</th>
                            </tr>
                        </thead>
                        <tbody>

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

<script src="{{adminurl('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{adminurl('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script>
    $(document).ready(function () {
        $('#tripIndex').DataTable({
            dom: 'lBfrtip',
            buttons: [
                { extend: 'print', messageBottom:' <strong>All rights Reserved to MallaH SOFT .</strong>'},
                { extend: 'excel' },
            ] ,
            "lengthMenu": [ [25, 50, -1], [25, 50, "All"] ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ url('admin-panel/trip/ajax') }}",
                "type": "GET"
            },
            "columns": [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'price', name: 'price' },
                { data: 'category', name: 'category' },
                { data: 'destination', name: 'destination' },
                { data: 'days', name: 'days' },
                { data: 'photo', name: 'photo' },
                @role('admin|superadmin')
                { data: 'operations', name: 'operations', orderable: false, searchable: false},
                @endrole
            ]
        });

    });
</script>
@endsection
