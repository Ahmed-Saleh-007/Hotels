<div id="ajax_edit_errors"></div>
{!! Form::open(['id' => 'update_form']) !!}
<input type="text" name="id" class="hidden" id="id" value="{{$floor->id}}">
<div class="form-group">
    {!! Form::label('name', trans('admin.name')) !!}
    {!! Form::text('name', $floor->name, ['class'=>'form-control']) !!}
</div>
{!! Form::submit(trans('admin.save'), ['class'=>'btn btn-primary']) !!}
{!! Form::close() !!}