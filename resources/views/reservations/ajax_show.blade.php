<div class="card">
    <div class="card-body">
      <h5 class="card-title">Reservation ID:</h5>
      <p class="card-text">{{ $reserv->id }}</p>
      <h5 class="card-title">Client Name:</h5>
      <p class="card-text">{{ $reserv->user->name }}</p>
  
      <h5 class="card-title">Country:</h5>
      <p class="card-text">{{ $reserv->country }}</p>
  
      <h5 class="card-title">Room No:</h5>
      <p class="card-text">{{ $reserv->room->number }}</p>
  
      <h5 class="card-title">Accompany Number:</h5>
      <p class="card-text">{{ $reserv->acc_no }}</p>
  
      <h5 class="card-title">Start From:</h5>
      <p class="card-text">{{ $reserv->from }}</p>

      <h5 class="card-title">To:</h5>
      <p class="card-text">{{ $reserv->to }}</p>

      <h5 class="card-title">Price:</h5>
      <p class="card-text">{{ floatval($reserv->price)/100.0 }}$</p>
    </div>
</div>