<div id="ajax_edit_errors"></div>
@csrf
<input type="text" name="id" class="hidden" id="id" value="{{$role->id}}">

<div class="form-group">
    <label for="name">name</label>
    <input type="text" name="name" class="form-control" id="name" value="{{$role->name}}">
</div>

<button class="btn btn-success" id="save" >Save Role</button>