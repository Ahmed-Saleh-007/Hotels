<div style="display:flex">

  <!-- Trigger the show modal with a button -->
  <a href="" class="show-ajax" data-toggle="modal" data-target="#ajax_view" data-ajax="{{$id}}">
    <i class="fa fa-eye" style="opacity: 0.9;font-size: 16px;margin: 0 5px;color: #080;"></i>
  </a>

  <!-- Trigger the edit modal with a button -->
  <a href="" class="edit-ajax" data-toggle="modal" data-target="#ajax_edit" data-ajax="{{$id}}">
    <i class="fa fa-pencil-alt" style="opacity: 0.9;font-size: 16px;margin: 0 5px;color: #FFC107;"></i>
  </a>

  <!-- Trigger the delete modal with a button -->
  <a class="delete-ajax" data-toggle="modal" data-target="#ajax_delete" data-ajax="{{$id}}" style="cursor: pointer;">
    <i class="fa fa-trash" style="opacity: 0.9;font-size: 16px;margin: 0 5px;margin: 0 5px;color: #F44336;"></i>
  </a>

</div>

<!-- Modal -->
{{-- <div id="del_admin{{ $id }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      {!! Form::open(['url'=>aurl('admins/' . $id), 'method' => 'delete']) !!}
      <div class="modal-body">
        <h4>{{ trans('admin.delete_this', ['name' => $name_en]) }}</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.no') }}</button>
        {!! Form::submit(trans('admin.yes'), ['class' => 'btn btn-danger']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div> --}}
