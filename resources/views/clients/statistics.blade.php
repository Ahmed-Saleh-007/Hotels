@extends('index')
@section('content')

<div class="container">

    <div class="row row-cols-1 row-cols-md-2 mt-4">
        <div class="col mb-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center mb-2"> Male to Female Chart</h5>
              <canvas id="myChart" width="200" height="200"></canvas>
            </div>
          </div>
        </div>
        <div class="col mb-4">
          <div class="card">
           
            <div class="card-body">
              <h5 class="card-title text-center mb-2">Client Country Chart</h5>
              <canvas id="myChart_1" width="200" height="200"></canvas>
            </div>
          </div>
        </div>
       
      </div>

@endsection
