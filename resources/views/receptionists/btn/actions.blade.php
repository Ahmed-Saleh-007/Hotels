<div style="display:flex">

  <!-- Trigger the show modal with a button -->
  <a href="" class="show-ajax" data-toggle="modal" data-target="#ajax_view" data-ajax="{{$id}}">
    <i class="fa fa-eye" style="opacity: 0.9;font-size: 16px;margin: 0 5px;color: #080;"></i>
  </a>

  @if (auth()->user()->id == $created_by || auth()->user()->level == 'admin')

    <!-- Trigger the edit modal with a button -->
    <a href="" class="edit-ajax" data-toggle="modal" data-target="#ajax_edit" data-ajax="{{$id}}">
      <i class="fa fa-pencil-alt" style="opacity: 0.9;font-size: 16px;margin: 0 5px;color: #FFC107;"></i>
    </a>

    <!-- Trigger the delete modal with a button -->
    <a class="delete-ajax" data-toggle="modal" data-target="#ajax_delete" data-ajax="{{$id}}" style="cursor: pointer;">
      <i class="fa fa-trash" style="opacity: 0.9;font-size: 16px;margin: 0 5px;margin: 0 5px;color: #F44336;"></i>
    </a>

    @if ($is_banned)
        
    <!-- Trigger the ban modal with a button -->
    <a class="unban-ajax" title="un-ban" data-toggle="modal" data-target="#ajax_unban" data-ajax="{{$id}}" style="cursor: pointer;">
      <i class="fa fa-lock-open" style="opacity: 0.9;font-size: 16px;margin: 0 5px;margin: 0 5px;color: #ce599d;"></i>
    </a>

    @else

    <!-- Trigger the ban modal with a button -->
    <a class="ban-ajax" title="ban" data-toggle="modal" data-target="#ajax_ban" data-ajax="{{$id}}" style="cursor: pointer;">
      <i class="fa fa-lock" style="opacity: 0.9;font-size: 16px;margin: 0 5px;margin: 0 5px;color: #ff782a;"></i>
    </a>

    @endif

    
      
  @endif  

</div>
