<div id="ajax_edit_errors"></div>
{!! Form::open(['id' => 'update_form']) !!}
<input type="text" name="id" class="hidden" id="id" value="{{$room->id}}">
<div class="form-group">
    {!! Form::label('number', trans('admin.number')) !!}
    {!! Form::text('number', $room->number, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('capacity', trans('admin.capacity')) !!}
    {!! Form::text('capacity', $room->capacity, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('price', trans('admin.price')) !!}
    {!! Form::text('price', $room->price / 100, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('floor_id', trans('admin.floor_name')) !!}
    {!! Form::select('floor_id', App\Models\Floor::where('manager_id', 1)->pluck('name', 'id'), $room->floor_id, ['class' => 'form-control']) !!}
</div>
{!! Form::submit(trans('admin.save'), ['class'=>'btn btn-primary']) !!}
{!! Form::close() !!}