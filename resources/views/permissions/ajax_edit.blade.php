<div id="ajax_edit_errors"></div>
@csrf
<input type="text" name="id" class="hidden" id="id" value="{{ $permission->id }}">

<div class="form-group">
    <label for="name">name</label>
    <input type="text" name="name" class="form-control" id="name" value="{{ $permission->name }}">
</div>

<button class="btn btn-success" id="save" >Save permission</button>