
<div id="ajax_edit_errors"></div>
@csrf
<input type="text" name="id" class="hidden" id="id" value="{{ $permission->id }}">

<div class="form-group">
    <label for="name">name</label>
    <input type="text" name="name" class="form-control" id="name" value="{{ $permission->name }}">
</div>

<div class="form-group col-md-12 col-lg-12 col-sm-12 col-xs-12">

    {!! Form::label('role_id' , trans('admin.role_id')) !!}

    {!! Form::select('role', \Spatie\Permission\Models\Role::pluck('name','id'),old('role'),['class' => 'form-control', 'multiple']) !!}

</div>

<button class="btn btn-success" id="save" >Update permission</button>
