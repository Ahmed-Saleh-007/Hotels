@if($avatar_image == 'avatar.png')
<img src="{{ url('images/'. $avatar_image) }}" width="80" style="height: 45px" class="img-thumbnail" alt="user image">    
@else
<img src="{{ url('storage/users_images/'. $avatar_image) }}" width="80" style="height: 45px" class="img-thumbnail" alt="user image">
@endif
