@extends('commonmodule::layouts.master')

@section('title')
 {{__('tripmodule::trip.pagecategtitle')}}
@endsection

@section('css')
<link rel="stylesheet" href="{{ adminurl('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content-header')
<section class="content-header">
    <h1> {{__('tripmodule::trip.pagecategtitle')}} </h1>
</section>
@endsection

@section('content')
<section class="content">
    <!-- Content Here -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('tripmodule::trip.pagecategtitle')}}</h3>
                    {{-- Add New --}}
                    <a href="{{url('admin-panel/trip/category/create')}}" type="button" class="btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp; {{__('tripmodule::trip.addnew')}}</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="categIndex" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{{__('tripmodule::trip.id')}}</th>
                                <th>{{__('tripmodule::trip.title')}}</th>
                                <th>{{__('tripmodule::trip.photo')}}</th>
                                <th>{{__('tripmodule::trip.edit')}}</th>
                                <th>{{__('tripmodule::trip.delete')}}</th>
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
        $('#categIndex').DataTable({
            dom: 'lBfrtip',
            buttons: [
                { extend: 'print',messageBottom:' <strong>All Rights Reserved to IceCode .</strong>'},
                { extend: 'excel' },
            ] ,
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ url('admin-panel/trip/category/ajax') }}",
                "type": "GET"
            },
            "columns": [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'photo', name: 'photo' },
                @role('admin|superadmin')
                { data: 'edit', name: 'edit', orderable: false, searchable: false},
                @endrole
                @role('superadmin')
                { data: 'delete', name: 'delete', orderable: false, searchable: false}
                @endrole

            ]
        });

    });
</script>
@endsection
