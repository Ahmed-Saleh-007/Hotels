<div id="ajax_edit_errors"></div>
@csrf
<input type="text" name="id" class="hidden" id="id" value="{{$user->id}}">
<div class="form-group">
    <label for="name">name</label>
    <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}">
</div>
<div class="form-group">
    <label for="email">email</label>
    <input type="text" name="email" class="form-control" id="email" value="{{$user->email}}">
</div>
<div class="form-group">
    <label for="password">password</label>
    <input type="password" name="password" class="form-control" id="password">
</div>
<button class="btn btn-success" id="save" >Save User</button>