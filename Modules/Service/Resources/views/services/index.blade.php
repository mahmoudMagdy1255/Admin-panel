@extends('adminpanel::layouts.master')

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ $title }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            {!! Form::open(['id' => 'form_data' , 'url' => admin_url('users/destroy/all') ]) !!}
            {!! Form::hidden('_method' , 'delete') !!}
            {!! $dataTable->table([
              'class' => 'dataTable table table-striped table-hover table-borderd'
            ], true) !!}
            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>

    <!-- Modal -->
    <div id="multipleDelete" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger">

                        <div class="empty_record">
                            <h4>{{ trans('admin.please_check_some_records') }}</h4>
                        </div>

                        <div class="not_empty_record">
                            <h4>{{ trans('admin.ask_delete_item') }} <span class="record_count"></span> ? </h4>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <div class="empty_record">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.close') }}</button>
                    </div>

                    <div class="not_empty_record">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.no') }}</button>
                        <button type="button" class="btn btn-danger del_all" name="del_all">{{ trans('admin.yes') }}</button>
                    </div>



                </div>
            </div>

        </div>
    </div>

    @push('js')

    <script>
        //delete_all();
    </script>

    {!! $dataTable->scripts() !!}

    @endpush


@stop
