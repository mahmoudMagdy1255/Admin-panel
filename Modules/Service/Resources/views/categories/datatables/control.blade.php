<a class="btn btn-primary" href="{{ route('service-categories.edit' , $id) }}">
	<i class="fa fa-edit"></i>
</a>

<a class="btn btn-danger" href="{{ route('service-categories.destroy' , $id) }}" data-toggle="modal" data-target="#del_admin{{ $id }}">
	<i class="fa fa-trash"></i>
</a>

<a class="btn btn-warning" href="{{ route('service-categories.show' , $id) }}">
	<i class="fa fa-eye"></i>
</a>


<div id="del_admin{{ $id }}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('adminpanel::adminpanel.delete')</h4>
      </div>
      {!! Form::open(['route'=>['service-categories.destroy',$id],'method'=>'DELETE']) !!}
      <div class="modal-body">

      	@php
      		$category = trans('service::category.category')
      	@endphp

        <h4>@lang('adminpanel::adminpanel.delete_this',[ 'type' => $category , 'name'=>$title])</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">@lang('adminpanel::adminpanel.close')</button>
        {!! Form::submit(trans('adminpanel::adminpanel.yes'),['class'=>'btn btn-danger']) !!}
      </div>
      {!! Form::close() !!}
    </div>

  </div>
</div>