<div class="card">
    <div class="card-body">
      <h5 class="card-title">@lang('admin.number'):</h5>
      <p class="card-text">{{ $room->number }}</p>
      <h5 class="card-title">@lang('admin.capacity'):</h5>
      <p class="card-text">{{ $room->capacity }}</p>
      <h5 class="card-title">@lang('admin.price'):</h5>
      <p class="card-text">{{ $room->price / 100 }}</p>
      <h5 class="card-title">@lang('admin.status'):</h5>
      @if ($room->is_available == 1)
      <p class="card-text">@lang('admin.avaliable')</p>
      @else
      <p class="card-text">@lang('admin.un avaliable')</p>
      @endif
      <h5 class="card-title">@lang('admin.floor_name'):</h5>
      <p class="card-text">{{ $room->floor->name }}</p>
      <h5 class="card-title">@lang('admin.manager_name'):</h5>
      <p class="card-text">{{ $room->floor->manager->name }}</p>
    </div>
 </div>