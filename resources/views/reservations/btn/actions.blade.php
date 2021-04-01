<div style="display:flex">

    <!-- Trigger the show modal with a button -->
    <a href="" class="show-ajax" data-toggle="modal" data-target="#ajax_view" data-ajax="{{$id}}">
      <i class="fa fa-eye" style="opacity: 0.9;font-size: 16px;margin: 0 5px;color: #080;"></i>
    </a>
  
    <!-- Trigger the delete modal with a button -->
    <a class="delete-ajax" data-toggle="modal" data-target="#ajax_delete" data-ajax="{{$id}}" style="cursor: pointer;">
      <i class="fa fa-trash" style="opacity: 0.9;font-size: 16px;margin: 0 5px;margin: 0 5px;color: #F44336;"></i>
    </a>
  </div>