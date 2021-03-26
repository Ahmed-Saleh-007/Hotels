<div class="card">
    <div class="card-body">
      <h5 class="card-title">{{ trans('admin.name') }} : </h5>
      <p class="card-text">{{ $role->name }}</p>
      <h5 class="card-title">{{ trans('admin.date') }} : </h5>
      <p class="card-text">{{ $role->created_at }}</p>
    </div>
 </div>