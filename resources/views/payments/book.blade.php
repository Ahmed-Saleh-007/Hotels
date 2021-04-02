@extends('index')
@section('content')
<div class="container sm">
<h1 style="text-align:center">Book A Room</h1>
<form method="POST" action="{{route('stripe.get')}}">

    @csrf

    <input type="hidden" id="r_price">          <!-- to calculate total price -->

    <div class="form-row">
      <div class="form-group col-md-12">
          {!! Form::label('country' , trans('admin.country')) !!} 
          {!! Form::select('country', $countries
          ,old('country'),['class' => 'form-control', 'placeholder' => 'country']) !!}
      </div>
    </div>
      <div class="form-row">
        <div class="form-group col-md-6">
            <label for="rooms_no">{{trans('admin.acc_no')}}</label>
            {!! Form::number('acc_no', '0', [ 'min'=>'0','max' => '9', 'class' => 'form-control', 'id' => 'acc_no']) !!}
          </div>
        <div class="form-group col-md-6">
          {!! Form::label('room_no' , trans('admin.room_no')) !!}

          <select class="form-control" name="room" id="room_selector">

          </select>

        </div>
      </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="stat_date">Starting Date</label>
            <input type='date' class="form-control" name="from" id="start_date">
        </div>
        <div class="form-group col-md-6">
            <label for="stat_date">Ending Date</label>
            <input type='date' class="form-control" name="to" id="end_date">
        </div>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type='text' class="form-control" id="price" value='0' name="price" readonly>
    </div>
    <button type="submit" class="btn btn-success">Checkout</button>
    <a class="btn btn-secondary" href="{{url()->previous()}}">Back</a>
  </form>
</div>
@push('js')
<script>

      $( document ).ready(function() {
        $('#end_date').change(function(){   
          var start = new Date($('#start_date').val());
          var end = new Date($('#end_date').val());
          // end - start returns difference in milliseconds 
          var diff =  Math.abs(end - start);
          // get days
          var days = Math.ceil(diff/1000 /60/60/24)+1;
          var room_price = Number($('#r_price').val())/100;

          $('#price').val(room_price * days);               //total price
       });
      });


      $( document ).ready(function() {
        $('#room_selector').change(function(){   

          $('#r_price').val($("#room_selector option:selected").data('room_price'));                     

       });
      });


      $(document).on('change','#acc_no',function(){

        var acc_no = $('#acc_no').val();

        if(acc_no > 0){
            $.ajax({
                url: '{{ route('reserv.create')}}',
                type:'get',
                datatype:'json',
                data:{acc_no: acc_no, select: ''},
                success:function(data){

                  var options = '<option placeholder="..."></option>';
              
                  for(var i = 0 ; i < data.length ; i++ ){

                    options += `
                    <option value='${data[i].id}' class="option_selected${data[i].id}"  data-room_price="${data[i].price}" > ${data[i].number} </option>`;

                  }

                  $('#room_selector').html(options);
                }
            });

        }else{
        $('#room_selector').html('');
        }

      });

</script>    
@endpush
@endsection