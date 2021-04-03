@extends('index')
@section('content')
<select id="seleted_year" class="custom-select">
    <option selected>Select Year</option>
    <option value="2015">2015</option>
    <option value="2016">2016</option>
    <option value="2017">2017</option>
    <option value="2018">2018</option>
    <option value="2019">2019</option>
    <option value="2020">2020</option>
    <option value="2021" selected>2021</option>
    <option value="2022">2022</option>
  </select>
<div id="static_id" class="test">
    @include('clients.statistics')
</div>

@endsection