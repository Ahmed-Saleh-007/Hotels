@extends('index')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">My Reservations</div>
    </div>
    <div class="card-body">
        {!! $dataTable->table(['class' => 'dataTable table table-striped table-hover table-bordered'], true) !!}
    </div>
</div>

<!--
    view modal view using by ajax
-->

<div id="ajax_view" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">View Reservation</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body" id="ajax_view_content">
          
        </div>
      </div>
    </div>
</div>

<!--
    delete modal view using by ajax
-->

<div id="ajax_delete" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Reservation</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body" id="ajax_delete_content">
            @csrf
            <h4 class="mb-3">{{ trans('admin.delete_this') }}</h4>
            <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.no') }}</button>
            <button class="btn btn-danger" id="delete" >Delete Reservation</button>
          </div>
      </div>
    </div>
</div>


@push('js')

{!! $dataTable->scripts() !!}

<script>

    //////////////////////////
    // Ajax handler for show//
    //////////////////////////

    $(document).ready(function () {
      $(document).on('click', '.show-ajax', function () {
        console.log($(this).data('ajax'));
        $.ajax({
            url:  '{{url("")}}/all-reservations/' + $(this).data('ajax'),
            type: 'get',
            success: function (data) {
              $('#ajax_view_content').html(data);
            }
        });
      });
    });

    ////////////////////////////
    // Ajax handler for delete//
    ////////////////////////////

    $(document).ready(function () {
        var _id = 0;
        $(document).on('click', '.delete-ajax', function () {
            console.log($(this).data('ajax'));
            _id = $(this).data('ajax');
        });
        $(document).on('click', '#ajax_delete_content #delete', function () {
            $.ajax({
                url:  '{{url("")}}/all-reservations/' + _id,
                type: 'delete',
                data: {
                    _token: $('#ajax_delete_content [name=_token]').val(),
                },
                success: function (data) {
                    toastr.success(data.success, 'Success Alert', {timeOut: 10000, closeButton: true, progressBar: true});
                    $('#ajax_delete').modal('toggle');
                    $('.buttons-reload').trigger("click");
                }
            });
        });
    });


    //calculate total price of days
    $( document ).ready(function() {
        $('#end_date').change(function(){   
          var start = new Date($('#start_date').val());
          var end = new Date($('#end_date').val());
          // end - start returns difference in milliseconds 
          var diff =  Math.abs(end - start);
          // get days
          var days = Math.ceil(diff/1000 /60/60/24)+1;
          var room_price = Number($('#room').val())/100;
          $('#price').val(room_price * days);
       });
    });
</script>
@endpush
@endsection