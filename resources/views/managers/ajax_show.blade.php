<div class="card">
    <div class="card-body">

      @if($user->avatar_image == 'avatar.png')
        <img src="{{ url('images') . '/' . $user->avatar_image }}" width="100" style="height: 60px" class="img-thumbnail" />
      @else
        <img src="{{ url('storage/users_images') . '/' . $user->avatar_image }}" width="100" style="height: 60px" class="img-thumbnail" />
      @endif

      
      <br>
      <hr>

      <h5 class="card-title">Name:</h5>
      <p class="card-text">{{ $user->name }}</p>
      <h5 class="card-title">Email:</h5>
      <p class="card-text">{{ $user->email }}</p>

      <h5 class="card-title">National ID:</h5>
      <p class="card-text">{{ $user->national_id }}</p>

      <h5 class="card-title">Created At:</h5>
      <p class="card-text">{{ $user->created_at }}</p>
      
    </div>
 </div>