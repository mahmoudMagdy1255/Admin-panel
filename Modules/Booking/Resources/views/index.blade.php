@extends('commonmodule::layouts.master')

@section('title')
 {{__('bookingmodule::book.bookingtitle')}}
@endsection

@section('css')
<link rel="stylesheet" href="{{ adminurl('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content-header')
<section class="content-header">
    <h1> {{__('bookingmodule::book.bookingtitle')}} </h1>
</section>
@endsection

@section('content')
<section class="content">
    <!-- Content Here -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('bookingmodule::book.bookingtitle')}}</h3>
                    {{-- Add New --}}
                    <a href="{{url('admin-panel/booking/create')}}" type="button" class="btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp; {{__('bookingmodule::book.addnew')}}</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="bookingIndex" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{{__('bookingmodule::book.id')}}</th>
                                <th>{{__('bookingmodule::book.trip_id')}}</th>
                                <th>{{__('bookingmodule::book.name')}}</th>
                                <th>{{__('bookingmodule::book.mobile')}}</th>
                                <th>{{__('bookingmodule::book.departure_date')}}</th>
                                <th>{{__('bookingmodule::book.arrival_date')}}</th>
                                <th>{{__('bookingmodule::book.operations')}}</th>
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
        $('#bookingIndex').DataTable({
            dom: 'lBfrtip',
            buttons: [
                { extend: 'print', messageBottom:' <strong>All rights Reserved to IceCode .</strong>'},
                { extend: 'excel' },
            ] ,
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ url('admin-panel/book/ajax') }}",
                "type": "GET"
            },
            "columns": [
                { data: 'id', name: 'id' },
                { data: 'trip_id', name: 'trip_id' },
                { data: 'name', name: 'name' },
                { data: 'mobile', name: 'mobile' },
                { data: 'departure_date', name: 'departure_date' },
                { data: 'arrival_date', name: 'arrival_date' },
                @role('admin|superadmin')
                { data: 'operations', name: 'operations', orderable: false, searchable: false},
                @endrole
            ]
        });

    });
</script>
@endsection
