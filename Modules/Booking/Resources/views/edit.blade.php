@extends('commonmodule::layouts.master')
@section('title') {{__('bookingmodule::book.edit_title')}}
@endsection

@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{adminurl('bower_components/select2/dist/css/select2.min.css')}}"> {{-- Metro CSS --}}
<link rel="stylesheet" href="{{adminurl('treeview.css')}}">
<!-- daterange picker -->
<link rel="stylesheet" href="{{adminurl('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{adminurl('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endsection

@section('content-header')
<section class="content-header">
    <h1> {{__('bookingmodule::book.edit_title')}} </h1>

</section>
@endsection

@section('content')
<section class="content">
    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('bookingmodule::book.edit_title')}}</h3>
        </div>
        @if (count($errors) > 0) @foreach ($errors->all() as $item)
        <p class="alert alert-danger">{{$item}}</p>
        @endforeach @endif
        <!-- /.box-header -->
        <form class="form-horizontal" action="{{url('/admin-panel/booking')}}/{{ $book->id }}" method="PUT" enctype="multipart/form-data">
            {{ csrf_field() }}
            <!-- {{ method_field('PUT') }} -->

            <div class="box-body">

                <div class="col-md-12">
                  <div class="form-group">
                        <label class="control-label col-sm-2" for="title">{{__('bookingmodule::book.trip_id')}}:</label>
                        <div class="col-sm-6">
                            <input type="number" autocomplete="off" class="form-control" value="{{ $book->trip_id }}" name="trip_id" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">{{__('bookingmodule::book.name')}}:</label>
                        <div class="col-sm-6">
                            <input type="text" autocomplete="off" class="form-control" value="{{ $book->name }}" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">{{__('bookingmodule::book.gender')}}:</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="gender" required>
                                <option value="0" @if($book->gender=0) selected @endif>Male</option>
                                <option value="1" @if($book->gender=1) selected @endif>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">{{__('bookingmodule::book.mobile')}}:</label>
                        <div class="col-sm-6">
                            <input type="tel" autocomplete="off" class="form-control" value="{{ $book->mobile }}" name="mobile" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">{{__('bookingmodule::book.email')}}:</label>
                        <div class="col-sm-6">
                            <input type="email" autocomplete="off" class="form-control" value="{{ $book->email }}" name="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">{{__('bookingmodule::book.departure_date')}}:</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                              <input type="text" class="form-control pull-right datepicker" value="{{ $book->departure_date }}">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">{{__('bookingmodule::book.arrival_date')}}:</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                              <input type="text" class="form-control pull-right datepicker" value="{{ $book->arrival_date }}">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">{{__('bookingmodule::book.adult_number')}}:</label>
                        <div class="col-sm-6">
                            <input type="number" autocomplete="off" class="form-control" value="{{ $book->adult_number }}" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">{{__('bookingmodule::book.child_number')}}:</label>
                        <div class="col-sm-6">
                            <input type="number" autocomplete="off" class="form-control" value="{{ $book->child_number }}" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">{{__('bookingmodule::book.notes')}}:</label>
                        <div class="col-sm-6">
                            <input type="text" autocomplete="off" class="form-control" value="{{ $book->notes }}" name="name" required>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{url('/admin-panel/booking')}}" type="button" class="btn btn-default">{{__('bookingmodule::book.cancel')}} &nbsp; <i class="fa fa-remove" aria-hidden="true"></i> </a>

                <button type="submit" class="btn btn-primary pull-right">{{__('bookingmodule::book.submit')}} &nbsp; <i class="fa fa-save"></i></button>
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

<!-- date-range-picker -->
<script src="{{adminurl('bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{adminurl('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{adminurl('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Select2 -->
<script src="{{adminurl('bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script>
    //Initialize Select2 Elements
  $('.select2').select2();
  //Date picker
    $('.datepicker').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    })

  //Date range picker
    // $('#reservation').daterangepicker();
    // $('#reservation').daterangepicker(
    // {
    //     locale: {
    //       format: 'DD/MM/YYYY'
    //     }
    // },
    // function(start, end, label) {
    //     alert("A new date range was chosen: " + start.format('DD/MM/YYYY') + ' to ' + end.format('DD/MM/YYYY'));
    // });

</script>
@endsection
